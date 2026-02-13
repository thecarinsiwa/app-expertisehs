<?php
/**
 * Liste des bénéficiaires - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Bénéficiaires';
$active_menu = 'stakeholders';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'beneficiaries';
$table_view_title = 'Bénéficiaires';
$table_view_module = 'stakeholders';
$table_view_prefix = 'beneficiaries';
$table_view_entity = 'Bénéficiaire';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-people';
$table_view_index_href = 'stakeholders/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
