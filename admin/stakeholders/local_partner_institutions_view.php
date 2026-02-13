<?php
/**
 * Liste des partenaires locaux - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Partenaires locaux';
$active_menu = 'stakeholders';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'local_partner_institutions';
$table_view_title = 'Partenaires locaux';
$table_view_module = 'stakeholders';
$table_view_prefix = 'local_partner_institutions';
$table_view_entity = 'Partenaire local';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-building';
$table_view_index_href = 'stakeholders/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
