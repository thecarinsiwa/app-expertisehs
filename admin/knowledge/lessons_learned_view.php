<?php
/**
 * Liste des leçons apprises - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Leçons apprises';
$active_menu = 'knowledge';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'lessons_learned';
$table_view_title = 'Leçons apprises';
$table_view_module = 'knowledge';
$table_view_prefix = 'lessons_learned';
$table_view_entity = 'Leçon apprise';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-lightbulb';
$table_view_index_href = 'knowledge/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
