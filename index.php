<?php

require 'app/user.php';

/*
Cet exemple crée une arborescence d'utilisateurs avec Adam comme racine, Mohamed et Charlie 
comme enfants directs de Adam, Dave et Eve comme enfants directs de Mohamed, et Frank et Gina
comme enfants directs de Charlie. La méthode printTree() est ensuite appelée sur la racine,
ce qui affiche toute l'arborescence à partir de la racine.
*/


// Créer une arborescence d'utilisateurs
$root = new User(1, 'Adam');
$bob = new User(2, 'Mohamed', $root);
$charlie = new User(3, 'Charlie', $root);
$dave = new User(4, 'Dave', $bob);
$eve = new User(5, 'Eve', $bob);
$frank = new User(6, 'Frank', $charlie);
$gina = new User(7, 'Gina', $charlie);
$amine = new User(8, 'Amine', $charlie);
$ali = new User(9, 'Ali', $charlie);
$josef = new User(8, 'Josef', $amine);

// Afficher l'arborescence à partir de la racine, chaque user avec le nombre d'enfants
$root->printTree();



?>