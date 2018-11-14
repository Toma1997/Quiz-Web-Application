<?php
include('konekcija.php'); // ukljucena konekcija
session_destroy(); // unisti sesiju tj superglobalni niz SESSION

// otvara fajl da doda sadzraj povodom izlogovanja sa sajta
$file=fopen("sesija.txt","a");
fwrite($file, "KORISNIK JE IZLOGOVAN !");
fclose($file);

header('Location:index.php'); // vrati se na index stranicu

 ?>
