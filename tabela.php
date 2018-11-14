<?php
 include 'konekcija.php';
// isto ka i na index vrsi se konekcija na bazu
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
  <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

  </head>
  <body>
	<?php
    include 'navbar.php';
// ukljcuje ka i na index meni
  ?>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="text-center">
					<h2>Dobrodosli na SuperKviz sajt</h2>
					<p>Nas kviz je nesto najbolje na sta ste naleteli, registrujte se i oprobajte se protiv drugih takmicara </p>
        </div>
				<hr>
			</div>
      <div class="col-md-12">
      <!-- tabela rezultata korisnika -->
        <table id="tabela" class="table table-hover">
          <thead>
            <tr>
              <th>Takmicar</th>
              <th>Broj poena</th>
              <th>Pitanja</th>
            </tr>
          </thead>
          <tbody>
            <?php
                  // inicijalizuj zahtev na odredjenu adresu i kupi podatke sa tog api za tabelu
                  // podaci se nalaze za svakog korisnika u json formatu
                  $zahtev = curl_init("http://localhost/kviz/api/tabela");

                  // setuje opciju RETURNTRANSFER - vraca string podatke od funkcije curl_exe()
                  curl_setopt($zahtev, CURLOPT_RETURNTRANSFER, 1);

                  // dobijamo odgovor u json formatu sa korisnicima i njihovim rezultatima
                  $odgovor = curl_exec($zahtev);

                  // dekodovanjem iz json formata pretvaramo odogovor u niz
                  $tabela = json_decode($odgovor, true);

                  // zatvorimo curl zahtev
                  curl_close($zahtev);

                  // idemo foreach petljom kroz niz $tabela
                  foreach ($tabela as $t) {
                    // dole u za svako polje reda u tabeli ispisujemo vrednosti iz asocijativnog niza koji sadrzi rezultate za svakog korisnika u matrici tabela
                  ?>
                  <tr>
                    <td><?php echo $t['imePrezime'] ?></td>
                    <td><?php echo $t['brojPoena'] ?></td>
                    <td>
                      <?php
                        // ispisuje po ID pitanja gde se vidi na koja pitanja se odgovaralo
                        echo $t['pitanja']
                        ?>

                        </td>
                  </tr>
                  <?php
                  }
             ?>
          </tbody>
        </table>
      </div>

      <div class="col-md-12">
        <div id="chart_div"></div>
      </div>
		</div>
	</div>


<?php
  include 'footer.php';
  // ukljucuje footer
?>



  <script src="js/jquery-2.1.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/fliplightbox.min.js"></script>
	<script src="js/functions.js"></script>

  <!-- jquery biblioteka za bolji prikaz tabele i gomilom funkcija za tabele -->
  <script src="  https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready(function(){
    // najprmitivnija funkcija za bolji stil tabele bez neki dodatnih animacija
      $('#tabela').DataTable();
  });
  </script>

  <!-- preuzimanje funkcija za histogram tj graficki prikaz i statistiku tacnih odgovara itd. -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

    // ucitaj biblioteku i iz bilbioteke paketa prikazi na corechart nacin taj grafikon
      google.charts.load("current", {packages:["corechart"]});

      //kao odgovor vrati pri ucitavanju taj chart tojest grafikon - drawChart je dole definisana funckija
      google.charts.setOnLoadCallback(drawChart);

      // u ajax se preko post metoda vuku podaci sa histogramPodaci.php
      var a; // promenljiva a u koju ce se spakovati json podaci iz histogramPodaci
      $.ajax({
        type: "POST",
        url: 'histogramPodaci.php',
        //ako je uspesno obradjena php skrpita
        success: function (data) {
          // podaci koji su u json formatu kao string se pakuju u objekat a
            a = JSON.parse(data);
        }
    });

      // funkcija za prikaz histograma
      function drawChart() {

        // smestaju se u data podaci iz google funkcije za pretvaranje u tabelu
        // ako ne pukne funckija znaci da moze da prebaci u tu vizualizaciju
        var data = new google.visualization.DataTable(a);

        //definisane su opcije tj u ovom slucaju samo naziv i pozicija (ima jos mnogo opcija za histogram - boja histograma, debljina, format itd)
        var options = {
          title: 'Raspodela poena u kvizu',
          legend: { position: 'none' },
        };

        // html element chart_div koji se nalazi gore u fajlu je prosledjen i obradjen i konvertovan za histogram i tako se smesta u chart promenljivu
        // u chart_div bloku ce biti nacrtan Histogram
        var chart = new google.visualization.Histogram(document.getElementById('chart_div'));

        // iscrtava se histogram prema datim podacima i opcijama
        chart.draw(data, options);
      }
    </script>
</body>
</html>
