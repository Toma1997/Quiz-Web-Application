<?php
include('konekcija.php');

// pribavlja se broj poena, ID korisnika koji je logovan
$brPoena = $_SESSION['poeni'];
$korisnikID= $_SESSION['user']['korisnikID'];
$pitanjaString = implode(",",$_SESSION['pitanja']); // i pribavlja se string sa nizom ID pitanja i stavlja zarez izmedju svakog

// smesta kosrinikov ID, poene i pitanja u asocijativni niz
$data = Array (
    "korisnikID" => $korisnikID,
    "brojPoena" => $brPoena,
    "pitanja" => $pitanjaString
);

// umece podatke u tabelu za rezultate i upit vraca boolean u zavisnosti od uspesno izvrsen
$sacuvano = $db->insert('tabela', $data);

// ako je uspesno izvrsen upit resetuj poene, ID-jeve pitanja i random izvucena pitanja
if($sacuvano){
  $_SESSION['poeni'] = 0;
  $_SESSION['pitanja'] = array();
  $_SESSION['random'] = array();

  // prebaci se na tabela.php fajl sa rezultatima
  header("location:tabela.php");

}else{ // greska u izvrsavanju insert naredbe u bazu
  echo 'GRESKA';
}
 ?>
