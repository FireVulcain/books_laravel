<?php

use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \App\Genre::create([
            'name' => 'science'
        ]);
        \App\Genre::create([
            'name' => 'maths'
        ]);
        \App\Genre::create([
            'name' => 'cookbook'
        ]);

        // Création de 30 livres à partir de la factory
        factory(\App\Book::class, 30)->create()->each(function($book){
            // Pour chaque book (each book), on genere un genre random
            $genre = \App\Genre::find(rand(1, 3));

            // Pour chaque book, on lui associe le genre qu'on vient de generer
            $book->genre()->associate($genre);
            $book->save(); // il faut sauvegarder l'association pour faire persister en base de données

            // ajout des images
            $link = str_random(12) . '.jpg'; // hash de lien pour la sécurité (injection de scripts protection)
            //$file = file_get_contents('https://picsum.photos/id/'.rand(1,9).'/200/300');
            $file = file_get_contents('https://via.placeholder.com/200/300');
            Storage::disk('local')->put($link, $file);

            $book->picture()->create([
                 'link' => $link,
                 'title' => 'Default'
            ]);


            /*
            **  The pluck method retrieves all of the values for a given key
            **  La méthode pluck est particulière on l’utilise pour récupérer une collection (tableau array). Lorsque
            **  vous faites un App\Author::all() vous récupérez certes tous les auteurs mais vous êtes dans le
            **  modèle. Ce n’est pas la même chose.
            */
            // les méthodes shuffle et slice permettent de mélanger et récupérer un certain
            // nombre 3 à partir de l'indice 0, comme ils sont mélangés à chaque fois qu'un livre est créé
            // on aura des id à chaque fois aléatoires.
            // La méthode all permet de faire la requête et de récupérer le résultat sous forme d'un tableau
            $authors = \App\Author::pluck('id')->shuffle()->slice(0, rand(1, 3))->all();

            $relationPivotAuthor= [];
            foreach ($authors as $id) {
                $relationPivotAuthor[$id] = ['note' => rand(5,19) + rand(0,9)/10 ];
            }
            $book->authors()->attach($relationPivotAuthor);

        });
    }
}
