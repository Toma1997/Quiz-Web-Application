<?php
// ukljucuje konekciju na bazu
 include 'konekcija.php';
 $poruka = '';
 // ako je uspesno prosledjena forma za registraciju u POST
 if(isset($_POST['register'])) {
   // ukljuci klasu User
   include('user.php');
   // kreiraj korisnika
   $user = new User($db);
   // pokretanje registracije tog korisnika i njegov upis u bazu, funkcija vraca true ako je sve uspesno izvrseno
   $sacuvano = $user->registracija();
   // prikaz statusne poruke u zavisnosti od uspeha registracije
   if($sacuvano){
     $poruka= 'Uspesno registrovan korisnik';
   }else{
     $poruka= 'Neuspesno registrovan korisnik';
   }
 }
  ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SuperKviz</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="css/demo.css" />
	<link rel="stylesheet" type="text/css" href="css/set1.css" />
	<link href="css/overwrite.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  </head>
  <body>
	<?php include 'navbar.php'; ?>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="text-center">
					<h2>Dobrodosli na SuperKviz sajt</h2>
					<p>Nas kviz je nesto najbolje na sta ste naleteli, registrujte se i oprobajte se protiv drugih takmicara </p>
        </div>
				<hr>
			</div>
      <div class="col-md-12 text-center">
        <!-- forma iz bootstrap za registraciju sa POST metodom i pokretanjem php koda gore na pocetku fajla-->
        <form id="forma" method="post" action="" role="form">
          <!-- ako je inicijalizovana poruka prikazi status o registraciji-->
    			<?php if($poruka != ''){ ?>
    				<div class="well"><?php echo $poruka ?></div>
    			<?php } ?>
    			<div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="ime">Ime i prezime *</label>
    						<input id="ime" type="text" name="ime" class="form-control" placeholder="Ime i prezime *" >
    					</div>
    				</div>
    			</div>
    			<div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="username">Username *</label>
    						<input id="username" type="text" name="username" class="form-control" placeholder="Username *" >
    					</div>
    				</div>
    			</div>
    			<div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="password">Password *</label>
    						<input id="password" type="text" name="password" class="form-control" placeholder="Password *" >
    					</div>
    				</div>
    			</div>

    			<div class="col-md-12">
    				<input id="login" name="register" type="submit" class="btn btn-success btn-lg" value="Register">
    			</div>

    		</form>
      </div>
		</div>
	</div>


<?php include 'footer.php'; ?>



  <script src="js/jquery-2.1.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/fliplightbox.min.js"></script>
	<script src="js/functions.js"></script>

</body>
</html>
