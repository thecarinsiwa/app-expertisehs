<?php
/**
 * Liste de la bibliothèque de modèles - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Bibliothèque de modèles';
$active_menu = 'knowledge';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'model_library';
$table_view_title = 'Bibliothèque de modèles';
$table_view_module = 'knowledge';
$table_view_prefix = 'model_library';
$table_view_entity = 'Modèle';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-collection';
$table_view_index_href = 'knowledge/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
