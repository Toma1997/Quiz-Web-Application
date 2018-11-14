<?php
// ukljucenja konekcija
 include 'konekcija.php';

// proveravamo da li je niz napunjen do 5 pitanja pa ako jeste prebacuj se na zavrsiKviz.php
 if(count($_SESSION['pitanja']) == 5){
   header("Location: zavrsiKviz.php");
 }

// pribavi sva pitanja preko upita a metod get je definisan u database.php
 $pitanja = $db->get('pitanje');

// nasumican broj koji se izvlaci za pitanje ID
  $broj = rand(0, count($pitanja)-1);

  // proveravamo da li se nasumicni broj nalazi kao ID pitanja koja su bila vec pa ako jeste ponoviti izvlacenje
 while(in_array($broj,$_SESSION['random'])){
   $broj = rand(0, count($pitanja)-1);
 }

 //izvlaci se pitanje iz niza
 $pitanje = $pitanja[$broj];
 array_push($_SESSION['random'],$broj); // i na kraju se smesta to pitanje u niz sa izvucenim pitanjima

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
		</div>
	</div>

  <div class="container-fluid bg-info">
    <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
           <!-- ispisuje se pitanje koje je nasumicno izvuceno iz baze preko ID kao redni broj i tekst pitanja se ispisuje -->
            <h3><span class="label label-warning" value="2" id="qid"><?php echo $pitanje['pitanjeID']; ?></span> <?php echo $pitanje['pitanje']; ?></h3>
        </div>
        <div class="modal-body">
            <div class="col-xs-3 col-xs-offset-5">
               <div id="loadbar" style="display: none;">
                  <div class="blockG" id="rotateG_01"></div>
                  <div class="blockG" id="rotateG_02"></div>
                  <div class="blockG" id="rotateG_03"></div>
                  <div class="blockG" id="rotateG_04"></div>
                  <div class="blockG" id="rotateG_05"></div>
                  <div class="blockG" id="rotateG_06"></div>
                  <div class="blockG" id="rotateG_07"></div>
                  <div class="blockG" id="rotateG_08"></div>
              </div>
          </div>

<!-- labele za ponudjenje odgovore u kvizu -->
          <div class="quiz" id="quiz" data-toggle="buttons">
            <!-- kada se klikne na neki od radio button kao odgovor pokrece se js/functions.js skripta gde je uglavnom jQuery -->
           <label class="element-animation1 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> <input type="radio" name="q_answer" value="a"><?php echo $pitanje['A']; ?></label>
           <label class="element-animation2 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> <input type="radio" name="q_answer" value="b"><?php echo $pitanje['B']; ?></label>
           <label class="element-animation3 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> <input type="radio" name="q_answer" value="c"><?php echo $pitanje['C']; ?></label>
           <label class="element-animation4 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> <input type="radio" name="q_answer" value="d"><?php echo $pitanje['D']; ?></label>
       </div>
   </div>
   <div class="modal-footer text-muted">
    <span id="answer"></span>
</div>
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
