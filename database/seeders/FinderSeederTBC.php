<?php

namespace Database\Seeders;

use App\Models\FinderItem;
use App\Models\FinderTag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    public function run()
    {
        //Need to have user_id 1, this is going to be showroom(?) user.
        // Insert item
        $wallet = FinderItem::create([
            'user_id' => 1,
            'item' => 'Wallet',
            'item_description' => 'description of item',
            'location' => 'room',
            'location_description' => 'description to the room',
        ]);

        // Find or create tags for user_id 1
        $leatherTag = FinderTag::firstOrCreate(['name' => 'leather', 'user_id' => 1]);
        $oldTag = FinderTag::firstOrCreate(['name' => 'old', 'user_id' => 1]);

        // Insert entries into the pivot table
        DB::table('finder_item_tag')->insert([
            ['item_id' => $wallet->id, 'tag_id' => $leatherTag->id, 'user_id' => 1],
            ['item_id' => $wallet->id, 'tag_id' => $oldTag->id, 'user_id' => 1],
        ]);
    }
}
