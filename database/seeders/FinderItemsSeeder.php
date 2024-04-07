<?php

namespace Database\Seeders;

use App\Models\FinderItem;
use App\Models\FinderTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Computer',
            'Laptop',
            'Work',
            'Display',
            'Monitor',
            'Kitchen Appliance',
            'Coffee',
            'Breakfast',
            'Kitchen Utensil',
            'Cooking',
            'Office Supply',
            'Utensil',
            'Kitchenware',
        ];
        foreach ($tags as $tagName) {
            FinderTag::firstOrCreate([
                'tag' => $tagName,
                'user_id' => 5,
            ]);
        }

        $items = [
            [
                'user_id' => 5,
                'item' => 'Laptop',
                'item_description' => 'Working Laptop',
                'location' => 'Office',
                'location_description' => 'On the desk',
            ],
            [
                'user_id' => 5,
                'item' => 'Laptop',
                'item_description' => 'Working Laptop',
                'location' => 'Office',
                'location_description' => 'On the desk',
            ],
            [
                'user_id' => 5,
                'item' => 'Desktop PC',
                'item_description' => 'High-performance computer',
                'location' => 'Office',
                'location_description' => 'Under the desk',
            ],
            [
                'user_id' => 5,
                'item' => 'Monitor',
                'item_description' => '24-inch LED monitor',
                'location' => 'Office',
                'location_description' => 'On the desk (connected to Laptop)',
            ],
            [
                'user_id' => 5,
                'item' => 'Stapler',
                'item_description' => 'For stapling documents',
                'location' => 'Office',
                'location_description' => 'In the desk drawer',
            ],
            [
                'user_id' => 5,
                'item' => 'Coffee Maker',
                'item_description' => 'Brews delicious coffee',
                'location' => 'Kitchen',
                'location_description' => 'On the counter',
            ],
            [
                'user_id' => 5,
                'item' => 'Pen Holder',
                'item_description' => 'Holds pens and pencils',
                'location' => 'Office',
                'location_description' => 'On the desk',
            ],
            [
                'user_id' => 5,
                'item' => 'Toaster',
                'item_description' => 'makes perfect toast',
                'location' => 'Kitchen',
                'location_description' => 'On the counter (next to Coffee Maker)',
            ],
            [
                'user_id' => 5,
                'item' => 'Knife Set',
                'item_description' => 'Sharp and versatile knives',
                'location' => 'Kitchen',
                'location_description' => 'In a drawer',
            ],

            [
                'user_id' => 5,
                'item' => 'Plates',
                'item_description' => 'Set of dinner plates',
                'location' => 'Kitchen',
                'location_description' => 'In a cabinet',
            ],
            [
                'user_id' => 5,
                'item' => 'Spoons',
                'item_description' => 'Set of tablespoons and teaspoons',
                'location' => 'Kitchen',
                'location_description' => 'In a drawer (next to Knife Set)',
            ],
        ];
        foreach ($items as $item) {
            FinderItem::insert($item);
        }
    }
}
