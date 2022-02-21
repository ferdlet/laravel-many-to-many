@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>{{$post->title}}</h2></div>
                        
                    <div class="card-body">
                        <div class="mb-3">
                            Stato: {{$post->published ? 'Pubblicato' : 'Bozza'}}
                        </div>
                        @if ($post->category)
                            <div class="mb-3">
                                Categoria: {{$post->category->name}}
                            </div>
                        @endif 
                        {{$post->content}}
                        <div class="d-flex gap-5 mt-3">
                            <a class="mr-3" href="{{route("posts.edit", $post->id)}}"><button type="button" class="btn btn-warning">Modifica</button></a>
                            <form action="{{route("posts.destroy", $post->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection