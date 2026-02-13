<?php
/**
 * Liste des projets - ExpertiseHS (vue dashboard)
 * Table: projects
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Projets d\'expertise';
$active_menu = 'projects';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'projects';
$table_view_title = 'Projets d\'expertise';
$table_view_module = 'projects';
$table_view_prefix = 'projects';
$table_view_entity = 'Projet';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-briefcase';
$table_view_index_href = 'projects/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
