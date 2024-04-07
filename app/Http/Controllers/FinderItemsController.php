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

    public function updateItem(Request $request){
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
        $item->item_description = $validatedData['itemDescription'];
        $item->location = $validatedData['location'];
        $item->location_description = $validatedData['locationDescription'];
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
                ->orWhereHas('tags', function ($query) use ($search) {
                    $query->where('tag', 'LIKE', '%' . $search . '%');
                });
        })
        ->get();
        // $items = FinderItem::with('tags')->where('user_id', Auth::id())->where('item', 'LIKE', '%'. $search. '%')->get();

        $formattedItems = $this->formatTags($items);

        if($items->isEmpty()){
            Log::info('not found');
            return redirect()->back()->with('info', 'Found nothing...');

        }
        return inertia('Finder/Index', [
            'items' => $formattedItems
        ]);
    }
    
}