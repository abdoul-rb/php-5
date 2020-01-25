# Project PHP MVC From Scrath [For School]

Il s s'agit d'un projet d'école consistant à développer un **CMS** façon From Scratch dont les fonctionnalités sont propres à un domaine choisi, ici la création de **blog**.

Ce mini framework comprendra :
* Un système de routing natif
* Un framework CSS dont vous trouverez le dépôt [ici](https://)
* Un ORM pour la manipulation de la base de données
* Un moteur de template

En plus de cela, il y'a certaines choses à faire tel que : 
1. Le maquettage sur [Figma](https://www.figma.com/file/MxVaSpJLmtZTrp491bfKQe/cms-project?node-id=0%3A1)
2. La mise en place d'un Style Guide

**Modal** : Bout de code factoriser à inclure dans d'autres vues.
Il à la capacité de recentraliser un ensemble de fonctionnalité dont on pourra réutiliser.

### Captcha

Pour un formulaire, il est impératif de le protéger des assauts de bots et de spams. Pour ce faire il faut intégrer un système de reconnaissance d'utilisateur humain, plus communément appelé **CAPTCHA**.

Générer un texte aléatoire d'une longueur aléatoire entre 5 et 7 caractères.
Insérer ce texte dans l'image avec :
* Une police aléatoire par caractère provenant d'un dossier "__fonts__" avec des fichiers __ttf__.
* Attention si je rajoute une police dans le dossier cela doit marcher automatiquement.
* Un angle aléatoire par caractère.
* Une couleur aléatoire par caractère.
* Une taille et une position aléatoire par caractère.
* Un fond aléatoire.
* Un nombre de forme géométrique aléatoire utilisant des couleurs des caractères.

__ATTENTION LE CAPTCHA DOIT ETRE LISIBLE !!!__


### Contruction de formulaire de façon dynamique à partir d'une variable qui lui sera passé.

Avoir un tableau PHP contenant toutes les informations permettant de créer ce formulaire.
