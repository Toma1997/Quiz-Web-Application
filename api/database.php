<?php
class Database {
	private $hostname = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "kviz";
	private $dblink;
	private $result = true; // moze biti ili boolean ili rezultat upita
	private $records;
	private $affectedRows;

// konstruktor i instancira ime baze i konekciju
	function __construct($dbname)
	{
		$this->$dbname = $dbname;
		$this->Connect();
	}

// pribavlja rezultate ili upita ili boolean vrednost
	public function getResult()
	{
		return $this->result;
	}

// destruktor i zatvaranje konekcije baze
	function __destruct()
	{
		$this->dblink->close();
	}

// funckija za konekciju na bazu
	function Connect()
	{
		// kreiranje konekcije
		$this->dblink = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
		if($this->dblink->connect_errno) // ako je doslo do greske u konekciji
		{
			// prikazi status
			printf("Konekcija neuspesna: %s\n",  $mysqli->connect_error);
			exit();
		}
		$this->dblink->set_charset("utf8"); // ako je uspesna konekcija setuj set karaktera na utf8
	}

// funkcija za dodavanje novog korisnika u bazu
	function noviKorisnik($data) {
		// kreiranje konekcije
		$mysqli = new mysqli("localhost", "root", "", "kviz");

// filtrira i sredjuje string iz json formata
		$ime = mysqli_real_escape_string($mysqli,$data['imePrezime']);
		$username = mysqli_real_escape_string($mysqli,$data['username']);
		$password = mysqli_real_escape_string($mysqli,$data['password']);

		$values = "('".$ime."','".$username."','".$password."',0)";

		// upit koji dodaje podatke o novom korisniku
		$query = 'INSERT into korisnik (imePrezime, username, password, admin) VALUES '.$values;

		// ako je upit vratio true rezultat je true
		if($mysqli->query($query))
		{
			$this ->result = true;
		}
		else // u suprotnom ako se upit nije lepo izvrsio vrati false
		{
			$this->result = false;
		}
		$mysqli->close(); // zatvaranje konekcije
	}

// pribavlja upit o svim korisnicima
	function sviKorisnici() {
		$mysqli = new mysqli("localhost", "root", "", "kviz");
		$q = 'SELECT * FROM korisnik ';
		$this ->result = $mysqli->query($q);
		$mysqli->close();
	}

// pribavlja sve rezultate korisnika u opadajucem redosledu
	function sviRezultati() {
		$mysqli = new mysqli("localhost", "root", "", "kviz");
		$q = 'SELECT * FROM tabela t join korisnik k on t.korisnikID = k.korisnikID order by t.brojPoena desc';
		$this ->result = $mysqli->query($q);
		$mysqli->close();
	}

// izvlaci sva pitanja koja postoje u bazi
	function svaPitanja() {
		$mysqli = new mysqli("localhost", "root", "", "kviz");
		$q = 'SELECT * FROM pitanje ';
		$this ->result = $mysqli->query($q);
		$mysqli->close();
	}

// funkcija koja izvrsava upit
	function ExecuteQuery($query)
	{
		if($this->result = $this->dblink->query($query)){
			if (isset($this->result->num_rows)) $this->records = $this->result->num_rows;
				if (isset($this->dblink->affected_rows)) $this->affected = $this->dblink->affected_rows;
					return true;
		}
		else{
			return false;
		}
	}
}
?>
