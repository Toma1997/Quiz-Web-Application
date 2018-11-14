<?php
include 'konekcija.php'; // ukljucena konekcija

// ako nije setovan id pitanja vrati ga nazad na admin stranicu
if(!isset($_GET['id'])){
  header("Location: admin.php");
}

// sacuvamo id
$id=$_GET['id'];
$db->where('pitanjeID',$id); // kreiramo upit da nadje to pitanje preko where uslova
$pitanjeJedno = $db->delete('pitanje'); // brisanje tog pitanja iz tabele
header("Location: admin.php"); // vraca se na admin stranicu
?>
