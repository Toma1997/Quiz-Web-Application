(function ($) {

  // funckija koja prikazuje i skriva strelicu za skrolovanje na vrh stranice i skroluje kad se klikne na nju
        $(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollup').fadeIn();
			} else {
				$('.scrollup').fadeOut();
			}
		});
		$('.scrollup').click(function(){
			$("html, body").animate({ scrollTop: 0 }, 1000);
				return false;
		});

	 wow = new WOW({}).init();

   // funkcija loading za lepse ucitavanje novog pitanja, loading pocne i loading zatvori
		$(function(){
    var loading = $('#loadbar').hide();
    $(document)
    .ajaxStart(function () {
        loading.show();
    }).ajaxStop(function () {
    	loading.hide();
    });

// klikom na radio button vadi se value tog radio button (a, b, c, d)
    $("label.btn").on('click',function () {
    	var choice = $(this).find('input:radio').val();
			console.log(choice);

      //izvlaci se ID pitanja kao tekst preko #qid (question id) iz h3 taga
			var idPitanja = $('#qid').text();
			console.log(idPitanja);

// ajax preko POST metoda salje podatke na url odradiPitanje.php
			$.ajax({
			  method: "POST",
			  url: "odradiPitanje.php",
			  data: { izbor: choice, idPitanja: idPitanja }
			})

      // na kraju mu izbaci poruku da li je pitanje tacno i broj tacnih pitanja
			  .done(function( msg ) {
			    alert( msg );
					window.location.href = "kviz.php"; // ucitaj opet i predji kviz.php skriptu
          // i tako u krug se vraca nazad na kviz sve dok se broj pitanja u nizu ne napuni do 5
			  });
    });


});


})(jQuery);
