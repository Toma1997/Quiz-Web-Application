<?php

// klasa user za prveru logovanja i registracije
class User {

// polje koje se odnosi na bazu
	private $db;

// konstruktor preko koga se korisnik povezuje sa bazom
	public function __construct($db) {
		$this->db = $db;
	}

// funkcija za login vraca true ako se korisnik nalazi u bazi jer znaci da je vec registrovan pa se moze logovati
	public function login() {
		// inicijalizuje se ime i prezime iz POST niza

		// escape je _mysqli->real_escape_string($string) funkcija iz nase baze koja stiti od SQl Injection napada
		// uklanja stetne karaktere po SQL upit iz stringa koji joj se prosledjuje
		$username = $this->db->escape(trim($_POST['username']));
		$password = $this->db->escape(trim($_POST['password']));

// definise se niz parametara
		$params = Array($username, $password);
		// rezultat upita se smesta u users promenljivu tj niz
		$users = $this->db->rawQuery("SELECT * FROM korisnik WHERE username = ? AND password = ? LIMIT 1", $params); // $params parametri ce se automatski bind-ovati
//ako ima korisnika u tabeli sa tim imenom i lozinkom vrati true
		if(count($users) > 0) {

// inicijalizuj korsnika iz $users za sesiju
			$_SESSION['user'] = $users[0];

			return true;

		} else { // ako nema korisnika sa tom sifrom i lozinkom vrati false
			return false;
		}

	}

// funkcija koja proverava registraciju
	public function registracija(){
		// uzmemo vrednosti polja iz POST niza i ocistimo o stetnih karaktera i razmaka na krajevima stringa
		$ime = $this->db->escape(trim($_POST['ime']));
		$username = $this->db->escape(trim($_POST['username']));
		$password = $this->db->escape(trim($_POST['password']));

// upakujemo podatke u asocijativni niz $data
		$data = Array (
				"imePrezime" => $ime,
				"username" => $username,
        "password" => $password
		);

// podatke u json kodovanom formatu cuvamo u $podaci
		$podaci = json_encode($data);

// napravi novi zahtev i posaljemo mu unos korisnika
		$zahtev = curl_init("http://localhost/kviz/api/noviKorisnik");

		// setuje opciju da se zahtev salje preko POST metoda
		curl_setopt($zahtev, CURLOPT_POST, TRUE);

		// setujemo da POST polja budu podaci prosledjeni u json formatu
		curl_setopt($zahtev, CURLOPT_POSTFIELDS, $podaci);

		// setuje opciju da vrati te podatke za zahtev
		curl_setopt($zahtev, CURLOPT_RETURNTRANSFER, 1);

		// vraca obradjeni zahtev u obliku poruke
		$odgovor = curl_exec($zahtev);

		// dekoduje json i vraca u obliku statusnog odgovora
		$json_objekat=json_decode($odgovor, true);
		curl_close($zahtev); // zatvori vezu

// definisano za obradu json u ovom slucaju je u api/index.php fajlu
// ako je json status OK vrati true za registraciju
		if($json_objekat == "OK!") {
			return true;
		} // ako nije vratio OK vrati false
		else {
			return false;
		}


 }

}

?>
