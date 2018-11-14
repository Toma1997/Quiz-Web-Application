<?php
 include 'konekcija.php'; // ukljucena konekcija

// ako nije setovan id pitanja vrati ga nazad na admin stranicu
 if(!isset($_GET['id'])){
   header("Location: admin.php");
 }
 // sacuvamo id
 $id=$_GET['id'];
 $db->where('pitanjeID',$id); // odradimo upit da nadje to pitanje preko where uslova

 $pitanjeJedno = $db->getOne('pitanje'); // izvucemo to nadjeno pitanje i prikazemo njegove podatke dole u formi
 $poruka = '';

 //ako su uspesno poslati podaci preko POST
 if(isset($_POST['izmenaPitanja'])) {
   include('pitanje.php'); // uvezi pitanje klasu sa metodima

   // instanciraj objekat pitanje koji je povezan na bazu
   $pitanje = new Pitanje($db);

   // ako je vraceno true za izmenu pitanja kreiraj poruku
   if($pitanje->izmenaPitanja($id)){
     $poruka= 'Uspesno ste izmenili pitanje';
   }else{ // ako nije uspesno uneto pitanje kreiraj poruku
     $poruka= 'Neuspesno izmenjeno pitanje';
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
        <!-- forma za izmenu pitanja -->
        <form id="forma" method="post" action="" role="form">
    			<?php if($poruka != ''){ ?>
    				<div class="well"><?php echo $poruka ?></div>
    			<?php } ?>
    			<div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="pitanje">Pitanje *</label>
    						<input id="pitanje" type="text" name="pitanje" class="form-control" value="<?php echo $pitanjeJedno['pitanje'] ?>" >
    					</div>
    				</div>
    			</div>
          <div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="a">A</label>
    						<input id="a" type="text" name="a" class="form-control" value="<?php echo $pitanjeJedno['A'] ?>" >
    					</div>
    				</div>
    			</div>
          <div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="b">B</label>
    						<input id="b" type="text" name="b" class="form-control" value="<?php echo $pitanjeJedno['B'] ?>" >
    					</div>
    				</div>
    			</div>
          <div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="c">C</label>
    						<input id="c" type="text" name="c" class="form-control" value="<?php echo $pitanjeJedno['C'] ?>" >
    					</div>
    				</div>
    			</div>
          <div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="d">D</label>
    						<input id="d" type="text" name="d" class="form-control" value="<?php echo $pitanjeJedno['D'] ?>" >
    					</div>
    				</div>
    			</div>
          <div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="tacan">Tacan odgovor *</label>
                  <select name="tacan" class="form-control" >
                    <!-- dodata je opcija da prikaze prvo tacan odogvor od izvucenog pitanja iz php-->
                    <option value="<?php echo $pitanjeJedno['tacan'] ?>"><?php echo strtoupper($pitanjeJedno['tacan']) ?></option>
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                  </select>
    					</div>
    				</div>
    			</div>

    			<div class="col-md-12">
    				<input id="login" name="izmenaPitanja" type="submit" class="btn btn-success" value="Izmeni pitanje"> <!-- na klik se salju podaci php skripti gore-->
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
