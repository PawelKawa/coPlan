<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShoppingController extends Controller
{
    public function getShopping(Request $request)
    {
        $nextListJson = Shopping::where('id', 1)->value('next_items');
        $nextListArray = json_decode($nextListJson, true);
        $newNextListArray = [];
        foreach ($nextListArray as $item) {
            $newItem = [
                'text' => $item,
                'inBasket' => false, 
            ];
            $newNextListArray[] = $newItem;
        }

        $someListJson = Shopping::where('id', 1)->value('some_items');
        $someListArray = json_decode($someListJson, true);
        $newSomeListArray = [];
        foreach ($someListArray as $item) {
            $newItem = [
                'text' => $item,
                'inBasket' => false, 
            ];
            $newSomeListArray[] = $newItem;
        }

        return inertia('Shopping', [
            'nextTimeList' => $newNextListArray,
            'someTimeList' => $newSomeListArray
        ]);
    }

    public function updateShoppingList(Request $request)
    {
        Shopping::where('id', 1)->update([
            'next_items' => $request->input('nextItems'),
            'some_items' => $request->input('someItems'),
        ]);

        return redirect()->back();
    }
}
