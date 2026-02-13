<?php
/**
 * Liste des médias - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Médias';
$active_menu = 'communication';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'media';
$table_view_title = 'Médias';
$table_view_module = 'communication';
$table_view_prefix = 'media';
$table_view_entity = 'Média';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-image';
$table_view_index_href = 'communication/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
