@extends('layouts.master')

@section('content')
    <h2>{{$book->title}}</h2>
    @if(!is_null($book->picture))
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="#" class="thumbnail">
                    <img width="200" src="{{asset('images/'.$book->picture->link)}}" alt="{{$book->picture->title}}">
                </a>
            </div>
            <div class="col-md-12">
                <h3>Description :</h3>
                {{$book->description}}
            </div>
            <div class="col-md-12">
                <h3>Auteur(s) :</h3>
                <ul>
                    @forelse($book->authors as $author)
                        <li><a href="{{route('author_book', [$author->id])}}">{{$author->name}} </a> - Note: {{$author->pivot->note}}/20</li>
                    @empty
                        <li>Aucun auteur</li>
                    @endforelse
                </ul>
            </div>
        </div>
    @endif
@endsection