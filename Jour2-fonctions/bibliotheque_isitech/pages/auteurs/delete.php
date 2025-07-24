<?php
require_once '../../config/database.php';
require_once '../../classes/Auteur.php';

$auteurModel = new Auteur($pdo);

$errors = [];

$id = $_GET['id'] ?? null;

    $auteurModel->delete($id);
    header('Location: ../../index.php?message=deleted');
?>