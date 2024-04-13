<?php

namespace App\Http\Controllers;

use App\Models\FinderItem;
use App\Models\FinderTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class FinderItemsController extends Controller
{
    private function formatTags($all_items)
    {
        $formattedItems = [];
        foreach ($all_items as $item) {
            $formattedTags = [];
            foreach ($item->tags as $tag) {
                $formattedTags[] = [
                    'id' => $tag->id,
                    'name' => $tag->tag,
                ];
            }
            $formattedItems[] = [
                'id' => $item->id,
                'item' => $item->item,
                'item_description' => $item->item_description,
                'location' => $item->location,
                'location_description' => $item->location_description,
                'tags' => $formattedTags,
            ];
        }
        return $formattedItems;
    }

    public function finder(Request $request)
    {
        $items = FinderItem::with('tags')->where('user_id', Auth::id())->get();

        $formattedItems = $this->formatTags($items);

        return inertia('Finder/Index', [
            'items' => $formattedItems
        ]);
    }
    public function showAddItem(Request $request)
    {
        return inertia('Finder/Add');
    }
    public function showEditItem(Request $request)
    {
        $item = FinderItem::with('tags')->find($request->id);

        $formattedTags = $item->tags->pluck('tag');

        $formattedItem = [
            'id' => $item->id,
            'item' => $item->item,
            'item_description' => $item->item_description,
            'location' => $item->location,
            'location_description' => $item->location_description,
            'tags' => $formattedTags,
        ];

        return inertia('Finder/Edit', [
            'item' => $formattedItem
        ]);
    }
    public function createItem(Request $request)
    {

        $validatedData = $request->validate(
            [
                'itemName' => 'required|string|unique:finder_items,item,NULL,id,user_id,' . Auth::id(),
                'itemDescription' => 'nullable|string',
                'location' => 'required|string',
                'locationDescription' => 'nullable|string',
                'tags' => 'required|array|min:1', // Ensure 'tags' is an array with at least 1 item
                'tags.*' => 'string', // Each tag must be a string
            ],
            [
                'itemName.unique' => $request->itemName . ' is already in your collection'
            ]
        );

        $item = new FinderItem();
        $item->user_id = Auth::id();
        $item->item = $validatedData['itemName'];
        $item->item_description = $validatedData['itemDescription'];
        $item->location = $validatedData['location'];
        $item->location_description = $validatedData['locationDescription'];
        $item->save();

        $tags = $validatedData['tags'];
        foreach ($tags as $tagName) {
            // Find or create the tag
            $tag = FinderTag::firstOrCreate(['tag' => $tagName, 'user_id' => Auth::id()]);

            // Attach the tag to the item with user_id
            $item->tags()->attach($tag->id, ['user_id' => Auth::id()]);
        }

        return Redirect::route('finder')->with('success', 'Item added successfully');
    }

    public function updateItem(Request $request)
    {
        $validatedData = $request->validate(
            [
                'itemName' => 'required|string',
                'itemDescription' => 'nullable|string',
                'location' => 'required|string',
                'locationDescription' => 'nullable|string',
                'tags' => 'required|array|min:1', // Ensure 'tags' is an array with at least 1 item
                'tags.*' => 'string', // Each tag must be a string
            ],
            [
                'itemName.unique' => $request->itemName . ' is already in your collection'
            ]
        );

        $item = FinderItem::find($request->id);

        $item->item = $validatedData['itemName'];
        $item->item_description = $validatedData['itemDescription'] ?? null;
        $item->location = $validatedData['location'];
        $item->location_description = $validatedData['locationDescription'] ?? null;
        $item->save();
        $item->tags()->detach();
        $tags = $validatedData['tags'];
        foreach ($tags as $tagName) {
            // Find or create the tag
            $tag = FinderTag::firstOrCreate(['tag' => $tagName, 'user_id' => Auth::id()]);

            // Attach the tag to the item with user_id
            $item->tags()->attach($tag->id, ['user_id' => Auth::id()]);
        }
        return Redirect::route('finder')->with('success', 'Item Updated successfully');
    }

    public function searchItem(Request $request)
    {
        $search = $request->search;

        //provided by tabnine AI
        $items = FinderItem::with('tags')
            ->where('user_id', Auth::id())
            ->where(function ($query) use ($search) {
                $query->where('item', 'LIKE', '%' . $search . '%')
                    ->orWhere('location', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('tags', function ($query) use ($search) {
                        $query->where('tag', 'LIKE', '%' . $search . '%');
                    });
            })
            ->get();
        // $items = FinderItem::with('tags')->where('user_id', Auth::id())->where('item', 'LIKE', '%'. $search. '%')->get();

        $formattedItems = $this->formatTags($items);

        if ($items->isEmpty()) {

            return redirect()->back()->with('info', 'Found nothing...');
        }
        return inertia('Finder/Index', [
            'items' => $formattedItems
        ]);
    }

    public function sortByTags(Request $request)
    {
        $tag_id = $request->id;

        $items = FinderItem::with('tags')
            ->whereHas('tags', function ($query) use ($tag_id) {
                $query->where('finder_tags.id', $tag_id);
            })
            ->get();

        $formattedItems = $this->formatTags($items);

        return inertia('Finder/Index', [
            'items' => $formattedItems
        ]);
    }

    public function sortByLocation(Request $request)
    {
        $location = $request->location;

        $items = FinderItem::with('tags')
            ->where('user_id', Auth::id())
            ->where('location', $location)
            ->get();

        $formattedItems = $this->formatTags($items);

        return inertia('Finder/Index', [
            'items' => $formattedItems
        ]);
    }

    public function deleteItem(Request $request)
    {
        $item = FinderItem::find($request->id);
        $item->tags()->detach();
        $item->delete();
        return Redirect::route('finder')->with('success', 'Item Deleted successfully');
    }

    public function showLocations()
    {
        $locations = FinderItem::distinct('location')->where('user_id', Auth::id())->orderBy('location', 'asc')->get(['location']);
        $all_locations = $locations->pluck('location')->toArray();

        return inertia('Finder/Locations', [
            'locations' => $all_locations,
        ]);
    }

    public function updateLocation(Request $request)
    {
        $old_location = $request->oldLocation;
        $new_location = $request->newLocation;

        FinderItem::where('location', $old_location)
            ->where('user_id', Auth::id())
            ->update(['location' => $new_location]);

        return Redirect::route('finder')->with('success', 'Location Updated successfully');
    }

    public function showTags()
    {
        $tags = FinderTag::where('user_id', Auth::id())->orderBy('tag', 'asc')->get(['tag']);
        $all_tags = $tags->pluck('tag')->toArray();

        return inertia('Finder/Tags', [
            'tags' => $all_tags
        ]);
    }

    public function updateTag(Request $request)
    {
        $old_tag = $request->oldTag;
        $new_tag = $request->newTag;
        FinderTag::where('tag', $old_tag)
            ->where('user_id', Auth::id())
            ->update(['tag' => $new_tag]);

        return Redirect::route('finder')->with('success', 'Tag Updated successfully');
    }

    public function deleteTag(Request $request)
    {
        $tag = FinderTag::where('tag', $request->tag);
        $tag->delete();
        return Redirect::route('finder')->with('success', 'Tag Deleted successfully');
    }
}
