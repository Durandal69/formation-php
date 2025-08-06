# README

C'est un petit repository de mes cours PHP et surtout, des exercices à réaliser pour pratiquer.

Dans jour1, il y a la base de PHP, avec des petits exercices comme la calculatrice, le générateur de mot de passe (et sa correction), etc.

Dans le dossier assets, j'avais préparé des dossiers images, css et js pour les exercices, mais finalement, seul le css est utilisé pour le moment, et uniquement pour les fichiers de jour1.

Dans le jour2, le premier exercice était de faire un form avec Produits_e_commerce.
Mais le plus important, du jour2, c'est la création de la bibliothèque.

Cette dernière, prend en charge une arborescence de fichiers plus complète, des classes d'objets pour les membres, auteurs, livres et emprunts. Elle prend aussi en parallèle la gestion de la base de données créées lors des sessions MySQL.
Par la suite, il y a le CRUD pour les livres, les auteurs et les membres, ainsi que la gestion des emprunts. Et quelques statistiques pour les membres. Niveau js par contre c'est assez pauvre.
Dans le dossier de la bibliothèque, il y a aussi le fichier bibli.sql pour avoir les données de la base de données.
Le dossier tests est inutilisé dans cet exercice. Ainsi que le fichier includes/config.php qui n'est plus utilisé non plus (mais j'ai laissé en commentaire ce que j'avais travaillé dessus), à l'origine il était nommé "functions.php" mais j'ai préféré changer la façon de faire en laissant la plupart des fonctions dans les classes.
06/08/2025

Edit : Dans les membres, on peut y voir aussi les statistiques des emprunts, le nombre total, les en cours, et lesquels.