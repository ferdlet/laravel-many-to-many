@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifica Post: {{$category->name}}</div>

                        <div class="card-body">
                            
                            <form action="{{route("categories.update", $category->id)}}" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label for="name">Titolo</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il titolo" value="{{old('name') ? old('name') : $category->name}}">
                                    @error('name')
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