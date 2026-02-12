<?php
/**
 * Page de documentation de l’API ExpertiseHS (inclus par index.php à la racine).
 * Variables attendues : $apiBaseUrl (string), $apiTables (array).
 */
$apiBaseUrl = $apiBaseUrl ?? '';
$apiTables = $apiTables ?? [];
$title = 'Expertise Humanitaire et Sociale API';
$checkUrl = preg_replace('#/index\.php$#', '', $apiBaseUrl) . '/check.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0f1419;
            --surface: #1a2332;
            --border: #2d3a4f;
            --text: #e6edf3;
            --text-muted: #8b9cb3;
            --accent: #3b82f6;
            --accent-soft: rgba(59, 130, 246, 0.15);
            --success: #22c55e;
            --warning: #eab308;
            --radius: 8px;
            --font-sans: 'DM Sans', system-ui, sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: var(--font-sans);
            font-size: 15px;
            line-height: 1.6;
            min-height: 100vh;
        }
        .wrap { max-width: 960px; margin: 0 auto; padding: 2rem 1.5rem; }
        h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 0 0.5rem;
            letter-spacing: -0.02em;
        }
        .tagline { color: var(--text-muted); margin: 0 0 2rem; font-size: 1rem; }
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }
        .card h2 {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0 0 0.75rem;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .card h2 .icon { opacity: 0.8; }
        .base-url {
            font-family: var(--font-mono);
            font-size: 0.9rem;
            background: var(--bg);
            padding: 0.6rem 0.9rem;
            border-radius: 6px;
            border: 1px solid var(--border);
            color: var(--accent);
            word-break: break-all;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }
        th, td { padding: 0.5rem 0.75rem; text-align: left; border-bottom: 1px solid var(--border); }
        th { color: var(--text-muted); font-weight: 500; }
        tr:last-child td { border-bottom: 0; }
        .method {
            font-family: var(--font-mono);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
        }
        .method.get { background: rgba(34, 197, 94, 0.2); color: var(--success); }
        .method.post { background: rgba(59, 130, 246, 0.2); color: var(--accent); }
        .method.put { background: rgba(234, 179, 8, 0.2); color: var(--warning); }
        .method.delete { background: rgba(239, 68, 68, 0.2); color: #ef4444; }
        .endpoint { font-family: var(--font-mono); font-size: 0.85rem; color: var(--text); }
        .tiles {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 0.5rem;
        }
        .tiles a {
            display: block;
            padding: 0.5rem 0.75rem;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 6px;
            color: var(--text);
            text-decoration: none;
            font-size: 0.85rem;
            font-family: var(--font-mono);
            transition: border-color 0.15s, background 0.15s;
        }
        .tiles a:hover { border-color: var(--accent); background: var(--accent-soft); }
        pre, code {
            font-family: var(--font-mono);
            font-size: 0.8rem;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 6px;
        }
        pre { padding: 1rem; overflow-x: auto; margin: 0 0 1rem; }
        code { padding: 0.15rem 0.4rem; }
        .foot {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
            color: var(--text-muted);
            font-size: 0.85rem;
        }
        .foot a { color: var(--accent); text-decoration: none; }
        .foot a:hover { text-decoration: underline; }
        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0.75rem 1.5rem;
            margin-bottom: 0;
        }
        .topbar .wrap { padding-top: 0.75rem; padding-bottom: 0.75rem; display: flex; align-items: center; justify-content: space-between; }
        .topbar a { color: var(--text-muted); text-decoration: none; font-size: 0.9rem; }
        .topbar a:hover { color: var(--accent); }
    </style>
</head>
<body>
    <nav class="topbar">
        <div class="wrap" style="max-width: 960px; margin: 0 auto;">
            <span style="font-weight: 600; color: var(--text);"><?= htmlspecialchars($title) ?></span>
            <a href="<?= htmlspecialchars($checkUrl) ?>">Vérification DB & API</a>
        </div>
    </nav>
    <div class="wrap">
        <h1><?= htmlspecialchars($title) ?></h1>
        <p class="tagline">API REST CRUD pour la plateforme Expertise Humanitaire et Sociale — toutes les ressources en JSON.</p>

        <section class="card">
            <h2><span class="icon">🔗</span> URL de base</h2>
            <div class="base-url"><?= htmlspecialchars($apiBaseUrl) ?></div>
            <p style="margin: 0.75rem 0 0; color: var(--text-muted); font-size: 0.9rem;">Utilisez cette URL comme préfixe pour tous les appels (ex. <code><?= htmlspecialchars(rtrim($apiBaseUrl, '/') . '/organizations') ?></code>).</p>
        </section>

        <section class="card">
            <h2><span class="icon">📡</span> Endpoints</h2>
            <table>
                <thead>
                    <tr>
                        <th>Méthode</th>
                        <th>URL</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="method get">GET</span></td>
                        <td class="endpoint">/</td>
                        <td>Cette page (documentation) ou JSON des tables si <code>Accept: application/json</code></td>
                    </tr>
                    <tr>
                        <td><span class="method get">GET</span></td>
                        <td class="endpoint">/{table}</td>
                        <td>Liste des enregistrements. Query : <code>?limit=100&offset=0</code></td>
                    </tr>
                    <tr>
                        <td><span class="method get">GET</span></td>
                        <td class="endpoint">/{table}/{id}</td>
                        <td>Détail d’un enregistrement (UUID)</td>
                    </tr>
                    <tr>
                        <td><span class="method post">POST</span></td>
                        <td class="endpoint">/{table}</td>
                        <td>Création — body JSON</td>
                    </tr>
                    <tr>
                        <td><span class="method put">PUT</span></td>
                        <td class="endpoint">/{table}/{id}</td>
                        <td>Mise à jour — body JSON</td>
                    </tr>
                    <tr>
                        <td><span class="method delete">DELETE</span></td>
                        <td class="endpoint">/{table}/{id}</td>
                        <td>Suppression</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="card">
            <h2><span class="icon">📦</span> Ressources (tables)</h2>
            <p style="margin: 0 0 0.75rem; color: var(--text-muted); font-size: 0.9rem;">Cliquez pour construire l’URL (ex. <code>/organizations</code>).</p>
            <div class="tiles">
                <?php foreach ($apiTables as $table): ?>
                    <a href="<?= htmlspecialchars($apiBaseUrl . '/' . $table) ?>"><?= htmlspecialchars($table) ?></a>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="card">
            <h2> Exemples</h2>
            <p style="margin: 0 0 0.5rem; color: var(--text-muted); font-size: 0.9rem;">Liste des organisations (GET) :</p>
            <pre><?= htmlspecialchars('GET ' . rtrim($apiBaseUrl, '/') . '/organizations?limit=10') ?></pre>
            <p style="margin: 0.5rem 0 0.5rem; color: var(--text-muted); font-size: 0.9rem;">Création (POST, body JSON) :</p>
            <pre><?= htmlspecialchars("POST " . rtrim($apiBaseUrl, '/') . "/organizations\nContent-Type: application/json\n\n{\"name\": \"Mon ONG\", \"country_code\": \"FRA\"}") ?></pre>
            <p style="margin: 0.5rem 0 0.5rem; color: var(--text-muted); font-size: 0.9rem;">Mise à jour (PUT) et suppression (DELETE) :</p>
            <pre><?= htmlspecialchars("PUT " . rtrim($apiBaseUrl, '/') . "/organizations/{uuid}\nDELETE " . rtrim($apiBaseUrl, '/') . "/organizations/{uuid}") ?></pre>
        </section>

        <section class="card">
            <h2><span class="icon">⚙️</span> Détails techniques</h2>
            <ul style="margin: 0; padding-left: 1.25rem; color: var(--text-muted); font-size: 0.9rem;">
                <li>Réponses en <strong>JSON</strong>, encodage UTF-8.</li>
                <li><strong>CORS</strong> autorisé (<code>Access-Control-Allow-Origin: *</code>) pour les appels depuis un front.</li>
                <li>Identifiants : <strong>UUID</strong> (CHAR(36)) pour toutes les tables.</li>
                <li>Pagination : <code>limit</code> (1–500, défaut 100) et <code>offset</code> (défaut 0).</li>
            </ul>
        </section>

        <footer class="foot">
            <a href="<?= htmlspecialchars($checkUrl) ?>">Vérification DB & API</a>
            — Expertise Humanitaire et Sociale
        </footer>
    </div>
</body>
</html>
