<header class="d-flex flex-wrap justify-content-center py-3 p-4 mb-4 border-bottom">
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
    <span class="fs-4">Cinema</span>
  </a>

  <ul class="nav nav-pills">
    @if ($route == "show")
      <li class="nav-item"><a href="/" class="nav-link active" aria-current="page">Главная</a></li>
      <li class="nav-item"><a href="/films/add" class="nav-link">Добавить фильм</a></li>
      <li class="nav-item"><a href="/films/add" class="nav-link">Добавить жанр</a></li>
      <li class="nav-item"><a href="/genres" class="nav-link">Жанры</a></li>
    @endif
    @if ($route == "addfilm")
      <li class="nav-item"><a href="/" class="nav-link" aria-current="page">Главная</a></li>
      <li class="nav-item"><a href="/films/add" class="nav-link active">Добавить фильм</a></li>
      <li class="nav-item"><a href="/genres/add" class="nav-link">Добавить жанр</a></li>
      <li class="nav-item"><a href="/genres" class="nav-link">Жанры</a></li>
    @endif
    @if ($route == "addgenre")
      <li class="nav-item"><a href="/" class="nav-link" aria-current="page">Главная</a></li>
      <li class="nav-item"><a href="/films/add" class="nav-link">Добавить фильм</a></li>
      <li class="nav-item"><a href="/genres/add" class="nav-link active">Добавить жанр</a></li>
      <li class="nav-item"><a href="/genres" class="nav-link">Жанры</a></li>
    @endif
    @if ($route == "showgenre")
    <li class="nav-item"><a href="/" class="nav-link" aria-current="page">Главная</a></li>
    <li class="nav-item"><a href="/films/add" class="nav-link">Добавить фильм</a></li>
    <li class="nav-item"><a href="/genres/add" class="nav-link ">Добавить жанр</a></li>
    <li class="nav-item"><a href="/genres/" class="nav-link active">Жанры</a></li>    
  @endif
  
  </ul>
</header>