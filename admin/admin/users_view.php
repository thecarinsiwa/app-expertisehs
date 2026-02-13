<?php
/**
 * Liste des utilisateurs - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Utilisateurs';
$active_menu = 'admin';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'users';
$table_view_title = 'Utilisateurs';
$table_view_module = 'admin';
$table_view_prefix = 'users';
$table_view_entity = 'Utilisateur';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-person-gear';
$table_view_index_href = 'admin/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
