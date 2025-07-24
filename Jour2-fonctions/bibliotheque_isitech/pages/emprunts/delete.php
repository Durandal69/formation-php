<?php

require_once '../../config/database.php';
require_once '../../classes/Emprunt.php';

$empruntModel = new Emprunt($pdo);

$errors = [];

$id= $_GET['id'];

$empruntModel->delete($id);
header('Location: ../../index.php?message=deleted'); // Redirection après suppression réussie


?>