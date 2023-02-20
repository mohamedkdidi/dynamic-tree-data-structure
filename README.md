## Implémentation php du structure de données (arbre dynamique) version non-recursive avec les tests unitaires et pipeline de build github action
******
[![PHP Composer](https://github.com/mohamedkdidi/dynamic-tree-data-structure/actions/workflows/ci.yml/badge.svg)](https://github.com/mohamedkdidi/dynamic-tree-data-structure/actions/workflows/ci.yml)

### Insaller le projet

 `git clone https://github.com/mohamedkdidi/dynamic-tree-data-structure.git `

 `cd dynamic-tree-data-structure `

 `composer install `

### Funtion getChildrenCount

qui retourner un entier indiquant le nombre total d’enfants sur tous les niveaux de l’arbre.

```php
<?php

    public function getChildrenCount(): int {
        $count = 0;
        $stack = [];
        $children = $this->children();
        
        # ajouter les enfants directs de l'utilisateur à la pile
        foreach ($children as $child) {
            $stack[] = $child;
            $count++;
        }
        
        # parcourir la pile pour explorer les enfants directs et les petits-enfants
        while (!empty($stack)) {
            $node = array_shift($stack);
            $grandchildren = $node->children();
            
            # ajouter les enfants directs du nœud à la pile et incrémenter le compteur
            foreach ($grandchildren as $child) {
                $stack[] = $child;
                $count++;
            }
        }
        
        return $count;
        
    }
    
```

### Exemple

Pour l'arborescence suivante 

```php
<?php
// Créer une arborescence d'utilisateurs
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

// Afficher l'arborescence à partir de la racine, chaque user avec le nombre d'enfants
$root->printTree();
```

Voici le resultat


|_Adam a 9 enfant(s) 

|__ __Charlie fils de Adam a 5 enfant(s) 

|__ __Mohamed fils de Adam a 2 enfant(s) 

|__ ___ __Ali fils de Charlie a 0 enfant(s) 

|__ ___ __Amine fils de Charlie a 1 enfant(s) 

|__ ___ __Gina fils de Charlie a 0 enfant(s) 

|__ ___ __Frank fils de Charlie a 0 enfant(s) 

|__ ___ __Eve fils de Mohamed a 0 enfant(s) 

|__ ___ __Dave fils de Mohamed a 0 enfant(s) 

|__ ___ ___ __Josef fils de Amine a 0 enfant(s) 


```php
# Exemple Arbre A
$arA = new User(1, 'A');
$a1 = new User(2, 'A1', $arA);
$a2 = new User(3, 'A2', $arA);
$a3 = new User(4, 'A3', $arA);
$arA->printTree();


# Exemple Arbre B
$arB = new User(1, 'B');
$b1 = new User(2, 'B1', $arB);
$b2 = new User(3, 'B2', $arB);
$b1_1 = new User(4, 'B1_1', $b1);
$arB->printTree();

# Exemple Arbre C
$arC = new User(1, 'C');
$c1 = new User(2, 'C1', $arC);
$c2 = new User(3, 'C2', $arC);
$c3 = new User(4, 'C3', $arC);
$c2_1 = new User(5, 'C3_1', $c2);
$c3_1 = new User(6, 'C3_2', $c3);
$c3_2 = new User(7, 'C3_3', $c3);
$c3_1_1 = new User(7, 'C3_3', $c3_1);
$arC->printTree();
```


### Resultat

##### Arbre A

|_A a 3 enfant(s) 

|__ __A3 fils de A a 0 enfant(s) 

|__ __A2 fils de A a 0 enfant(s) 

|__ __A1 fils de A a 0 enfant(s) 


##### Arbre B

|_B a 3 enfant(s) 

|__ __B2 fils de B a 0 enfant(s) 

|__ __B1 fils de B a 1 enfant(s) 

|__ ___ __B1_1 fils de B1 a 0 enfant(s)

##### Arbre C

|_C a 7 enfant(s) 

|__ __C3 fils de C a 3 enfant(s) 

|__ __C2 fils de C a 1 enfant(s) 

|__ __C1 fils de C a 0 enfant(s) 

|__ ___ __C3_3 fils de C3 a 0 enfant(s) 

|__ ___ __C3_2 fils de C3 a 1 enfant(s) 

|__ ___ __C3_1 fils de C2 a 0 enfant(s) 

|__ ___ ___ __C3_3 fils de C3_2 a 0 enfant(s) 


 
### Exécution des tests unitaires

```bash
$>php ./vendor/bin/phpunit --verbose --testdox tests/UserTest.php

PHPUnit 9.6.3 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.2.0

User
 ✔ Get children count with no children [6.67 ms]
 ✔ Get children count with one child [0.82 ms]
 ✔ Get children count with grand children [0.31 ms]
 ✔ Get level with no parent [0.29 ms]
 ✔ Get level with one parent [0.31 ms]
 ✔ Print tree [0.37 ms]

Time: 00:00.088, Memory: 4.00 MB

OK (6 tests, 6 assertions)
```
