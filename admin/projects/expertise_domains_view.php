<?php
/**
 * Liste des domaines d'expertise - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Domaines d\'expertise';
$active_menu = 'projects';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'expertise_domains';
$table_view_title = 'Domaines d\'expertise';
$table_view_module = 'projects';
$table_view_prefix = 'expertise_domains';
$table_view_entity = 'Domaine d\'expertise';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-journal';
$table_view_index_href = 'projects/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
