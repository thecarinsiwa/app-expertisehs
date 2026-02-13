<?php
/**
 * Liste des mesures d'indicateurs - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Mesures des indicateurs';
$active_menu = 'impact';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'indicator_measurements';
$table_view_title = 'Mesures des indicateurs';
$table_view_module = 'impact';
$table_view_prefix = 'indicator_measurements';
$table_view_entity = 'Mesure';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-rulers';
$table_view_index_href = 'impact/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
