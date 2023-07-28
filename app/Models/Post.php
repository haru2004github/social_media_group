<?php

namespace App\Models;


use App\Models\Reaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'view_count',
        'reaction_count',
        'comment_count',
        'user_id',
        'saver_id',
        'reactor_id',
        'activity_id',
        'feeling_id',
        'post_approve',
        'status'
    ];



    public function reactions()
    {
        return $this->belongsTo(Reaction::class);
    }

}
