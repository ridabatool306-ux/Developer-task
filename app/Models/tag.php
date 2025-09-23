<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    public $timestamps=false;

    protected $fillable=['name'];

    public function posts(){
        return $this->belongsTo(post::class, 'post_tags');
    }
}
