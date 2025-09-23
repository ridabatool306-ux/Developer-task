<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(tag::class, 'post_tags');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->latest();;
    }

}
