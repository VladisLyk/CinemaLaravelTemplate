@extends('layouts.app')

@section('title') Cinema - Фильмы @endsection
@section('content')
    <div class="p-5">
        <h1>Добавление жанра</h1>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <strong>Ошибка!</strong> {{$error}}
                </div>
                
            @endforeach
        @endif
        <form action="/genres/check" method="post" class="d-block w-50">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Название жанра</label>
                @csrf
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Например: Хоррор</div>
              </div>
              <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
