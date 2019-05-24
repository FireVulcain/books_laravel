<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Genre;
use App\Statistique;
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

        $bestNote = Book::bestRanking()->book_id;

        $books = Book::published()->with('picture', 'authors')->where('id', '!=', $bestNote)->paginate($this->paginate);
        $bestBooks = Book::published()->with('picture', 'authors')->where('id', '=', $bestNote)->paginate($this->paginate);

        $statistiques = Statistique::all();


        return view('front.index', ['books' => $books, 'bestBooks' => $bestBooks, 'statistiques' => $statistiques]);
    }
    public function show(int $id){
        $book = Book::find($id);

        return view('front.show', ['book' => $book]);
    }

    public function showBookByAuthor(int $id){
        $books = Author::find($id)->books()->published()->paginate($this->paginate);
        $author= Author::find($id);

        return view('front.author', ['books' => $books, 'author' => $author]);
    }

    public function showBookByGenre(int $id){
        $books = Genre::find($id)->books()->published()->paginate($this->paginate);

        return view('front.genre', ['books' => $books]);
    }
}