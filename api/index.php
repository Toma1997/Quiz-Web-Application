<?php
// ukljucuje bez gresaka skripte iz apija
require 'flight/Flight.php';
require 'jsonindent.php';

// na ovom fajlu se nalaze sve rute-putanje

// registrujemo bazu preko Flight klase - FLIGHT je zapravo dodatni mikro-framework za PHP koji pomaze u kreiranju aplikacija
Flight::register('db', 'Database', array('niz'));

// definisemo koren u bazi
Flight::route('/', function(){

	echo('GET i POST metode');

});


//pribavljanje svih pitanja - preko GET metoda uzimamo tabelu pitanja
Flight::route('GET /pitanja', function()
{
	// definisemo zaglavlje za json format i utf8
	header("Content-Type: application/json; charset=utf-8");
// izvlacimo instancu registrovane baze preko Flight klase
	$db = Flight::db();
	// pribavlja sva pitanja iz objekta $db koji pretstavlja objekat baze sa upitima
	$db->svaPitanja();

	$niz =  array();
	$iterator = 0;

	// u getResult se smestaju rezultati upita pa se kroz petlju uzima svaki red iz upita tj svako pitanje
	while ($red = $db->getResult()->fetch_object())
	{
		// pakujemo u niz sve objekte (redove) upita
		$niz[$iterator] = $red;
		$iterator += 1;
	}

// prikazemo u json formatu taj niz i koristimo indent funkciju za bolji i lepsi prikaz u json
// indent funckija je definisana u jsonindent.php fajlu koji je uvezen u ovaj fajl
	echo indent(json_encode($niz));
});

// pribavljanje podataka o rezultatima - isto kao i za sva pitanja - preko GET metoda uzimamo tabelu tabela
Flight::route('GET /tabela', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$db->sviRezultati();

	$niz =  array();
	$iterator = 0;
	while ($red = $db->getResult()->fetch_object())
	{
		$niz[$iterator] = $red;
		$iterator += 1;
	}

	echo indent(json_encode($niz));
});

//pribavljanje svih korisnika - isto kao i za sva pitanja i sve rezultate - preko GET metoda uzimamo tabelu korisnici
Flight::route('GET /korisnici', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$db->sviKorisnici();

	$niz =  array();
	$iterator = 0;
	while ($red = $db->getResult()->fetch_object())
	{
		$niz[$iterator] = $red;
		$iterator += 1;
	}

	echo indent(json_encode($niz));
});

// slanje podataka i dodavanje novog korisnika
Flight::route('POST /noviKorisnik', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();

	// pribalvjamo preko funkcije file_get_contens sve podatke koji su uneti
	$post_data = file_get_contents('php://input');

	// dekodujemo podatke iz json formata u asocijativni niz
	$json_data = json_decode($post_data,true);

	// prosledjujemo funkciji u bazu koja ce dodati podatke za novog korisnika u bazu
	$db->noviKorisnik($json_data);

	// ako je uspesno dodat korisnik i getResult() vrati true prikazi OK status
	if($db->getResult())
	{
		$response = "OK!";
	}
	else // u suprotnom prikazi da je Greska u pitanju
	{
		$response = "Greska!";

	}

// prikazi json kodovan odgovor kao status za dodavanje korisnika
	echo indent(json_encode($response));

});

Flight::start();
?>
