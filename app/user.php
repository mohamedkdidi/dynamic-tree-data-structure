<?php

require "model.php";

class User extends Model {
    private $id;
    private $name;
    private $parent;
    private $children;

    public function __construct($id, $name, $parent = null) {
        $this->id = $id;
        $this->name = $name;
        $this->parent = $parent;
        $this->children = [];
        if ($parent != null) {
            $parent->addChild($this);
        }
    }

    /**
     * retourne l'id d'utilisateur
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * retourne le nom d'utilisateur
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * retourne une instance du Model User pour le parent de celui ci. 
     *
     * @return User
     */
    public function parent(): ?User {
        return $this->parent;
    }
    
    /**
     * ajouter un fils a l'utilisateur courant. 
     *
     * @return void
     */
    public function addChild(User $child) {
        $this->children[] = $child;
    }

    /**
     * retourne un Array contenant les instance de User qui sont les enfant direct de celui ci. 
     *
     * @return array
     */
    public function children(): array {
        return $this->children;
    }
    
    /**
    * retourner un entier indiquant le nombre total d’enfants sur tous les niveaux de l’arbre..
    *
    * @return int
    */
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
    
    /**
     * Cette méthode utilise une boucle while pour remonter la hiérarchie d'utilisateurs en partant de l'utilisateur 
     * courant et en suivant les liens parents jusqu'à la racine. À chaque itération de la boucle, on incrémente le niveau
     * de profondeur et on passe au parent suivant. Lorsqu'on atteint la racine (c'est-à-dire lorsque le parent est nul), 
     * on retourne le niveau calculé.
     * 
     * @return int
    */
    public function getLevel() {
        $level = 0;
        $parent = $this->parent();

        while ($parent !== null) {
            $level++;
            $parent = $parent->parent();
        }

        return $level;
    }

    /**
     * Cette méthode utilise une approche itérative en utilisant une pile pour stocker les utilisateurs à afficher. 
     * La pile est initialisée avec l'utilisateur racine, puis on itère sur la pile tant qu'elle n'est pas vide. 
     * À chaque itération, on récupère le prochain utilisateur de la pile, on l'affiche avec le niveau de profondeur 
     * dans l'arborescence (représenté ici par des tirets), puis on ajoute tous ses enfants à la pile dans l'ordre 
     * inverse de leur ajout. Cela garantit que les enfants sont affichés dans l'ordre correct et que la pile est 
     * toujours triée de manière à ce que les nœuds supérieurs soient toujours en haut de la pile.
     * 
     * @return void
     */
    public function printTree($prefix = '|_') {
        # Initialiser une pile avec l'utilisateur racine
        $stack = [$this];
        $parent = null;
        echo "<pre>";

        while (!empty($stack)) {
            # Récupérer le prochain utilisateur de la pile
            $user = array_shift($stack);

            # Afficher l'utilisateur avec son niveau dans l'arborescence
            if ($user->parent() != null) {
                $parent = " fils de ".$user->parent()->getName();
            }
                
            echo $prefix.str_repeat('_ __', $user->getLevel()) . "<b>".@$user->getName()."</b>".$parent." a ".$user->getChildrenCount()." enfant(s) <br>";

            # Ajouter les enfants de l'utilisateur à la pile
            $children = $user->children();
            foreach (array_reverse($children) as $child) {
                $stack[] = $child;
                
            }
            echo '<br>';
        }
    }
}

?>