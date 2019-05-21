<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Genre;
use Illuminate\Http\Request;

class FrontController extends Controller {
    protected $paginate = 5;

    public function __construct() {
        //méthode pour injecter des données à une vue partielle
        view()->composer('partials.menu', function($view){
            $genres = Genre::pluck('name', 'id')->all(); // On récupère un tableau associatif ['id' => 0]
            $view->with('genres', $genres); // On passe les données à la vue
        });
    }

    public function index(){
        $prefix = request()->page?? 'home';
        $path = 'book' . $prefix;

        $books = \Cache::remember($path, 60*24, function(){
            //On enlève le préfixe scope de scopePublished
            return Book::published()->with('picture', 'authors')->paginate($this->paginate);
        });
        return view('front.index', ['books' => $books]);
    }
    public function show(int $id){
        $book = Book::find($id);

        return view('front.show', ['book' => $book]);
    }

    public function showBookByAuthor(int $id){
        $books = Author::find($id)->books()->paginate($this->paginate);

        return view('front.author', ['books' => $books]);
    }

    public function showBookByGenre(int $id){
        $books = Genre::find($id)->books()->paginate($this->paginate);

        return view('front.genre', ['books' => $books]);
    }
}
