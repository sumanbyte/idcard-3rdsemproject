<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <?php
        session_start();



        if (isset($_SESSION["email"])) {
          echo '
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="profile.php">Student Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin.php">College Login</a>
        </li>
        ';
        }

        if (isset($_SESSION["admin"])) {


          echo '<li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">College Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="login.php">Student Login</a>
        </li>
        ';
        }

        if (!isset($_SESSION["email"]) && !isset($_SESSION["admin"])) {
          echo '<li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">College Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="login.php">Student Login</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="profile.php">Student Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="admin.php">College Login</a>
      </li>
        ';
        }

        ?>




      </ul>
      <form class="d-flex" role="search">
        <?php
        if (isset($_SESSION["email"]) || isset($_SESSION["admin"])) {
          if (isset($_SESSION["email"])) {
            echo "<p class='mr-2'>logged in as student</p>";
          } else {
            echo "<p class='mr-2'>logged in as admin</p>";
          }
          echo '<a class="btn btn-outline-danger" href="logout.php">Logout</a>';
        } else {
          echo "<p>You are not currently logged in</p>";
        }



        ?>

      </form>
    </div>
  </div>
</nav>