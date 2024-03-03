<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinderItem extends Model
{
    use HasFactory;
    public function tags()
    {
        return $this->belongsToMany(FinderTag::class, 'finder_item_tag');
    }

    public function location()
    {
        return $this->belongsTo(FinderLocation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
