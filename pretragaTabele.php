<?php
  include 'konekcija.php'; // uvezena konekcija na bazu

  $id = $_GET['id']; // dobijemo id preko ajax

  $whereUslov = ''; //kreiramo uslov za nalazenje korisnika

  if($id != 0){ // ako je odredjen ID
    $whereUslov = ' where k.korisnikID = '.$id; // definisi uslov
  }

// izvrsi join upit za prikaz imena i prezimena korisnika i njegovog rezultata
  $tabela = $db->rawQuery('select * from tabela t join korisnik k on t.korisnikID = k.korisnikID '.$whereUslov);
  echo json_encode($tabela); // koduj u json format rezultat upita


 ?>
