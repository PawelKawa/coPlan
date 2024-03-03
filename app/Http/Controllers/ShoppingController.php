<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ShoppingController extends Controller
{
    public function getShopping()
    {

        $nextListJson = Shopping::where('user_id', Auth::id())->value('next_items');
        $nextListArray = json_decode($nextListJson, true);
        $newNextListArray = [];
        if($nextListArray !== null){
            foreach ($nextListArray as $item) {
                $newItem = [
                    'text' => $item,
                    'inBasket' => false, 
                ];
                $newNextListArray[] = $newItem;
            }
        }

        $someListJson = Shopping::where('user_id', Auth::id())->value('some_items');
        $someListArray = json_decode($someListJson, true);
        $newSomeListArray = [];
        if($someListArray!== null){

            foreach ($someListArray as $item) {
                $newItem = [
                    'text' => $item,
                    'inBasket' => false, 
                ];
                $newSomeListArray[] = $newItem;
            }
        }

        return inertia('Shopping', [
            'nextTimeList' => $newNextListArray,
            'someTimeList' => $newSomeListArray
        ]);
    }

    public function updateShoppingList(Request $request)
    {
        $nextItems = $request->input('nextItems');
        $someItems = $request->input('someItems');
    
        // Check if the next and some items are different from the current ones
        $currentNextItems = Shopping::where('user_id', Auth::id())->value('next_items');
        $currentNextItemsArray = json_decode($currentNextItems, true);
        $currentSomeItems = Shopping::where('user_id', Auth::id())->value('some_items');
        $currentSomeItemsArray = json_decode($currentSomeItems, true);
    
        if ($nextItems !== $currentNextItemsArray || $someItems !== $currentSomeItemsArray) {
            // Update the shopping list only if there are changes
            Shopping::where('user_id', Auth::id())->update([
                'next_items' => $nextItems,
                'some_items' => $someItems,
            ]);
    
            return redirect()->back()->with('success', 'Shopping list updated successfully');
        }
    
        // If there are no changes, simply redirect back without updating
        return redirect()->back()->with('info', 'Whoo nothing to update here');
    }
}
