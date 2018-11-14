<?php
// ukljucena konekcija na bazu
include('konekcija.php');

// izvucem sto smo u ajax slali nas izbor i od tog pitanja id
$izbor = $_POST['izbor'];
$id = $_POST['idPitanja'];
$poruka = ''; // poruka koja ce se ispisati nakon odradjenog pitanja

// pokrecemo upit sa where klauzulom gde trazimo to pitanje sa tim id
$db->where('pitanjeID',$id);

// vraca nam se zapis (asocijativni niz) o tom pitanju iz baze preko funkcije getOne() u database.php skripti koja je kao omotac za upite nad bazom
$pit = $db->getOne('pitanje');

array_push($_SESSION['pitanja'],$id); // ubaci u niz odradjenih pitanja id tog pitanja

// ako je izbor isti kao kolona tacan od tog pitanja
if($pit['tacan'] == $izbor){
  $_SESSION['poeni'] = $_SESSION['poeni'] + 1; // inkrementira se broj poena
  $poruka = 'Tacno. Trenutni broj poena je : '.$_SESSION['poeni'];
}else{
  $poruka = 'Netacno. Trenutni broj poena je : '.$_SESSION['poeni'];
}
echo($poruka); // ispisuje poruku na kraju
?>
