<?php
/**
 * Liste des membres des comités - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Membres des comités';
$active_menu = 'governance';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'steering_committee_members';
$table_view_title = 'Membres des comités';
$table_view_module = 'governance';
$table_view_prefix = 'steering_committee_members';
$table_view_entity = 'Membre';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-people';
$table_view_index_href = 'governance/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
