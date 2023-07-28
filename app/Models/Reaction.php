<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'post_id',
        'reaction_type'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
