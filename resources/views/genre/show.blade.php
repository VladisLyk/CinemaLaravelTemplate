@extends('layouts.app')

@section('title') Cinema - Главная @endsection
@section('content')
    <div class="mt-2 p-5">
        <h4>Список жанров <span class="badge bg-secondary">{{$genres_count}}</span></h4>
        @if($genres_count == 0)

            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Произошла ошибка!</h4>
                <p>Невозможно отобразить список жанров!</p>
                <hr>
                <button class="btn btn-secondary genre-add" >Добавить жанры</button>
            </div>
        @else
            @foreach($genres as $genre)
                <div class="genre d-flex justify-content-between m-2">
                    <h4>
                        <b>#{{$genre->id}}</b>
                        {{$genre->name}}
                    </h4>
                    <div class="action">
                        <button type="button" onclick='location.href = "/genres/remove/{{$genre->id}}"' class="btn btn-danger removeFilm">Удалить</button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

@endsection
