@extends('layouts.master')

@section('content')
    <h1>Tous les livres de l'auteur : </h1>
    {{$books->links()}}
    <ul class="list-group">
        @forelse($books as $book)
            <li class="list-group-item">
                <h2><a href="{{url('book', $book->id)}}">{{$book->title}}</a></h2>
                <div class="row">
                    @if(!empty($book->picture))
                        <div class="col-md-3">
                            <a href="#" class="thumbnail">
                                <img width="200" src="{{asset('images/'.$book->picture->link)}}" alt="{{$book->picture->title}}">
                            </a>
                        </div>
                    @endif
                    <div class="col-md-9">
                        <h2>Description</h2>
                        {{$book->description}}
                    </div>
                </div>
            </li>
        @empty
            <li>Désolé, pour l'instant aucun livre n'est publié sur le site</li>
        @endforelse
    </ul>
    {{$books->links()}}
@endsection 