<?php
/**
 * Liste des compétences experts - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Compétences des experts';
$active_menu = 'hr';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'expert_skills';
$table_view_title = 'Compétences des experts';
$table_view_module = 'hr';
$table_view_prefix = 'expert_skills';
$table_view_entity = 'Compétence expert';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-award';
$table_view_index_href = 'hr/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
