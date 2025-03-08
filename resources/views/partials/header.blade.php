<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">TerraBooks</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/books">Books</a></li>
          <li><a href="/genres">Genres</a></li>
          @guest
          <li><a href="/login">Login</a></li>
          <li><a href="/register">Register</a></li>
          @endguest
          @auth
            <form action="/logout" method="post">
            @csrf
            <input type="submit" value="Logout" class="btn btn-dager">
          </form>
          @endauth
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>