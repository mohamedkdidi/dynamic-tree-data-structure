<?php

require 'app/user.php';

/*
Cet exemple crée une arborescence d'utilisateurs avec Adam comme racine, Mohamed et Charlie 
comme enfants directs de Adam, Dave et Eve comme enfants directs de Mohamed, et Frank et Gina
comme enfants directs de Charlie. La méthode printTree() est ensuite appelée sur la racine,
ce qui affiche toute l'arborescence à partir de la racine.
*/


# Créer une arborescence d'utilisateurs
$root = new User(1, 'Adam');
$mohamed = new User(2, 'Mohamed', $root);
$charlie = new User(3, 'Charlie', $root);
$dave = new User(4, 'Dave', $mohamed);
$eve = new User(5, 'Eve', $mohamed);
$frank = new User(6, 'Frank', $charlie);
$gina = new User(7, 'Gina', $charlie);
$amine = new User(8, 'Amine', $charlie);
$ali = new User(9, 'Ali', $charlie);
$josef = new User(8, 'Josef', $amine);

# Afficher l'arborescence à partir de la racine, chaque user avec le nombre d'enfants
$root->printTree();


# Exemple Arbre A
$arA = new User(1, 'A');
$a1 = new User(2, 'A1', $arA);
$a2 = new User(3, 'A2', $arA);
$a3 = new User(4, 'A3', $arA);
$arA->printTree();


# Exemple Arbre A
$arB = new User(1, 'B');
$b1 = new User(2, 'B1', $arB);
$b2 = new User(3, 'B2', $arB);
$b1_1 = new User(4, 'B1_1', $b1);
$arB->printTree();

# Exemple Arbre A
$arC = new User(1, 'C');
$c1 = new User(2, 'C1', $arC);
$c2 = new User(3, 'C2', $arC);
$c3 = new User(4, 'C3', $arC);
$c2_1 = new User(5, 'C3_1', $c2);
$c3_1 = new User(6, 'C3_2', $c3);
$c3_2 = new User(7, 'C3_3', $c3);
$c3_1_1 = new User(7, 'C3_3', $c3_1);
$arC->printTree();




?>