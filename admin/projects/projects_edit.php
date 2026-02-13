<?php
/**
 * Édition projet - ExpertiseHS
 * Table: projects
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Modifier le projet';
$active_menu = 'projects';

$id = isset($_GET['id']) ? trim($_GET['id']) : '';

if ($id === '') {
    header('Location: ' . (isset($admin_base) ? $admin_base : '') . 'projects/projects_view.php');
    exit;
}

try {
    $pdo = Db::getConnection();
    $crud = new CrudHandler($pdo, 'projects');
    $item = $crud->get($id);
    $columns = $crud->getEditableColumnNames();
} catch (PDOException $e) {
    header('Location: ' . (isset($admin_base) ? $admin_base : '') . 'projects/projects_view.php?error=1');
    exit;
}

if ($item === null) {
    header('Location: ' . $admin_base . 'projects/projects_view.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [];
    foreach ($columns as $col) {
        if (array_key_exists($col, $_POST)) {
            $val = trim((string) $_POST[$col]);
            $data[$col] = $val === '' ? null : $val;
        }
    }
    if (in_array('beneficiary_count', $columns, true) && isset($_POST['beneficiary_count']) && $_POST['beneficiary_count'] !== '') {
        $data['beneficiary_count'] = (int) $_POST['beneficiary_count'];
    }
    try {
        $crud->update($id, $data);
        header('Location: ' . $admin_base . 'projects/projects_view.php?updated=1');
        exit;
    } catch (Exception $e) {
        $error_message = 'Erreur lors de la mise à jour.';
        $form_data = $_POST;
    }
}

$form_data = $form_data ?? $item;

require __DIR__ . '/../includes/layout_start.php';
?>

<header class="page-header">
    <h1 class="page-title">Modifier le projet</h1>
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
                if (is_object($val) || is_array($val)) {
                    $val = '';
                }
                $val = (string) $val;
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
