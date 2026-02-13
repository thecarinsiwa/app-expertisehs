<?php
/**
 * Liste des bonnes pratiques - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Bonnes pratiques';
$active_menu = 'knowledge';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'best_practices';
$table_view_title = 'Bonnes pratiques';
$table_view_module = 'knowledge';
$table_view_prefix = 'best_practices';
$table_view_entity = 'Bonne pratique';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-star';
$table_view_index_href = 'knowledge/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
