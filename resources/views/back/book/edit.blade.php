@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('book.update', $book->id)}}" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Create Book :</h1>
                        {{ csrf_field() }}
                        {{method_field('PUT')}}
                        <div class="form">
                            <div class="form-group">
                                <label for="title">Titre :</label>
                                <input class="form-control" type="text" id="title" name="title" value="{{$book->title}}">
                                @if($errors->has('title')) <span class="alert-danger">{{$errors->first('title')}}</span>@endif
                            </div>
                            <div class="form-group">
                                <label for="description">Description :</label>
                                <textarea name="description" id="description" class="form-control">{{$book->description}}</textarea>
                                @if($errors->has('description')) <span class="alert-danger">{{$errors->first('description')}}</span>@endif
                            </div>
                            <div class="form-select">
                                <label for="genre_id">Genre : </label>
                                <select name="genre_id" id="genre_id">
                                    <option value="0" {{is_null($book->genre)? 'selected' : ''}}>No genre</option>
                                    @forelse($genres as $id => $name)
                                        <option {{ ($book->genre_id == $id)? 'selected' : '' }}  value="{{$id}}">{{ucfirst($name)}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <h1>Choisissez un/des auteurs</h1>
                                @forelse($authors as $id => $name)
                                    <div class="form-check form-check-inline">
                                        <input name="authors[]" value="{{$id}}"
                                               @if(in_array($id, $book->authors()->pluck('id')->all()))
                                               checked
                                               @endif
                                               type="checkbox" class="form-check-input"
                                               id="author{{$id}}">
                                        <label class="form-check-label" for="author{{$id}}">{{$name}}</label>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2>Status</h2>
                        <div class="custom-radio">
                            <input type="radio" name="status" value="published" @if($book->status == 'published') checked @endif> Published <br>
                            <input type="radio" name="status" value="unpublished" @if($book->status == 'unpublished') checked @endif> Unpublished
                        </div>
                        <div class="custom-file">
                            <h2>File : </h2>
                            <input type="file" class="file" name="picture">
                            @if($errors->has('picture')) <span class="alert-danger">{{$erros->first('picture')}}</span>@endif
                        </div>
                        <div class="custom-file" style="height: 250px;">
                            <h2>Image associée : </h2>
                            @if($book->picture) <img width="200" src="{{asset('images/'.$book->picture->link)}}" alt="{{$book->picture->title}}"> @endif
                        </div>
                        <div class="custom-file">
                            <button style="display: inline-block; margin-top: 15px;" class="btn btn-primary" type="submit">Modifier un livre</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection