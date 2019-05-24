<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

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

    public function genre(){
        return $this->belongsTo(Genre::class);
    }
    public function authors(){
        return $this->belongsToMany(Author::class)->withPivot('note');
    }
    public function picture(){
        return $this->hasOne(Picture::class);
    }
    public function statistiques(){
        return $this->belongsToMany(Statistique::class);
    }

    public function scopePublished($query){
        return $query->where('status', 'published');
    }

    public function scopeBestRanking(){
        //$query = DB::raw("SELECT t2.* FROM  ( SELECT book_id, avg(note) AS note_avg FROM author_book GROUP BY book_id ) AS t2 WHERE note_avg = ( SELECT max(note_avg) FROM ( SELECT book_id, avg(note) AS note_avg FROM author_book WHERE author_book.status = 'published' GROUP BY book_id ) AS t1 )");
        $query = DB::raw("SELECT t2.* FROM ( SELECT book_id, avg(note) AS note_avg FROM author_book GROUP BY book_id ) AS t2 WHERE note_avg = ( SELECT max(note_avg) FROM ( SELECT book_id, avg(note) AS note_avg, status FROM author_book WHERE author_book.status = 'published' GROUP BY book_id ) AS t1 )");
        return DB::select($query)[0];
    }
    public function scopeNumberBook(){
        $query = DB::raw("SELECT COUNT(id) as number FROM books");
        return DB::select($query)[0];
    }
    public function scopeNumberAuthor(){
        $query = DB::raw("SELECT COUNT(id) as number FROM authors");
        return DB::select($query)[0];
    }
}