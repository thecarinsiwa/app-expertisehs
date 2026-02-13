<?php
/**
 * Liste des contrats de financement - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Contrats de financement';
$active_menu = 'funding';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'funding_contracts';
$table_view_title = 'Contrats de financement';
$table_view_module = 'funding';
$table_view_prefix = 'funding_contracts';
$table_view_entity = 'Contrat de financement';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-file-earmark-text';
$table_view_index_href = 'funding/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
