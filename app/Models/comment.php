<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable = ['post_id', 'user_id', 'comment', 'parent_id'];

    public function post()
    {
        return $this->belongsTo(post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Parent comment
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Nested replies ke liye
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
