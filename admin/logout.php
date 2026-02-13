<?php
/**
 * Déconnexion - invalide le cookie et redirige vers la page de connexion.
 */
setcookie('expertisehs_token', '', ['expires' => time() - 3600, 'path' => '/', 'samesite' => 'Lax']);
setcookie('expertisehs_user', '', ['expires' => time() - 3600, 'path' => '/', 'samesite' => 'Lax']);
header('Location: login.php?logout=1');
exit;
