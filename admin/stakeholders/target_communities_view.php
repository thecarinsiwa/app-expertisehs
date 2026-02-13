<?php
/**
 * Liste des communautés cibles - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Communautés cibles';
$active_menu = 'stakeholders';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'target_communities';
$table_view_title = 'Communautés cibles';
$table_view_module = 'stakeholders';
$table_view_prefix = 'target_communities';
$table_view_entity = 'Communauté cible';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-bullseye';
$table_view_index_href = 'stakeholders/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
