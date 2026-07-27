<?php
require 'tuto_poo_grafikart.php';

$merlin = new Personnage("Merlin");
$merlin->regenerer();

$harry = new Personnage("Harry");
var_dump($harry->mort());

var_dump($merlin);
var_dump($harry);
