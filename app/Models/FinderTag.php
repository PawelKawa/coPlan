<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinderTag extends Model
{
    use HasFactory;
    public function items()
    {
        return $this->belongsToMany(FinderItem::class, 'finder_item_tag');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
