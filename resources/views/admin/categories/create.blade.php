@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Nuova Categoria</div>

                        <div class="card-body">
                            
                            <form action="{{route("categories.store")}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome della categoria" value="{{old('name')}}">
                                    @error('name')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Salva</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection