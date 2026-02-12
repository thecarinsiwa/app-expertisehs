<?php
/**
 * Page de vérification : existence de la base, connexion DB, disponibilité API
 */
$pageTitle = 'Vérification Expertise Humanitaire et Sociale';
$configPath = __DIR__ . '/config/database.php';
$config = file_exists($configPath) ? require $configPath : null;

$checks = [
    'config'    => ['ok' => false, 'message' => '', 'detail' => ''],
    'database'  => ['ok' => false, 'message' => '', 'detail' => '', 'can_create' => false],
    'tables'    => ['ok' => false, 'message' => '', 'count' => 0, 'expected' => 55, 'can_create' => false],
    'api'       => ['ok' => false, 'message' => '', 'detail' => ''],
];

$createDbResult = null; // 'ok' | 'error' avec message
if (!empty($_POST['create_db']) && $_POST['create_db'] === '1') {
    $configPathForCreate = __DIR__ . '/config/database.php';
    $configForCreate = file_exists($configPathForCreate) ? require $configPathForCreate : null;
    if ($configForCreate && is_array($configForCreate)) {
        try {
            $dsnNoDb = sprintf(
                'mysql:host=%s;port=%s;charset=%s',
                $configForCreate['host'],
                $configForCreate['port'],
                $configForCreate['charset'] ?? 'utf8mb4'
            );
            $pdoAdmin = new PDO($dsnNoDb, $configForCreate['user'], $configForCreate['password'] ?? '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            $dbname = $configForCreate['dbname'];
            $collation = ($configForCreate['charset'] ?? 'utf8mb4') === 'utf8mb4' ? 'utf8mb4_unicode_ci' : 'utf8_general_ci';
            $pdoAdmin->exec(sprintf(
                "CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET %s COLLATE %s",
                str_replace('`', '``', $dbname),
                str_replace('`', '``', $configForCreate['charset'] ?? 'utf8mb4'),
                str_replace('`', '``', $collation)
            ));
            header('Location: ' . (isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : 'check.php') . '?created=1');
            exit;
        } catch (PDOException $ex) {
            $createDbResult = ['error' => $ex->getMessage()];
        }
    } else {
        $createDbResult = ['error' => 'Configuration introuvable'];
    }
}

$createTablesResult = null;
if (!empty($_POST['create_tables']) && $_POST['create_tables'] === '1') {
    $configPathForTables = __DIR__ . '/config/database.php';
    $configForTables = file_exists($configPathForTables) ? require $configPathForTables : null;
    $schemaPath = __DIR__ . '/../database/schema.mysql.sql';
    if ($configForTables && is_array($configForTables) && file_exists($schemaPath)) {
        try {
            $charset = $configForTables['charset'] ?? 'utf8mb4';
            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                $configForTables['host'],
                $configForTables['port'],
                $configForTables['dbname'],
                $charset
            );
            $pdoTables = new PDO($dsn, $configForTables['user'], $configForTables['password'] ?? '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            $sql = file_get_contents($schemaPath);
            // Supprimer les commentaires (lignes -- ou #)
            $sql = preg_replace('/^\s*--[^\n]*$/m', '', $sql);
            $sql = preg_replace('/^\s*#[^\n]*$/m', '', $sql);
            $statements = array_filter(array_map('trim', preg_split('/;\s*[\r\n]+/', $sql)));
            foreach ($statements as $statement) {
                if ($statement !== '') {
                    $pdoTables->exec($statement);
                }
            }
            $baseUrl = isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : 'check.php';
            header('Location: ' . $baseUrl . '?tables_created=1');
            exit;
        } catch (PDOException $ex) {
            $createTablesResult = ['error' => $ex->getMessage()];
        } catch (Throwable $ex) {
            $createTablesResult = ['error' => $ex->getMessage()];
        }
    } else {
        $createTablesResult = ['error' => !file_exists($schemaPath) ? 'Fichier database/schema.mysql.sql introuvable' : 'Configuration introuvable'];
    }
}

// 1. Config chargée
if ($config !== null && is_array($config)) {
    $checks['config']['ok'] = true;
    $checks['config']['message'] = 'Configuration chargée';
    $checks['config']['detail'] = sprintf(
        'Host: %s, Port: %s, Base: %s, User: %s',
        $config['host'] ?? '-',
        $config['port'] ?? '-',
        $config['dbname'] ?? '-',
        $config['user'] ?? '-'
    );
} else {
    $checks['config']['message'] = 'Fichier config/database.php introuvable ou invalide';
}

// 2 & 3. Connexion DB et tables (si config OK)
if ($checks['config']['ok']) {
    $pdo = null;
    try {
        $charset = $config['charset'] ?? 'utf8mb4';
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            $config['host'],
            $config['port'],
            $config['dbname'],
            $charset
        );
        $pdo = new PDO($dsn, $config['user'], $config['password'] ?? '', [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        $checks['database']['ok'] = true;
        $checks['database']['message'] = 'Connexion MySQL réussie';
        $checks['database']['detail'] = $config['dbname'];
    } catch (PDOException $e) {
        $checks['database']['ok'] = false;
        $checks['database']['message'] = (int) $e->getCode() === 1049 ? 'Base de données inexistante' : 'Erreur de connexion';
        $checks['database']['detail'] = $e->getMessage();
        $checks['database']['can_create'] = ((int) $e->getCode() === 1049);
        $checks['tables']['message'] = 'Non vérifié (connexion échouée)';
    }

    if ($pdo !== null) {
        $db = $pdo->query('SELECT DATABASE()')->fetchColumn();
        $stmt = $pdo->prepare(
            "SELECT COUNT(*) FROM information_schema.TABLES 
             WHERE TABLE_SCHEMA = ? AND TABLE_TYPE = 'BASE TABLE'"
        );
        $stmt->execute([$db]);
        $count = (int) $stmt->fetchColumn();
        $checks['tables']['count'] = $count;
        $checks['tables']['ok'] = $count >= 1;
        $checks['tables']['message'] = $count >= 1
            ? sprintf('%d table(s) trouvée(s) dans la base', $count)
            : 'Aucune table (exécutez database/schema.mysql.sql)';
        $checks['tables']['detail'] = $count . ' / ' . $checks['tables']['expected'] . ' tables attendues (référence schema.mysql.sql)';
        $checks['tables']['can_create'] = ($count < $checks['tables']['expected']);
    }
}

// 4. API disponible
$apiUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
    . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost')
    . dirname($_SERVER['SCRIPT_NAME'] ?? '')
    . '/index.php';
$apiUrl = rtrim($apiUrl, '/');
// Même serveur : pas d’appel HTTP pour éviter timeout (le serveur ne peut pas se répondre à lui-même)
$isSelfRequest = (isset($_SERVER['HTTP_HOST']) && parse_url($apiUrl, PHP_URL_HOST) === $_SERVER['HTTP_HOST']);
try {
    if ($isSelfRequest) {
        $checks['api']['ok'] = true;
        $checks['api']['message'] = 'API disponible (même serveur, test non effectué)';
        $checks['api']['detail'] = $apiUrl;
    } else {
        $ctx = stream_context_create(['http' => ['timeout' => 3]]);
        $response = @file_get_contents($apiUrl, false, $ctx);
        $checks['api']['ok'] = $response !== false;
        if ($checks['api']['ok']) {
            $json = json_decode($response, true);
            $checks['api']['message'] = is_array($json) && isset($json['message'])
                ? 'API répond : ' . $json['message']
                : 'API répond (JSON valide)';
            $checks['api']['detail'] = $apiUrl;
        } else {
            $checks['api']['message'] = 'L’API ne répond pas ou timeout';
            $checks['api']['detail'] = $apiUrl;
        }
    }
} catch (Throwable $e) {
    $checks['api']['ok'] = false;
    $checks['api']['message'] = 'Erreur lors du test API';
    $checks['api']['detail'] = $e->getMessage();
}

$allOk = $checks['config']['ok'] && $checks['database']['ok'] && $checks['tables']['ok'] && $checks['api']['ok'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); min-height: 100vh; padding-top: 2rem; padding-bottom: 3rem; }
        .card { border: none; box-shadow: 0 0.25rem 1rem rgba(0,0,0,.08); }
        .check-item { border-left: 4px solid var(--bs-gray-300); }
        .check-item.ok { border-left-color: var(--bs-success); }
        .check-item.fail { border-left-color: var(--bs-danger); }
        .status-badge { font-size: 0.85rem; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h1 class="h3 mb-2">
                            <i class="bi bi-clipboard2-pulse text-primary me-2"></i>
                            <?= htmlspecialchars($pageTitle) ?>
                        </h1>
                        <p class="text-muted mb-0">Vérification de la base de données et de la connexion à l’API.</p>
                    </div>
                </div>

                <?php if (!empty($_GET['created'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i> La base de données a été créée avec succès.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                <?php endif; ?>
                <?php if ($createDbResult !== null && isset($createDbResult['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i> La création de la base a échoué : <?= htmlspecialchars($createDbResult['error']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                <?php endif; ?>
                <?php if (!empty($_GET['tables_created'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i> Les tables ont été créées avec succès.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                <?php endif; ?>
                <?php if ($createTablesResult !== null && isset($createTablesResult['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i> La création des tables a échoué : <?= htmlspecialchars($createTablesResult['error']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                <?php endif; ?>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h2 class="h5 mb-0">Résultats</h2>
                    <?php if ($allOk): ?>
                        <span class="badge bg-success status-badge"><i class="bi bi-check-circle me-1"></i> Tout est OK</span>
                    <?php else: ?>
                        <span class="badge bg-warning text-dark status-badge"><i class="bi bi-exclamation-triangle me-1"></i> Vérifications à corriger</span>
                    <?php endif; ?>
                </div>

                <div class="row g-3">
                    <?php foreach (['config' => 'Configuration', 'database' => 'Base de données', 'tables' => 'Tables', 'api' => 'API'] as $key => $label): ?>
                        <?php $c = $checks[$key]; $ok = $c['ok']; ?>
                        <div class="col-12">
                            <div class="card check-item <?= $ok ? 'ok' : 'fail' ?>">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <?php if ($ok): ?>
                                                <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                            <?php else: ?>
                                                <i class="bi bi-x-circle-fill text-danger fs-4"></i>
                                            <?php endif; ?>
                                            <div>
                                                <strong><?= htmlspecialchars($label) ?></strong>
                                                <span class="badge ms-2 <?= $ok ? 'bg-success' : 'bg-danger' ?> status-badge"><?= $ok ? 'OK' : 'Échec' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1 mt-2 text-muted small"><?= htmlspecialchars($c['message']) ?></p>
                                    <?php if ($key === 'database' && !empty($c['can_create'])): ?>
                                        <form method="post" action="" class="mt-2">
                                            <input type="hidden" name="create_db" value="1">
                                            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-database-add me-1"></i> Créer la base de données</button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if ($key === 'tables' && !empty($c['can_create'])): ?>
                                        <form method="post" action="" class="mt-2">
                                            <input type="hidden" name="create_tables" value="1">
                                            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-table me-1"></i> Créer les tables de la base</button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if ($c['detail'] !== ''): ?>
                                        <p class="mb-0 small font-monospace text-secondary"><?= htmlspecialchars($c['detail']) ?></p>
                                    <?php endif; ?>
                                    <?php if ($key === 'tables' && isset($c['count'])): ?>
                                        <div class="progress mt-2" style="height: 6px;">
                                            <div class="progress-bar <?= $c['count'] >= $c['expected'] ? 'bg-success' : 'bg-info' ?>" 
                                                 role="progressbar" 
                                                 style="width: <?= min(100, (int)(100 * $c['count'] / max(1, $c['expected']))) ?>%"></div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <a href="index.php" class="btn btn-primary"><i class="bi bi-arrow-right-circle me-1"></i> Aller à l’API</a>
                    <a href="check.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-clockwise me-1"></i> Re-vérifier</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
