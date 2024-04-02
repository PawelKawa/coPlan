<?php

namespace App\Http\Controllers;

use App\Models\FinderItem;
use App\Models\FinderTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FinderItemsController extends Controller
{
    public function showItems(Request $request)
    {
        return inertia('Finder');
    }
    public function updateFinder(Request $request)
    {
        Log::info($request->all());

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

        return redirect()->back()->with('success', 'Added item successfully');
    }
}
