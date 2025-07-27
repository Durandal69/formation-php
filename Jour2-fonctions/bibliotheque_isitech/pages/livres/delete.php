<?php
try {
    require_once '../../config/database.php';
    require_once '../../classes/Livre.php';

    $livreModel = new Livre($pdo);

    $errors = [];

    $id = $_GET['id'];

    $livreModel->delete($id);
    header('Location: ../../index.php?message=deleted'); // Redirection après suppression réussie
} catch (Exception $e) {
    echo "<div style='color:red; font-weight:bold; padding:1em; background:#ffeaea; border:2px solid #e53935; margin:2em auto; max-width:600px; border-radius:8px;'>
            Une erreur est survenue : " . htmlspecialchars($e->getMessage()) . "
          </div>";
    exit;
}
