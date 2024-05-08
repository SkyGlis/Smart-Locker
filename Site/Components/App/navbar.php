<nav class="navbar sticked-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="fa-light fa-lock"></i> Smart Locker</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><i class="fa-light fa-compass"></i> Menu Inicial</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/pap/index.php"><i class="fa-light fa-house"></i> Página Inicial</a>
            </li>
            <?php session_start(); if($_SESSION['isLogged']) { $user = $_SESSION['user']; $id = $user['id']; $name = $user['name']; ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/pap/dashboard.php"><i class="fa-light fa-table-columns"></i> Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/pap/logout.php"><i class="fa-light fa-door-open"></i> Terminar Sessão</a>
              </li>
            <?php } else { ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/pap/login.php"><i class="fa-light fa-right-to-bracket"></i> Iniciar Sessão</a>
              </li>
            <?php } ?>
          <ul>
      </div>
    </div>
  </div>
</nav>