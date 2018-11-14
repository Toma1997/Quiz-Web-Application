<?php
 include 'konekcija.php';

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
        <h1>Slike sa Flickr apija</h1>
        <div id="images"></div>
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
      (function() {
        // smesta u $url adresu api sa flickr sa kog ce preuzeti slike
        var url = "http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?";
        // preko ajax prosledjujem atribute ispod kako ce se zvati kad se pribavi JSON sa te adrese
        $.getJSON( url, {
          tags: "quiz",
          tagmode: "any",
          format: "json"
        })
          // na kraju se funkciji prosledjuje JSON data
          .done(function( data ) {
            // unutar tih data podataka u JSON se prolazi kroz data.items koji predstavlja niz tih item-a tojest slika
            $.each( data.items, function( i, item ) {
              // za div blok #images kreirace se slika i svakoj slici se dodeljuje izvorna adresa iz svakog item pod media atributom koji u sebi takodje ima m atribut
              $( "<img>" ).attr( "src", item.media.m ).appendTo( "#images" );

            });
          });
      })();
</script>
</body>
</html>
