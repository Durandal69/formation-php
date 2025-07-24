<?php

require_once '../../config/database.php';
require_once '../../classes/Livre.php';

$livreModel = new Livre($pdo);

$errors = [];

$id= $_GET['id'];

$livreModel->delete($id);
header('Location: ../../index.php?message=deleted'); // Redirection après suppression réussie


?>