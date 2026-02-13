<?php
/**
 * Vérification de l'authentification.
 * Redirige vers login.php si l'utilisateur n'est pas connecté ou si le token est invalide/expiré.
 * À inclure dans layout_start.php (après env.php pour avoir $admin_base).
 */
$auth_token = isset($_COOKIE['expertisehs_token']) ? trim($_COOKIE['expertisehs_token']) : '';
$valid = false;
if ($auth_token !== '') {
    $decoded = @base64_decode($auth_token, true);
    if ($decoded !== false) {
        $payload = @json_decode($decoded, true);
        if (is_array($payload) && isset($payload['exp']) && (int) $payload['exp'] > time()) {
            $valid = true;
        }
    }
}
if (!$valid) {
    if ($auth_token !== '' && !headers_sent()) {
        setcookie('expertisehs_token', '', ['expires' => time() - 3600, 'path' => '/', 'samesite' => 'Lax']);
    }
    $login_url = (isset($admin_base) ? $admin_base : '') . 'login.php';
    if (!headers_sent()) {
        header('Location: ' . $login_url);
    }
    exit;
}
