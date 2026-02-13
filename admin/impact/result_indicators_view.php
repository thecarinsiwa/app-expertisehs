<?php
/**
 * Liste des indicateurs de résultat - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Indicateurs de résultat';
$active_menu = 'impact';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'result_indicators';
$table_view_title = 'Indicateurs de résultat';
$table_view_module = 'impact';
$table_view_prefix = 'result_indicators';
$table_view_entity = 'Indicateur de résultat';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-graph-up';
$table_view_index_href = 'impact/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
