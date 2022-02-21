@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{$category->name}}</h2>
                    </div>
                        
                    <div class="card-body">
                        <div class="d-flex gap-5 mt-3">
                            <a class="mr-3" href="{{route("categories.edit", $category->id)}}"><button type="button" class="btn btn-warning">Modifica</button></a>
                            <form action="{{route("categories.destroy", $category->id)}}" method="POST">
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