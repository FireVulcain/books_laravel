@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('book.store')}}" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Create Book :</h1>
                        {{csrf_field()}}
                        <div class="form">
                            <div class="form-group">
                                <label for="title">Titre :</label>
                                <input class="form-control" type="text" id="title" name="title" value="{{old('title')}}">
                                @if($errors->has('title')) <span class="alert-danger">{{$errors->first('title')}}</span>@endif
                            </div>
                            <div class="form-group">
                                <label for="description">Description :</label>
                                <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
                                @if($errors->has('description')) <span class="alert-danger">{{$errors->first('description')}}</span>@endif
                            </div>
                            <div class="form-select">
                                <label for="genre_id">Genre : </label>
                                <select name="genre_id" id="genre_id">
                                    <option value="0" {{is_null(old('genre_id')) ? 'selected' : ''}} selected>Pas de genre</option>
                                    @forelse($genres as $id => $name)
                                        <option {{ old('genre_id')==$id? 'selected' : '' }} value="{{$id}}">{{ucfirst($name)}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <h1>Choisissez un/des auteurs</h1>
                                @forelse($authors as $id => $name)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="authors[]" id="authors{{$id}}" value="{{$id}}" {{ ( !empty(old('authors')) and in_array($id, old('authors')) ) ? 'checked' : ''  }}>
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
                            <input type="radio" name="status" value="published" @if(old('status') == 'published') checked @endif checked> Published <br>
                            <input type="radio" name="status" value="unpublished" @if(old('status') == 'unpublished') checked @endif> Unpublished
                        </div>
                        <div class="custom-file">
                            <h2>File : </h2>
                            <input type="text" class="input" name="title_image" id="title_image" placeholder="Titre de l'image"> <br> <br>
                            <input type="file" class="file" name="picture">
                            @if($errors->has('picture')) <span class="alert-danger">{{$erros->first('picture')}}</span>@endif
                        </div>
                        <button style="display: inline-block; margin-top: 15px;" class="btn btn-primary" type="submit">Ajouter un livre</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection