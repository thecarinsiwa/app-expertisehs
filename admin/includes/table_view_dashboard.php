<?php
/**
 * Vue tableau de bord pour une table : métrique (effectif), liste avec actions.
 * À utiliser dans chaque *_view.php après layout_start.
 *
 * Variables requises (à définir avant l'include) :
 *   $table_view_table   : nom de la table (ex. 'projects')
 *   $table_view_title   : titre de la page (ex. "Projets d'expertise")
 *   $table_view_module  : dossier du module (ex. 'projects')
 *   $table_view_prefix  : préfixe des fichiers (ex. 'projects' -> projects_add, projects_edit...)
 *   $table_view_entity  : libellé de l'entité pour boutons et flash (ex. 'Projet')
 *   $table_view_entity_feminine : true pour accord au féminin
 *   $table_view_icon    : classe Bootstrap Icon (ex. 'bi-briefcase')
 *
 * Optionnel :
 *   $table_view_index_href : lien vers le dashboard du module (ex. 'projects/index.php')
 *
 * Prérequis : env.php, bootstrap_db.php, layout_start.php déjà inclus ; $admin_base défini.
 */
$table = isset($table_view_table) ? $table_view_table : '';
$title = isset($table_view_title) ? $table_view_title : 'Liste';
$module = isset($table_view_module) ? $table_view_module : '';
$prefix = isset($table_view_prefix) ? $table_view_prefix : '';
$entity = isset($table_view_entity) ? $table_view_entity : 'L\'enregistrement';
$entity_fem = !empty($table_view_entity_feminine);
$icon = isset($table_view_icon) ? $table_view_icon : 'bi-grid';
$index_href = isset($table_view_index_href) ? $table_view_index_href : '';

$items = [];
$total_count = 0;
$error_message = '';

$display_cols = [];
if ($table !== '') {
    try {
        $pdo = Db::getConnection();
        $crud = new CrudHandler($pdo, $table);
        $total_count = $crud->count();
        $per_page = 1000;
        $items = $crud->list($per_page, 0);
        if (!empty($items)) {
            $cols = array_keys($items[0]);
            $display_cols = array_slice(array_values(array_diff($cols, ['id'])), 0, 6);
        } else {
            $all_cols = $crud->getColumnNames();
            $display_cols = array_slice(array_values(array_diff($all_cols, ['id'])), 0, 6);
        }
    } catch (Exception $e) {
        $error_message = 'Erreur lors du chargement des données.';
    }
}

$add_url = $admin_base . $module . '/' . $prefix . '_add.php';
$edit_url_base = $admin_base . $module . '/' . $prefix . '_edit.php';
$delete_url = $admin_base . $module . '/' . $prefix . '_delete.php';
$back_url = $index_href !== '' ? $admin_base . $index_href : null;
?>
<header class="page-header">
    <h1 class="page-title"><?php echo htmlspecialchars($title); ?></h1>
    <div class="d-flex flex-wrap align-items-center gap-2">
        <?php if ($back_url): ?>
            <a href="<?php echo htmlspecialchars($back_url); ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Tableau de bord</a>
        <?php endif; ?>
        <a href="<?php echo htmlspecialchars($add_url); ?>" class="btn btn-teal btn-sm"><i class="bi bi-plus-lg me-1"></i> Ajouter</a>
        <?php require __DIR__ . '/user_header_block.php'; ?>
    </div>
</header>

<?php if ($error_message !== ''): ?>
    <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($error_message); ?></div>
<?php endif; ?>

<?php $flash_entity = $entity; $flash_entity_feminine = $entity_fem; require __DIR__ . '/flash_messages.php'; ?>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-4 col-xxl-3">
        <div class="dashboard-metric-card">
            <div class="icon-wrap icon-teal"><i class="bi <?php echo htmlspecialchars($icon); ?>"></i></div>
            <div class="metric-label">Total</div>
            <div class="metric-value"><?php echo $total_count; ?></div>
            <div class="metric-sub"><?php echo htmlspecialchars($entity); ?>(s) enregistré(s)</div>
        </div>
    </div>
</div>

<div class="dashboard-section-card">
    <div class="card-header">
        <span><i class="bi <?php echo htmlspecialchars($icon); ?> me-2"></i>Liste</span>
        <a href="<?php echo htmlspecialchars($add_url); ?>" class="btn btn-teal btn-sm">Ajouter</a>
    </div>
    <div class="table-responsive">
        <?php if ($table !== '' && $error_message === '' && !empty($display_cols)): ?>
            <table id="view-data-table" class="table table-hover align-middle mb-0" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <?php foreach ($display_cols as $col):
                            $label = ucfirst(str_replace('_', ' ', $col));
                        ?>
                            <th><?php echo htmlspecialchars($label); ?></th>
                        <?php endforeach; ?>
                        <th class="text-end no-sort" style="width: 160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $row): ?>
                        <tr>
                            <td><code class="small"><?php echo htmlspecialchars(substr($row['id'] ?? '', 0, 8)); ?>…</code></td>
                            <?php foreach ($display_cols as $col): ?>
                                <td><?php echo htmlspecialchars((string) ($row[$col] ?? '')); ?></td>
                            <?php endforeach; ?>
                            <td class="text-end">
                                <a href="<?php echo htmlspecialchars($edit_url_base); ?>?id=<?php echo urlencode($row['id']); ?>" class="btn btn-outline-primary btn-sm">Modifier</a>
                                <form method="post" action="<?php echo htmlspecialchars($delete_url); ?>" class="d-inline" onsubmit="return confirm('Supprimer ?');">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php
            $datatable_script = '<script>
(function() {
    var table = document.getElementById("view-data-table");
    if (table && typeof jQuery !== "undefined" && jQuery.fn.DataTable) {
        jQuery(table).DataTable({
            language: {
                search: "Rechercher:",
                lengthMenu: "Afficher _MENU_ entrées",
                info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                infoEmpty: "Affichage de 0 à 0 sur 0 entrées",
                infoFiltered: "(filtrées depuis _MAX_ entrées)",
                paginate: { first: "Premier", last: "Dernier", next: "Suivant", previous: "Précédent" },
                zeroRecords: "Aucun enregistrement correspondant"
            },
            pageLength: 20,
            lengthMenu: [[10, 20, 50, 100, -1], [10, 20, 50, 100, "Tout"]],
            order: [[1, "asc"]],
            columnDefs: [{ targets: ".no-sort", orderable: false }]
        });
    }
})();
</script>';
            $page_scripts = (isset($page_scripts) ? $page_scripts : '') . $datatable_script;
            ?>
        <?php elseif (empty($items) && $error_message === ''): ?>
            <p class="p-4 text-muted mb-0">Aucun enregistrement. <a href="<?php echo htmlspecialchars($add_url); ?>">Ajouter</a></p>
        <?php endif; ?>
    </div>
</div>
