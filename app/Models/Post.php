<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function language(){
        return $this->belongsTo(Language::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function alerts(){
        return $this->hasMany(Alert::class);
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    public function views(){
        return $this->hasMany(View::class);
    }

    public function tags(){
        // , 'post_tag', 'post-id', 'tag_id'
        return $this->belongsToMany(Tag::class);
    }

}
