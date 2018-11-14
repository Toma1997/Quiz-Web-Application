<?php

class Pitanje {

	private $db; // promenljiva za povezivanje sa bazom

	public function __construct($db) { // konstruktor
		$this->db = $db;
	}

// funkcija kojom se unosi pitanje
	public function unesiPitanje(){

		// izvlace se svi podaci iz POST niza i ciste da budu adekvatan string za bazu
		$pitanje = $this->db->escape(trim($_POST['pitanje']));
		$a = $this->db->escape(trim($_POST['a']));
		$b = $this->db->escape(trim($_POST['b']));
		$c = $this->db->escape(trim($_POST['c']));
		$d = $this->db->escape(trim($_POST['d']));
		$tacan = $this->db->escape(trim($_POST['tacan']));

// pakuju se u asocijativni niz
		$data = Array (
				"pitanje" => $pitanje,
				"A" => $a,
        "B" => $b,
				"C" => $c,
				"D" => $d,
				"tacan" => $tacan
		);

//tako upakovani se unose u bazu preko funkcije insert iz database.php kojom se bira tabela 'pitanje' i bind-uju podaci
		$sacuvano = $this->db->insert('pitanje', $data);

// funkcija vraca istinitosnu vrednost povodom unosa pdoataka
		if($sacuvano) {
			return true;
		}
		else {
			return false;
		}

 }

// funkcija za izmenu pitanja
 public function izmenaPitanja($id){

	 // cisti sve podatke iz POST niza u validan string
	 $pitanje = $this->db->escape(trim($_POST['pitanje']));
	 $a = $this->db->escape(trim($_POST['a']));
	 $b = $this->db->escape(trim($_POST['b']));
	 $c = $this->db->escape(trim($_POST['c']));
	 $d = $this->db->escape(trim($_POST['d']));
	 $tacan = $this->db->escape(trim($_POST['tacan']));

//poakuje u obican niz
	 $data = Array ($pitanje, $a,$b, $c, $d,$tacan,$id);

// binduje u upit iz database.php i vraca true ako je uspesno izmenjeno
	 $sacuvano = $this->db->rawQuery('update pitanje set pitanje=?,A=?,B=?,C=?,D=?,tacan=? where pitanjeID=?', $data);

	 // funkcija vraca istinitosnu vrednost povodom unosa pdoataka
 		if($sacuvano) {
 			return true;
 		}
 		else {
 			return false;
 		}


}

}

?>
