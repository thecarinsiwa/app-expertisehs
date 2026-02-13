<?php
/**
 * Liste des contacts locaux - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Contacts locaux';
$active_menu = 'stakeholders';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'local_contacts';
$table_view_title = 'Contacts locaux';
$table_view_module = 'stakeholders';
$table_view_prefix = 'local_contacts';
$table_view_entity = 'Contact local';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-telephone';
$table_view_index_href = 'stakeholders/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
