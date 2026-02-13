<?php
/**
 * Liste des ressources documentaires - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Ressources documentaires';
$active_menu = 'knowledge';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'documentary_resources';
$table_view_title = 'Ressources documentaires';
$table_view_module = 'knowledge';
$table_view_prefix = 'documentary_resources';
$table_view_entity = 'Ressource documentaire';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-journal-bookmark';
$table_view_index_href = 'knowledge/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
