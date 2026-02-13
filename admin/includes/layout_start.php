<?php
/**
 * Début du layout admin : DOCTYPE, head, body, sidebar, ouverture de <main>.
 * À appeler en tête de chaque page admin.
 *
 * Variables optionnelles (à définir avant l'include) :
 *   $page_title   : titre de la page (pour <title> et usage dans la page)
 *   $active_menu  : clé du menu actif ('dashboard', 'invoices', 'customers', etc.)
 *   $page_styles  : HTML additionnel (balises <link> ou <style>) pour cette page
 */
require __DIR__ . '/env.php';
require __DIR__ . '/auth_check.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require __DIR__ . '/head.php'; ?>
</head>
<body>
    <?php require __DIR__ . '/sidebar.php'; ?>
    <main class="main-content">
