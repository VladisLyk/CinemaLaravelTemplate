@extends('layouts.app')

@section('title') Cinema - Фильмы @endsection
@section('content')
    <div class="p-5">
        <h1>Редактирование фильма</h1>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <strong>Ошибка!</strong> {{$error}}
                </div>
                
            @endforeach
        @endif
        <form action="/films/edit/check" method="post" enctype="multipart/form-data" class="d-block w-50">
            <input type="hidden" class="form-control" name="id" id="inputName" value="{{$film->id}}">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Название фильма</label>
                <input type="text" class="form-control" name="fname" id="exampleInputEmail1" value="{{$film->name}}" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Например: Титаник 2</div>
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="poster" class="form-label">Постер (Оставьте поле пустым, если нехотите менять постер)</label>
                    <input class="form-control" name="poster" type="file" id="poster">
                  </div>
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Жанр</label>
                <?php
                    $genre = \App\Models\Genre::find($film->genre);
                    $genres = \App\Models\Genre::all();
                ?>
                <select class="form-select" name="genre" id="genre">
                    <option selected value="{{$genre->id}}">{{$genre->name}}</option>
                    @foreach($genres as $agenre)

                        @if($agenre != $genre)
                            <option value="{{$agenre->id}}">{{$agenre->name}}</option>
                        @endif

                    @endforeach
                  </select>
            </div>
              <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
