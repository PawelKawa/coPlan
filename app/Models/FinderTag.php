<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinderTag extends Model
{
    use HasFactory;

    protected $table = 'finder_tags';

    public function items()
    {
        return $this->belongsToMany(FinderItem::class, 'finder_item_tag', 'tag_id', 'item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
