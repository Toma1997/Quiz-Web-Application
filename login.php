<?php

// ukljucuje konekciju sa bazom
 include 'konekcija.php';

 // poruka za ispis kao status logovanja
 $poruka = '';

 //ako je setovan login nakon submit
 if(isset($_POST['login'])) {
   // uvezi klasu User
   include('user.php');
   // napravi novog User i dodeli mu konektovanje na bazu $db koju smo dobili iz fajla konekicja.php
   $user = new User($db);

   // funkcija iz klase User vraca true ako je pronadjen korisnik u bazi, ili false ako nema match
   $sacuvano = $user->login();

   // ako je logovanje uspesno vrati adekvatnu poruku i obrnuto
   if($sacuvano){
     $poruka= 'Uspesno ulogovan korisnik';

     //otvara fajl za pisanje i kreira novi ako je vec postojao
     $file=fopen("sesija.txt","w");
     fwrite($file, "KORISNIK JE ULOGOVAN !\r\n");
     // unosi vrednosti za username i password
     fwrite($file, "username:  " . $_POST['username'] . "\r\n"); // \r\n znaci prelazak u novi red
     fwrite($file, "password:  " . $_POST['password'] . "\r\n");
     fclose($file); // zatvara fajl

   }else{
     $poruka= 'Neuspesno ulogovan korisnik';
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
        <!-- Imamo bootstrap formu za klasama iz bootstrap koje imaju inut polja za username i password za obradu logovanja-->
        <!-- Ako ne stavimo pod action odredjenu skriptu znaci da obradi u toj istoj skripti u php kodu-->
        <form id="forma" method="post" action="" role="form">
    			<?php if($poruka != ''){ ?>
            <!-- Ako poruka od vrha nije prazna prikazi da li je uspesno ili neuspeno logovanje -->
    				<div class="well"><?php echo $poruka ?></div>
    			<?php } ?>
    			<div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="opis">Username *</label>
    						<input id="username" type="text" name="username" class="form-control" placeholder="Username *" >
    					</div>
    				</div>
    			</div>
    			<div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="password">Password *</label>
    						<input id="password" type="password" name="password" class="form-control" placeholder="Password *" >
    					</div>
    				</div>
    			</div>

    			<div class="col-md-12">
            <!-- preko POST metoda se salju username i password gore u php skriptu za proveru logovanja-->
    				<input id="login" name="login" type="submit" class="btn btn-success" value="Login">
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
