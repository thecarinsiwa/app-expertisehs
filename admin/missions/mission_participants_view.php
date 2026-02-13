<?php
/**
 * Liste des participants aux missions - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Participants aux missions';
$active_menu = 'missions';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'mission_participants';
$table_view_title = 'Participants aux missions';
$table_view_module = 'missions';
$table_view_prefix = 'mission_participants';
$table_view_entity = 'Participant';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-people';
$table_view_index_href = 'missions/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
