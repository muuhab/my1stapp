<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){

        return $this->belongsTo('App\User');
    }
    public function categories(){

        return $this->belongsTo('App\Category','category_id');

    }
    public function tags(){

        return $this->belongsToMany(Tag::class);
    }
}
