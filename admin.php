<?php
// pokrenuta konekcija na bazu
 include 'konekcija.php';

 $poruka = '';

 // ako su preko forme uspeno preneseni podaci POST metodom
 if(isset($_POST['unosPitanja'])) {
   include('pitanje.php'); // uvezi klasu pitanje sa metodima
   $pitanje = new Pitanje($db); // instanciraj novo pitanje za vezu sa bazom
   $sacuvano = $pitanje->unesiPitanje(); // unosi se pitanje i funkcija vraca boolean vrednost
   if($sacuvano){ // ako je uspesno uneto prikazi poruku
     $poruka= 'Uspesno ste uneli pitanje';
   }else{ // ako nije isto prikazi poruku koja ce se pojaviti dole u html
     $poruka= 'Neuspesno uneto pitanje';
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
        <!-- forma za unos novog pitanja kojom se salju podaci preko post metoda-->
        <form id="forma" method="post" action="" role="form">
    			<?php if($poruka != ''){ ?>
    				<div class="well"><?php echo $poruka ?></div>
    			<?php } ?>
    			<div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="pitanje">Pitanje *</label>
    						<input id="pitanje" type="text" name="pitanje" class="form-control" placeholder="Pitanje *" >
    					</div>
    				</div>
    			</div>
          <div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="a">A</label>
    						<input id="a" type="text" name="a" class="form-control" placeholder="A" >
    					</div>
    				</div>
    			</div>
          <div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="b">B</label>
    						<input id="b" type="text" name="b" class="form-control" placeholder="B" >
    					</div>
    				</div>
    			</div>
          <div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="c">C</label>
    						<input id="c" type="text" name="c" class="form-control" placeholder="C" >
    					</div>
    				</div>
    			</div>
          <div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="d">D</label>
    						<input id="d" type="text" name="d" class="form-control" placeholder="D" >
    					</div>
    				</div>
    			</div>
          <div class="row">
    				<div class="col-md-12">
    					<div class="form-group">
    						<label for="tacan">Tacan odgovor *</label>
                  <select name="tacan" class="form-control" >
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                  </select>
    					</div>
    				</div>
    			</div>

    			<div class="col-md-12">
    				<input name="unosPitanja" type="submit" class="btn btn-success" value="Unesi pitanje"> <!-- dugme za slanje podataka php kodu-->
    			</div>

    		</form>
      </div>
      <div class="col-md-12 text-center">
        <h1>Pretraga tabele po korisnicima</h1>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="korisnik">Korisnik</label>
                <select id="korisnik" name="korisnik" class="form-control" onchange="ajaxPretraga()">
                  <?php

                        // inicijalizuje se zahtev preko veb servisa za korisnicima
                        $zahtev = curl_init("http://localhost/kviz/api/korisnici");

                        // zahtev vraca neke podatke kojim je to setovano
                        curl_setopt($zahtev, CURLOPT_RETURNTRANSFER, 1);
                        $odgovor = curl_exec($zahtev); // izvrsavanjem zahteva dobijamo odogovor sa podacima u json
                        $korisnici=json_decode($odgovor, true); // dekodujemo json u niz
                        curl_close($zahtev); // zatvaramo vezu sa servisom
                        foreach ($korisnici as $k) { // izlistava za svakog korisnika njegove podatke

                   ?>
                  <option value="<?php echo $k['korisnikID']; ?>"><?php echo $k['imePrezime']; ?></option> <!-- nude se korisnici da se izaberu-->
                  <?php
                  }
                   ?>

                </select>

            </div>
            <div id="tabela"></div>
          </div>
        </div>
      </div>

      <!-- za prikaz, izmenu i brisanje pitanja koja postoje -->
      <div class="col-md-12 ">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Pitanje ID</th>
              <th>Pitanje</th>
              <th>Odogovor A</th>
              <th>Odogovor B</th>
              <th>Odogovor C</th>
              <th>Odogovor D</th>
              <th>Tacan</th>
              <th>Izmeni</th>
              <th>Obrisi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            //salje zahtev za pitanjima od veb servisa
            $zahtev = curl_init("http://localhost/kviz/api/pitanja");

            // setovano da izvrsavanjem zahtev vraca neki transfer
            curl_setopt($zahtev, CURLOPT_RETURNTRANSFER, 1);
            $odgovor = curl_exec($zahtev); // izvrsavanjem zahteva vraca se json format kao odgovor
            $pitanja=json_decode($odgovor, true); // dekodovano iz json u niz pitanja
            curl_close($zahtev); // zatvramo zahtev tj vezu sa servisom
                foreach($pitanja as $pit): // petljom se za svako pitanje ispisuje podatak o pitanju u svako polje tabele

             ?>
             <tr>
               <td><?php echo ($pit['pitanjeID']); ?></td>
               <td><?php echo ($pit['pitanje']); ?></td>
               <td><?php echo ($pit['A']); ?></td>
               <td><?php echo ($pit['B']); ?></td>
               <td><?php echo ($pit['C']); ?></td>
               <td><?php echo ($pit['D']); ?></td>
               <td><?php echo ($pit['tacan']); ?></td>

               <!-- opcije za izmenu i brisanje pitanja -->
               <td><a href="izmeni.php?id=<?php echo ($pit['pitanjeID']); ?>"><i class="fa fa-refresh fa-1x"></a></td>
               <td><a href="obrisi.php?id=<?php echo ($pit['pitanjeID']); ?>"><i class="fa fa-times fa-1x"></a></td>
             </tr>
           <?php endforeach;
           ?>
          </tbody>
        </table>
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
  <script>

// funkcija koja koristi ajax za pretragu korisnika sa rezultatom njegovim
        function ajaxPretraga(){

          // izvucemo koji je izabran ID korisnika iz html preko value
          var korisnikID = $("#korisnik").val();
          $.ajax({
            url: "pretragaTabele.php", // pokrence se pretraga u php fajlu pretragaTabele.php
            data: "id="+korisnikID, // salje se podatak ID korisnika


            success: function(result){ // kada je uspesno obradjena php skripta ispisuje se tkest u zaglavlju kao html tabela
              var textOutput = '<table class="table table-hover">';
              textOutput+='<thead>';
              textOutput+='<th>Takmicar</th>';
              textOutput+='<th>Broj poena</th>';
              textOutput+='<th>Pitanja</th>';
              textOutput+='</tr>';
              textOutput+='</thead>';
              textOutput+='<tbody>';

              // u telu tabele se kroz each petlju za svaki rezultat izvlace iz json formata vrednosti za korisnika i njegov rezultat
              $.each($.parseJSON(result), function(i, val) {
                textOutput += '<tr>';
                textOutput += '<td>'+val.imePrezime +'</td>';
                textOutput += '<td>'+val.brojPoena+'</td>';
                textOutput += '<td>'+val.pitanja+'</td>';
                textOutput += '</tr>';

                });

              textOutput+='</tbody></table>';
              $('#tabela').html(textOutput); // prosledimo html-u citav output koji je nadogradjen konkatenacijom
          }});
        }

    </script>
    <script>
      // preko jQuery se pokrece funkcija za pretragu
        $( document ).ready(function() {
          ajaxPretraga();
        });
    </script>
</body>
</html>
