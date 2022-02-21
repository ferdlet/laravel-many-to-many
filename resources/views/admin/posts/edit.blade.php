@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifica Post: {{$post->title}}</div>

                        <div class="card-body">
                            
                            <form action="{{route("posts.update", $post->id)}}" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label for="title">Titolo</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Inserisci il titolo" value="{{old('title') ? old('title') : $post->title}}">
                                    @error('title')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="content">Contenuto Post</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="8" placeholder="Inserisci il testo">{{old('content') ? old('content') : $post->content}}</textarea>
                                    @error('content')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Categorie</label>
                                    <select class="custom-select @error ('category_id') is-invalid @enderror" name="category_id" id="category">
                                        <option value="">Seleziona una categoria</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}" {{old("category_id") == $category-> id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-check mb-3">
                                    @php
                                        $published = old('published') ? old('published') : $post->published;
                                    @endphp
                                    <input class="form-check-input @error('published') is-invalid @enderror" type="checkbox" name="published" id="published" {{$published ? 'checked' : '' }}>
                                    <label class="form-check-label" for="published">Pubblicato</label>
                                    @error('published')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Modifica</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection