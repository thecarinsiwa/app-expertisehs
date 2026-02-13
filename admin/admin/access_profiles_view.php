<?php
/**
 * Liste des profils d'accès - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Profils d\'accès';
$active_menu = 'admin';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'access_profiles';
$table_view_title = 'Profils d\'accès';
$table_view_module = 'admin';
$table_view_prefix = 'access_profiles';
$table_view_entity = 'Profil d\'accès';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-shield-lock';
$table_view_index_href = 'admin/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
