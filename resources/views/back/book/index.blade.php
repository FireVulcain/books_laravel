@extends('layouts.master')

@section('content')
    <a href="{{route('book.create')}}" style="display: inline-block;margin-bottom: 10px;"><button class="btn btn-primary">Ajouter un livre</button></a>
    {{$books->links()}}
    @include('back.book.partials.flash')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Authors</th>
            <th>Genre</th>
            <th>Date de publication</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Show</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @forelse($books as $book)
            <tr>
                <td><a href="{{route('book.edit', $book->id)}}">{{$book->title}}</a></td>
                <td>
                    @forelse($book->authors as $author)
                        {{$author->name}} /
                    @empty
                        Aucun auteur
                    @endforelse
                </td>
                <td>{{ucfirst($book->genre->name?? 'aucun genre')}}</td>
                <td>{{$book->created_at}}</td>
                <td>
                    @if($book->status == 'published')
                        <button type="button" class="btn btn-success">published</button>
                    @else
                        <button type="button" class="btn btn-warning">unpublished</button>
                    @endif
                </td>
                <td><a href="{{route('book.edit', $book->id)}}">Edit</a></td>
                <td>
                    <a href="{{route('book.show', $book->id)}}">Show</a>
                </td>
                <td>
                    <form class="delete" method="POST" action="{{route('book.destroy', $book->id)}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <input class="btn-danger" type="submit" value="Delete"/>
                    </form>
                </td>
            </tr>
        @empty
            Aucun titre
        @endforelse
        </tbody>
    </table>
    {{$books->links()}}
@endsection
@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection