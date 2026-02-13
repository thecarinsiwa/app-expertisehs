<?php
/**
 * Liste des partenaires institutionnels - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Partenaires institutionnels';
$active_menu = 'organizational';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'institutional_partners';
$table_view_title = 'Partenaires institutionnels';
$table_view_module = 'organizational';
$table_view_prefix = 'institutional_partners';
$table_view_entity = 'Partenaire institutionnel';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-link-45deg';
$table_view_index_href = 'organizational/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
