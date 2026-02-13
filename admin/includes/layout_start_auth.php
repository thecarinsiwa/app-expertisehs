<?php
/**
 * Début du layout pour les pages d'authentification (login, register, forgot-password).
 * Même structure que l'admin (head, main) mais sans sidebar ni auth_check.
 *
 * Variables à définir avant l'include :
 *   $page_title   : titre de la page (pour <title>)
 *   $page_styles  : balises <link> additionnelles (ex. auth.css)
 *   $head_extra   : (optionnel) meta ou autres balises dans <head> (ex. api-base)
 */
require __DIR__ . '/env.php';
if (!isset($page_title)) {
    $page_title = 'Connexion';
}
if (empty($page_styles)) {
    $page_styles = '<link href="' . $admin_base . 'assets/css/auth.css" rel="stylesheet">';
} elseif (strpos($page_styles, 'auth.css') === false) {
    $page_styles .= "\n" . '<link href="' . $admin_base . 'assets/css/auth.css" rel="stylesheet">';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require __DIR__ . '/head.php'; ?>
</head>
<body class="layout-auth">
    <main class="main-content main-content--auth">
