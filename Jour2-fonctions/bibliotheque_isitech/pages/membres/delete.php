<?php

require_once '../../config/database.php';
require_once '../../classes/Membre.php';

$membreModel = new Membre($pdo);

$errors = [];

$id= $_GET['id'];

$membreModel->delete($id);
header('Location: ../../index.php?message=deleted'); // Redirection après suppression réussie


?>