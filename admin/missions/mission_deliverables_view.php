<?php
/**
 * Liste des livrables mission - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Livrables des missions';
$active_menu = 'missions';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'mission_deliverables';
$table_view_title = 'Livrables des missions';
$table_view_module = 'missions';
$table_view_prefix = 'mission_deliverables';
$table_view_entity = 'Livrable';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-check2-square';
$table_view_index_href = 'missions/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
