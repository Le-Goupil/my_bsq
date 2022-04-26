# my_bsq

Le but de cet algorithme est de trouver le plus grand carré possible entre les obstacles sur un plateau donné.

## Comment ça marche ?

Le script generator.pl permet de générer un plateaux.

> perl generator.pl x y density > output.txt

'x' et 'y' pour définir la longueur et hauteur.
'density' qui est un nombre donné pour définir la densité d'obstacle.

> php bsq.php output.txt