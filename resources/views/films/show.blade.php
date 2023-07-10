@extends('layouts.app')

@section('title') Cinema - Главная @endsection
@section('content')
    <div class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="http://127.0.0.1:5173/resources/images/logo.png" alt="" width="72">
        <h1 class="display-5 fw-bold text-body-emphasis">Cinema</h1>
        <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae provident recusandae doloremque non aut debitis placeat! Sint temporibus, dolore a magni excepturi obcaecati consequatur rem unde nihil pariatur dolorum, sit odit ipsa. Ab necessitatibus sit nostrum, doloremque, ratione corrupti numquam nisi nam, nesciunt autem unde explicabo tenetur eligendi porro ut voluptatum perspiciatis. Voluptatum culpa cumque laboriosam repudiandae ducimus reiciendis libero expedita fugit recusandae incidunt.</p>
        </div>
    </div>
    <div class="mt-2 p-5">
        <div class="title d-flex justify-content-between flex-wrap">
            <h4>Список фильмов <span class="badge bg-secondary">{{$films_count}}</span></h4>
            <div>
                <div class="d-flex" role="search">
                    <input class="form-control me-2" type="text" name="search" placeholder="Найти фильм по ID" aria-label="Search">
                </div>
            </div>
            <div>
                <div class="d-flex">
                    <select class="form-select filter" id="floatingSelect" aria-label="Floating label select example">
                        @if($filter_genre == null)
                            <option value="def">Выберите жанр</option>
                        @else
                            <?php
                            $fgenre = \App\Models\Genre::find($filter_genre);
                            ?>
                            <option value="{{$fgenre->id}}">{{$fgenre->name}}</option>
                        @endif
                        @foreach($genres as $genre)
                        @if($filter_genre != $genre->id)
                            <option value="{{$genre->id}}">{{$genre->name}}</option>
                        @endif
                    @endforeach
                    </select>
                    <button type="button" class="btn btn-secondary clear">Очистить</button>
                </div>
            </div>
            <script>
                $(".filter").change(function (e) { 
                    e.preventDefault();
                    if($(this).val() != "def") {
                        location.href = "?genre=" + $(this).val();
                    } else {
                        location.href = "/";
                    }
                });
                $(".clear").click(function (e) { 
                    e.preventDefault();
                    location.href = "/";
                });
            </script>
            <nav class="">
                <ul class="pagination">
                    @if($films->currentPage() == 1)
                    <li class="page-item disabled">
                        <a class="page-link">Предыдущая</a>
                      </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{$films->previousPageUrl()}}">Предыдущая</a>
                    </li>
                    @endif

                    @for ($i = 1; $i <= $films->lastPage(); $i++)
                        @if($films->currentPage() == $i)
                            <li class="page-item"><a class="page-link active">{{$i}}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="?page={{$i}}">{{$i}}</a></li>
                        @endif
                    @endfor

                    @if($films->currentPage() == $films->lastPage())
                        <li class="page-item disabled">
                            <a class="page-link">Следующая</a>
                        </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{$films->nextPageUrl()}}">Следующая</a>
                    </li>
                    @endif
                </ul>
            </nav>  
        </div>
        <div class="films">
            @if($genres_count == 0)

            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Произошла ошибка!</h4>
                <p>Невозможно отобразить список фильмов не имея жанров.</p>
                <hr>
                <button class="btn btn-secondary genre-add" >Добавить жанры</button>
            </div>
            @else
            @if($films_count == 0)

            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Произошла ошибка!</h4>
                <p>Невозможно отобразить список фильмов не имея фильмов.</p>
                <hr>
                <button class="btn btn-secondary film-add" >Добавить фильм</button>
            </div>
            @else 

                @foreach($films as $film)
                <?php
                    $genre = \App\Models\Genre::find($film["genre"]);
                    $hided = "";
                    if(!$film["status"]) {
                        $hided = "hide";
                    }
                ?>
                <div class="premiere {{$hided}}" id="{{$film["id"]}}" style="        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)) ,url('{{ asset('images/'.$film->poster) }}');">
                    <div class="body m-auto ps-5">
                        <div class="title">
                            <h1>Фильм "{{$film["name"]}}"</h1>
                            <p>Жанр: {{ $genre->name }}</p>
                        </div>
                        <div class="descr w-50">
                            <h4>Краткое описание:</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, quaerat. Totam tenetur laboriosam dolorum ea cupiditate a, assumenda ipsum officiis porro sequi, maiores, esse minus nostrum illo ullam nihil. In ipsam molestiae tempore eius eveniet asperiores expedita est aspernatur, id adipisci architecto non nostrum? Neque excepturi reiciendis explicabo molestiae aliquid eos provident quos repellendus, quis a ullam inventore tempora quam rem blanditiis saepe labore!</p>
                        </div>
                        <div class="actions">
                            <button type="button" onclick='location.href = "/films/edit/{{$film["id"]}}"' class="btn btn-secondary editFilm">Редактировать</button>
                            @if ($film["status"])
                                <button type="button" onclick='location.href = "/films/status/{{$film["id"]}}/0"' class="btn btn-primary hideFilm">Скрыть</button>
                            @else
                                <button type="button" onclick='location.href = "/films/status/{{$film["id"]}}/1"' class="btn btn-primary unhideFilm">Опубликовать</button>
                            @endif
                            <button type="button" onclick='location.href = "/films/remove/{{$film["id"]}}"' class="btn btn-danger removeFilm">Удалить</button>
                        </div>
                    </div>
                    <div class="hided">
                        <div class="alert alert-warning" role="alert">
                            <strong>Обратите внимание!</strong> Данный фильм неопубликован!
                        </div>
                        
                    </div>
                </div>
                @endforeach

                @endif
            @endif 
        </div>
    </div>
@endsection
