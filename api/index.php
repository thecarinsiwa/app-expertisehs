<?php
/**
 * ExpertiseHS REST API - CRUD for all database tables
 * No framework. Usage: GET/POST /api/{table}, GET/PUT/DELETE /api/{table}/{id}
 */

// Route "check" : page de vérification DB/API (HTML), même si tout est réécrit vers index.php
$uriPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
$uriPath = trim($uriPath, '/');
$uriSegments = $uriPath !== '' ? explode('/', $uriPath) : [];
$isCheckPage = in_array('check', $uriSegments, true) || in_array('check.php', $uriSegments, true);
if ($isCheckPage) {
    header('Content-Type: text/html; charset=utf-8');
    require __DIR__ . '/check.php';
    return;
}

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require __DIR__ . '/includes/Db.php';
require __DIR__ . '/includes/CrudHandler.php';

function sendJson(int $code, $data): void
{
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function getPathSegments(): array
{
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $base = dirname($_SERVER['SCRIPT_NAME']);
    // Enlever le répertoire du script (ex. /app-expertisehs/api) pour que .../index.php soit la racine
    if ($base !== '/' && $base !== '' && strpos($path, $base) === 0) {
        $path = substr($path, strlen($base));
    }
    $path = trim($path, '/');
    // Racine API : index.php ou index.php/ ou vide
    if ($path === '' || $path === 'index.php') {
        return [];
    }
    if (strpos($path, 'index.php/') === 0) {
        $path = trim(substr($path, strlen('index.php/')), '/');
    } elseif (strpos($path, 'index.php') === 0) {
        return [];
    }
    return $path !== '' ? explode('/', $path) : [];
}

function getJsonInput(): array
{
    $raw = file_get_contents('php://input');
    if ($raw === '') {
        return [];
    }
    $decoded = json_decode($raw, true);
    return is_array($decoded) ? $decoded : [];
}

$segments = getPathSegments();
$method = $_SERVER['REQUEST_METHOD'];

$apiTablesList = [
    'organizations', 'structures', 'departments', 'institutional_partners',
    'countries', 'regions', 'cities', 'priority_zones', 'expertise_domains',
    'projects', 'project_zones', 'project_phases', 'deliverables', 'skills',
    'employees', 'experts', 'expert_skills', 'project_roles', 'donors',
    'funding_contracts', 'project_budgets', 'budget_lines', 'target_communities',
    'beneficiaries', 'local_contacts', 'local_partner_institutions',
    'expertise_missions', 'mission_participants', 'mission_activities',
    'mission_deliverables', 'flight_tickets', 'accommodations', 'equipment',
    'steering_committees', 'steering_committee_members', 'meetings', 'decisions',
    'progress_points', 'result_indicators', 'indicator_measurements',
    'project_evaluations', 'testimonials', 'impact_reports', 'documentary_resources',
    'best_practices', 'lessons_learned', 'model_library', 'news', 'publications',
    'media', 'newsletters', 'access_profiles', 'users', 'activity_log', 'configurations',
];

if (empty($segments) && $method === 'GET') {
    $apiBaseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
        . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost')
        . dirname($_SERVER['SCRIPT_NAME'] ?? '')
        . '/index.php';
    $apiBaseUrl = rtrim($apiBaseUrl, '/');
    $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
    $wantsJson = (isset($_GET['format']) && $_GET['format'] === 'json')
        || (strpos($accept, 'application/json') !== false && strpos($accept, 'text/html') === false);
    if ($wantsJson) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'message' => 'ExpertiseHS API',
            'usage'   => 'GET/POST /api/{table}, GET/PUT/DELETE /api/{table}/{id}',
            'tables'  => $apiTablesList,
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
    header('Content-Type: text/html; charset=utf-8');
    $apiTables = $apiTablesList;
    require __DIR__ . '/doc.php';
    exit;
}

$table = $segments[0];
$id = $segments[1] ?? null;

if ($table === 'auth') {
    $action = $segments[1] ?? '';
    if (!in_array($action, ['login', 'register', 'forgot-password'], true)) {
        sendJson(404, ['error' => 'Auth action not found']);
    }
    require __DIR__ . '/includes/AuthHandler.php';
    try {
        $pdo = Db::getConnection();
        authHandle($pdo, $action, $method, getJsonInput());
    } catch (PDOException $e) {
        sendJson(503, ['error' => 'Database error', 'message' => $e->getMessage()]);
    }
    exit;
}

$limit = isset($_GET['limit']) ? max(1, min(500, (int) $_GET['limit'])) : 100;
$offset = isset($_GET['offset']) ? max(0, (int) $_GET['offset']) : 0;

try {
    $pdo = Db::getConnection();
    $handler = new CrudHandler($pdo, $table);
} catch (PDOException $e) {
    sendJson(503, ['error' => 'Database error', 'message' => $e->getMessage()]);
} catch (InvalidArgumentException $e) {
    sendJson(404, ['error' => $e->getMessage()]);
}

try {
    switch ($method) {
        case 'GET':
            if ($id !== null && $id !== '') {
                $row = $handler->get($id);
                if ($row === null) {
                    sendJson(404, ['error' => 'Not found']);
                }
                sendJson(200, $row);
            }
            $list = $handler->list($limit, $offset);
            sendJson(200, ['data' => $list, 'count' => count($list)]);

        case 'POST':
            if ($id !== null && $id !== '') {
                sendJson(400, ['error' => 'POST with ID not allowed']);
            }
            $body = getJsonInput();
            $created = $handler->create($body);
            sendJson(201, $created);

        case 'PUT':
            if ($id === null || $id === '') {
                sendJson(400, ['error' => 'PUT requires resource ID']);
            }
            $body = getJsonInput();
            $updated = $handler->update($id, $body);
            if ($updated === null) {
                sendJson(404, ['error' => 'Not found']);
            }
            sendJson(200, $updated);

        case 'DELETE':
            if ($id === null || $id === '') {
                sendJson(400, ['error' => 'DELETE requires resource ID']);
            }
            $deleted = $handler->delete($id);
            if (!$deleted) {
                sendJson(404, ['error' => 'Not found']);
            }
            sendJson(200, ['deleted' => true]);

        default:
            sendJson(405, ['error' => 'Method not allowed']);
    }
} catch (PDOException $e) {
    sendJson(400, ['error' => 'Database error', 'message' => $e->getMessage()]);
} catch (InvalidArgumentException $e) {
    sendJson(400, ['error' => $e->getMessage()]);
}
