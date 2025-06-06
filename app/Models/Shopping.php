<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;

    protected $table = 'shopping_lists'; 
    
    protected $fillable = [
        'user_id',
        'next_items',
        'some_items',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
