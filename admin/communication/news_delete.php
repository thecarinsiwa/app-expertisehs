<?php
/**
 * Suppression actualité - ExpertiseHS
 * Table: news
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$id = isset($_POST['id']) ? trim($_POST['id']) : (isset($_GET['id']) ? trim($_GET['id']) : '');

if ($id === '') {
    header('Location: ' . (isset($admin_base) ? $admin_base : '') . 'communication/news_view.php');
    exit;
}

try {
    $pdo = Db::getConnection();
    $crud = new CrudHandler($pdo, 'news');
    if ($crud->get($id) === null) {
        header('Location: ' . $admin_base . 'communication/news_view.php');
        exit;
    }
    $crud->delete($id);
} catch (Exception $e) {
    // continue to redirect
}

header('Location: ' . $admin_base . 'communication/news_view.php?deleted=1');
exit;
