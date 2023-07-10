@if(!$finded)

<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Произошла ошибка!</h4>
    <p>Не найдено результатов за данным ID</p>
</div>
@else 
    <?php
        $genre = \App\Models\Genre::find($film->genre);
        $hided = "";
        if(!$film->status) {
            $hided = "hide";
        }
    ?>
    <div class="premiere {{$hided}}" id="{{$film->id}}" style="        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)) ,url('{{ asset('images/'.$film->poster) }}');">
        <div class="body m-auto ps-5">
            <div class="title">
                <h1>Фильм "{{$film->name}}"</h1>
                <p>Жанр: {{ $genre->name }}</p>
            </div>
            <div class="descr w-50">
                <h4>Краткое описание:</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, quaerat. Totam tenetur laboriosam dolorum ea cupiditate a, assumenda ipsum officiis porro sequi, maiores, esse minus nostrum illo ullam nihil. In ipsam molestiae tempore eius eveniet asperiores expedita est aspernatur, id adipisci architecto non nostrum? Neque excepturi reiciendis explicabo molestiae aliquid eos provident quos repellendus, quis a ullam inventore tempora quam rem blanditiis saepe labore!</p>
            </div>
            <div class="actions">
                <button type="button" onclick='location.href = "/films/edit/{{$film->id}}"' class="btn btn-secondary editFilm">Редактировать</button>
                @if ($film->status)
                    <button type="button" onclick='location.href = "/films/status/{{$film->id}}/0"' class="btn btn-primary hideFilm">Скрыть</button>
                @else
                    <button type="button" onclick='location.href = "/films/status/{{$film->id}}/1"' class="btn btn-primary unhideFilm">Опубликовать</button>
                @endif
                <button type="button" onclick='location.href = "/films/remove/{{$film->id}}"' class="btn btn-danger removeFilm">Удалить</button>
            </div>
        </div>
        <div class="hided">
            <div class="alert alert-warning" role="alert">
                <strong>Обратите внимание!</strong> Данный фильм неопубликован!
            </div>
            
        </div>
    </div>
@endif 