<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><span>SuperKviz</span></a>
    </div>
    <div class="navbar-collapse collapse">
      <div class="menu">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation"><a href="index.php">Pocetna</a></li>
          <li role="presentation"><a href="tabela.php">Tabela</a></li>
          <li role="presentation"><a href="slike.php">Slike</a></li>
          <?php 
            if(!empty($_SESSION['user'])){ 
            //ako nije prazan niz znaci korisnik je logovan pa moze da zapocne kviz
            ?>
            <li role="presentation"><a href="kviz.php">Zapocni kviz</a></li>
          <?php 
            // ugnjezden u prvi if
            if($_SESSION['user']['admin']){ 
            // ako je korisnik admin onda se prikazuje stranica preko koje uredjuje pitanja itd.
            ?>
            <li role="presentation"><a href="admin.php">Admin</a></li>
          <?php 
            } // zatvori unutrasnji if za admin
          ?>
          <li role="presentation"><a href="logout.php">Logout</a></li>

          <?php 
            }else{ // ako je prazan niz korisnika

          ?>
            <li role="presentation"><a href="registracija.php">Registracija</a></li>
            <li role="presentation"><a href="login.php">Login</a></li>
            <?php 
              } // zatvori spoljasnji if-else
            ?>
        </ul>
      </div>
    </div>
  </div>
</nav>
<br><br>
