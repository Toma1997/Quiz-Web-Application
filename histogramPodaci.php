<?php
// skripta sa konekcijom uvezena da bi imali bazu podataka
include 'konekcija.php';

// preko upita se uzimaju podaci o tome koliko puta se odredjen broj poena pojavio u kvizu, i to se smesta u promenljivu podaci kao asocijativni niz
$podaci = $db->rawQuery('select brojPoena, count(tabelaID) as broj from tabela group by brojPoena');

// pravi asocijativni niz $array koji u sebi ima za 'cols' kljuc 2 asocijativna niza za broj poena i broj pojavljivanja
$array['cols'][] = array('label' => 'Broj poena','type' => 'string');
$array['cols'][] = array('label' => 'Broj pojavljivanja', 'type' => 'number');

foreach($podaci as $pod){
    // za svaki red iz asocijativnog niza tj red iz tabele pravi asocijativni niz sa brojem poena i brojem pojavljivanja
    // pa od toga opet pravi niz da bude kao za svaki red
    // i taj niz smesta pod 'rows' kljucem u $array
   $array['rows'][] = array('c' => array( array('v'=>$pod['brojPoena']." poena"),array('v'=>(int)$pod['broj']))) ;
   // c je za svaki red, a v za pojedinacne kolone. tako mora jer Google vizualizacija u histogram radi preko toga
}

// taj niz koduj - prebaci u json format i ispisi ga u json formatu
echo(json_encode($array));
 ?>
