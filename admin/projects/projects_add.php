<?php
/**
 * Ajout projet - ExpertiseHS
 * Table: projects
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Ajouter un projet';
$active_menu = 'projects';

try {
    $pdo = Db::getConnection();
    $crud = new CrudHandler($pdo, 'projects');
    $columns = $crud->getEditableColumnNames();
} catch (PDOException $e) {
    header('Location: ' . (isset($admin_base) ? $admin_base : '') . 'projects/projects_view.php?error=1');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [];
    foreach ($columns as $col) {
        if (array_key_exists($col, $_POST)) {
            $data[$col] = trim((string) $_POST[$col]);
            if ($data[$col] === '') {
                $data[$col] = null;
            }
        }
    }
    if (in_array('beneficiary_count', $columns, true) && isset($_POST['beneficiary_count']) && $_POST['beneficiary_count'] !== '') {
        $data['beneficiary_count'] = (int) $_POST['beneficiary_count'];
    }
    if (in_array('status', $columns, true) && (empty($data['status']) && $data['status'] !== '0')) {
        $data['status'] = 'draft';
    }
    try {
        $crud->create($data);
        header('Location: ' . $admin_base . 'projects/projects_view.php?created=1');
        exit;
    } catch (Exception $e) {
        $error_message = 'Erreur lors de la création.';
        $form_data = $_POST;
    }
}

$form_data = $form_data ?? array_fill_keys($columns, '');

require __DIR__ . '/../includes/layout_start.php';
?>

<header class="page-header">
    <h1 class="page-title">Ajouter un projet</h1>
    <div class="d-flex flex-wrap align-items-center gap-2">
        <a href="<?php echo $admin_base; ?>projects/projects_view.php" class="btn btn-outline-secondary btn-sm">Retour à la liste</a>
        <?php require __DIR__ . '/../includes/user_header_block.php'; ?>
    </div>
</header>

<?php if (!empty($error_message)): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="post" action="">
            <?php
            foreach ($columns as $col):
                $label = ucfirst(str_replace('_', ' ', $col));
                $val = $form_data[$col] ?? '';
                $is_textarea = in_array($col, ['description', 'objectives'], true);
                $is_date = strpos($col, 'date') !== false;
                $is_number = $col === 'beneficiary_count';
            ?>
                <div class="mb-3">
                    <label for="f_<?php echo htmlspecialchars($col); ?>" class="form-label"><?php echo htmlspecialchars($label); ?></label>
                    <?php if ($is_textarea): ?>
                        <textarea class="form-control form-control-theme" id="f_<?php echo htmlspecialchars($col); ?>" name="<?php echo htmlspecialchars($col); ?>" rows="4"><?php echo htmlspecialchars($val); ?></textarea>
                    <?php elseif ($is_date): ?>
                        <input type="date" class="form-control form-control-theme" id="f_<?php echo htmlspecialchars($col); ?>" name="<?php echo htmlspecialchars($col); ?>" value="<?php echo htmlspecialchars($val); ?>">
                    <?php elseif ($is_number): ?>
                        <input type="number" class="form-control form-control-theme" id="f_<?php echo htmlspecialchars($col); ?>" name="<?php echo htmlspecialchars($col); ?>" value="<?php echo htmlspecialchars($val); ?>" min="0" step="1">
                    <?php else: ?>
                        <input type="text" class="form-control form-control-theme" id="f_<?php echo htmlspecialchars($col); ?>" name="<?php echo htmlspecialchars($col); ?>" value="<?php echo htmlspecialchars($val); ?>">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-teal">Enregistrer</button>
                <a href="<?php echo $admin_base; ?>projects/projects_view.php" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../includes/layout_end.php'; ?>
