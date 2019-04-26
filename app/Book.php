<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {

    protected $fillable = [
      'title', 'description', 'genre_id', 'status'
    ];

    public function setGenreIdAttribute($value){
        if($value == 0){
            $this->attributes['genre_id'] = null;
        }else{
            $this->attributes['genre_id'] = $value;
        }
    }

    public function scopePublished($query){
        return $query->where('status', 'published');
    }

    public function genre(){
        return $this->belongsTo(Genre::class);
    }
    public function authors(){
        return $this->belongsToMany(Author::class)->withPivot('note');
    }
    public function picture(){
        return $this->hasOne(Picture::class);
    }
}
