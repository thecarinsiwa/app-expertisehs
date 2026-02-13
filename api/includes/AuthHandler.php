<?php
/**
 * Gestion de l'authentification (login, register, forgot-password)
 * Utilisé par api/index.php lorsque la route est auth/*
 */

function authHandle(PDO $pdo, string $action, string $method, array $body): void
{
    if ($method !== 'POST') {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    switch ($action) {
        case 'login':
            authLogin($pdo, $body);
            return;
        case 'register':
            authRegister($pdo, $body);
            return;
        case 'forgot-password':
            authForgotPassword($pdo, $body);
            return;
        default:
            http_response_code(404);
            echo json_encode(['error' => 'Auth action not found'], JSON_UNESCAPED_UNICODE);
            exit;
    }
}

function authLogin(PDO $pdo, array $body): void
{
    $email = isset($body['email']) ? trim((string) $body['email']) : '';
    $password = isset($body['password']) ? $body['password'] : '';

    if ($email === '' || $password === '') {
        http_response_code(400);
        echo json_encode(['error' => 'Email et mot de passe requis'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $stmt = $pdo->prepare('SELECT id, email, password_hash, first_name, last_name, is_active FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || (int) ($user['is_active'] ?? 0) !== 1) {
        http_response_code(401);
        echo json_encode(['error' => 'Identifiants incorrects'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if (!password_verify($password, $user['password_hash'] ?? '')) {
        http_response_code(401);
        echo json_encode(['error' => 'Identifiants incorrects'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $stmt = $pdo->prepare('UPDATE users SET last_login_at = NOW() WHERE id = ?');
    $stmt->execute([$user['id']]);

    unset($user['password_hash'], $user['is_active']);
    $token = base64_encode(json_encode(['user_id' => $user['id'], 'exp' => time() + 86400 * 7]));

    http_response_code(200);
    echo json_encode([
        'user' => $user,
        'token' => $token,
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

function authRegister(PDO $pdo, array $body): void
{
    $email = isset($body['email']) ? trim((string) $body['email']) : '';
    $password = isset($body['password']) ? $body['password'] : '';
    $firstName = isset($body['first_name']) ? trim((string) $body['first_name']) : null;
    $lastName = isset($body['last_name']) ? trim((string) $body['last_name']) : null;

    if ($email === '') {
        http_response_code(400);
        echo json_encode(['error' => 'Email requis'], JSON_UNESCAPED_UNICODE);
        exit;
    }
    if (strlen($password) < 6) {
        http_response_code(400);
        echo json_encode(['error' => 'Le mot de passe doit contenir au moins 6 caractères'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        http_response_code(409);
        echo json_encode(['error' => 'Un compte existe déjà avec cet email'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $id = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        random_int(0, 0xffff), random_int(0, 0xffff), random_int(0, 0xffff),
        random_int(0, 0x0fff) | 0x4000, random_int(0, 0x3fff) | 0x8000,
        random_int(0, 0xffff), random_int(0, 0xffff), random_int(0, 0xffff));
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare('INSERT INTO users (id, email, password_hash, first_name, last_name, is_active) VALUES (?, ?, ?, ?, ?, 1)');
    $stmt->execute([$id, $email, $passwordHash, $firstName, $lastName]);

    $user = [
        'id' => $id,
        'email' => $email,
        'first_name' => $firstName,
        'last_name' => $lastName,
    ];

    http_response_code(201);
    echo json_encode(['user' => $user], JSON_UNESCAPED_UNICODE);
    exit;
}

function authForgotPassword(PDO $pdo, array $body): void
{
    $email = isset($body['email']) ? trim((string) $body['email']) : '';
    if ($email === '') {
        http_response_code(400);
        echo json_encode(['error' => 'Email requis'], JSON_UNESCAPED_UNICODE);
        exit;
    }
    // Ne pas révéler si l'email existe ou non
    http_response_code(200);
    echo json_encode([
        'message' => 'Si un compte existe avec cet email, un lien de réinitialisation a été envoyé.',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
