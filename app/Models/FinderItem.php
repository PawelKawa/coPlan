<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinderItem extends Model
{
    use HasFactory;

    protected $table = 'finder_items';

    public function tags()
    {
        return $this->belongsToMany(FinderTag::class, 'finder_item_tag', 'item_id', 'tag_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
