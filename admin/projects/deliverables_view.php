<?php
/**
 * Liste des livrables - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Livrables';
$active_menu = 'projects';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'deliverables';
$table_view_title = 'Livrables';
$table_view_module = 'projects';
$table_view_prefix = 'deliverables';
$table_view_entity = 'Livrable';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-check2-square';
$table_view_index_href = 'projects/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
