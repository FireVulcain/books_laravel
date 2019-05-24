@extends('layouts.master')

@section('content')
    <div class="banner">
        @forelse($statistiques as $statistique)
            <h1>Statistiques : </h1>
            <ul class="list-group">
                <li class="list-group-item">
                    Nombre de livre(s) : {{$statistique->nb_book}}
                </li>
                <li class="list-group-item">
                    Meilleur note d'un livre : {{$statistique->best_note}} / 20
                </li>
                <li class="list-group-item">
                    Nombre d'auteurs sur le site : {{$statistique->nb_author}}
                </li>
            </ul>
        @empty
        @endforelse

    </div>
    <h1>Les tous derniers livres publiés sur notre site</h1>
    {{$books->links()}}
    <div class="best">
        <ul class="list-group">
            @forelse($bestBooks as $bBook)
                <h2>Livre avec la meilleur note : </h2>
                <li class="list-group-item">
                    <h2><a href="{{url('book', $bBook->id)}}">{{$bBook->title}}</a></h2>
                    @if(!is_null($bBook->picture) > 0)
                        <div class="row">
                            <div class="col-md-3">
                                <a href="#" class="thumbnail">
                                    <img width="200" src="{{asset('images/'.$bBook->picture->link)}}" alt="{{$bBook->picture->title}}">
                                </a>
                            </div>
                            <div class="col-md-9">
                                {{$bBook->description}}
                            </div>
                        </div>
                    @endif
                    <h3>Auteur(s) : </h3>
                    <ul>
                        @forelse($bBook->authors as $author)
                            <li><a href="{{route('author_book', [$author->id])}}">{{$author->name}} </a> - Note: {{$author->pivot->note}}/20</li>
                        @empty
                            <li>Aucun auteur</li>
                        @endforelse
                    </ul>
                </li>
            @empty
            @endforelse
        </ul>
    </div>
    <br>
    <div>
        <h2>Autre livres :</h2>
        <ul class="list-group">
            @forelse($books as $book)
                <li class="list-group-item">
                    <h2><a href="{{url('book', $book->id)}}">{{$book->title}}</a></h2>
                    @if(!is_null($book->picture) > 0)
                        <div class="row">
                            <div class="col-md-3">
                                <a href="#" class="thumbnail">
                                    <img width="200" src="{{asset('images/'.$book->picture->link)}}" alt="{{$book->picture->title}}">
                                </a>
                            </div>
                            <div class="col-md-9">
                                {{$book->description}}
                            </div>
                        </div>
                    @endif
                    <h3>Auteur(s) : </h3>
                    <ul>
                        @forelse($book->authors as $author)
                            <li><a href="{{route('author_book', [$author->id])}}">{{$author->name}} </a> - Note: {{$author->pivot->note}}/20</li>
                        @empty
                            <li>Aucun auteur</li>
                        @endforelse
                    </ul>
                </li>
            @empty
                <li>Désolé, pour l'instant aucun livre n'est publié sur le site.</li>
            @endforelse
        </ul>
    </div>
    <br>
    {{$books->links()}}
@endsection