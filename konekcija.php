<?php

// obgrljena konekcija sa gotovim metodoma iz database.php
require('database.php'); // require baci fatal error ako ima greske dok include samo izbaci warning
$db = new MysqliDb('localhost','root','','kviz');

session_start(); // pokrece se sesija

// kada se pokrene konekcija i sesija kreira se superglobalni niz $_SESSION za cuvanje svih polja koja su zadata

// posle cemo preko login forme da setujemo vrednosti iz ovog niza, pa ce se proveravati ako je prazan niz uradi to i to, ako nije onda to i to...

// ako user nije setovan postavi da bude prazan niz
if(!isset($_SESSION['user'])){
  $_SESSION['user'] = array();
}

// tu cuvamo sva pitanja ( ID pitanja koja su data)
if(!isset($_SESSION['pitanja'])){
  $_SESSION['pitanja'] = array();
}

// cuvamo random brojeve za pitanja
// posto imammo odredjen broj pitanja pa svaki put se izvuce neko random pitanje za kviz
// pa se vrsi provera da se ne dobije isto pitanje u kvizu
if(!isset($_SESSION['random'])){
  $_SESSION['random'] = array();
}

// cuvamo poene da bi ih povecavali ili smanjivali
if(!isset($_SESSION['poeni'])){
  $_SESSION['poeni'] = 0;
}

?>
