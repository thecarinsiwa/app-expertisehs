<?php
/**
 * Tableau de bord d'un module : cartes avec effectifs et liens vers les vues.
 * À utiliser dans chaque index.php de module.
 *
 * Variables requises (à définir avant l'include) :
 *   $module_dashboard_title   : titre du module (ex. "Projets d'expertise")
 *   $module_dashboard_entities : tableau de [ 'table' => 'projects', 'label' => 'Projets', 'href' => 'projects/projects_view.php', 'icon' => 'bi-briefcase' ]
 *
 * Optionnel :
 *   $module_dashboard_subtitle : sous-titre / description
 *
 * Prérequis : env.php, bootstrap_db.php, layout_start.php déjà inclus ; $admin_base défini.
 */
$module_subtitle = isset($module_dashboard_subtitle) ? $module_dashboard_subtitle : '';
$entities = isset($module_dashboard_entities) ? $module_dashboard_entities : [];

$counts = [];
foreach ($entities as $e) {
    $counts[$e['href'] ?? ('_'.$e['table']) ] = '—';
}
try {
    $pdo = Db::getConnection();
    foreach ($entities as $e) {
        $table = $e['table'] ?? '';
        $key = $e['href'] ?? ('_'.$table);
        if ($table === '') {
            $counts[$key] = 0;
            continue;
        }
        try {
            $crud = new CrudHandler($pdo, $table);
            $counts[$key] = $crud->count();
        } catch (Exception $ex) {
            $counts[$key] = '—';
        }
    }
} catch (Exception $e) {
    // keep default '—' per entity
}

$icon_classes = ['icon-teal', 'icon-orange', 'icon-blue', 'icon-green'];
?>
<header class="page-header">
    <h1 class="page-title"><?php echo htmlspecialchars($module_dashboard_title); ?></h1>
    <div class="d-flex flex-wrap align-items-center gap-2">
        <?php require __DIR__ . '/user_header_block.php'; ?>
    </div>
</header>

<?php if ($module_subtitle !== ''): ?>
<section class="dashboard-welcome">
    <p class="mb-0"><?php echo htmlspecialchars($module_subtitle); ?></p>
</section>
<?php endif; ?>

<div class="row g-3 mb-4">
    <?php foreach ($entities as $i => $e):
        $href = $admin_base . $e['href'];
        $label = $e['label'] ?? $e['table'];
        $icon = $e['icon'] ?? 'bi-grid';
        $key = $e['href'] ?? ('_'.($e['table'] ?? ''));
        $count = $counts[$key] ?? '—';
        $icon_class = $icon_classes[$i % count($icon_classes)];
    ?>
    <div class="col-sm-6 col-xl-4 col-xxl-3">
        <a href="<?php echo htmlspecialchars($href); ?>" class="text-decoration-none">
            <div class="dashboard-metric-card">
                <div class="icon-wrap <?php echo $icon_class; ?>"><i class="bi <?php echo htmlspecialchars($icon); ?>"></i></div>
                <div class="metric-label"><?php echo htmlspecialchars($label); ?></div>
                <div class="metric-value"><?php echo is_int($count) ? $count : $count; ?></div>
                <div class="metric-link text-primary">Voir la liste <i class="bi bi-arrow-right ms-1"></i></div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>

<section class="dashboard-quick-links">
    <h3 class="h6 text-muted text-uppercase mb-3" style="letter-spacing: 0.05em;">Accès rapide</h3>
    <div class="row g-2 g-md-3">
        <?php foreach ($entities as $e):
            $href = $admin_base . $e['href'];
            $label = $e['label'] ?? $e['table'];
            $icon = $e['icon'] ?? 'bi-grid';
        ?>
        <div class="col-6 col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <a href="<?php echo htmlspecialchars($href); ?>">
                        <span class="quick-icon"><i class="bi <?php echo htmlspecialchars($icon); ?>"></i></span>
                        <span class="fw-medium"><?php echo htmlspecialchars($label); ?></span>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
