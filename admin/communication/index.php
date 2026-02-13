<?php
/** Tableau de bord - Module Communication */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Communication';
$active_menu = 'communication';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$module_dashboard_title = 'Communication';
$module_dashboard_subtitle = 'Actualités, publications, médias et newsletters.';
$module_dashboard_entities = [
    ['table' => 'news',          'label' => 'Actualités',    'href' => 'communication/news_view.php',          'icon' => 'bi-newspaper'],
    ['table' => 'publications',  'label' => 'Publications',  'href' => 'communication/publications_view.php',  'icon' => 'bi-file-earmark-text'],
    ['table' => 'media',         'label' => 'Médias',        'href' => 'communication/media_view.php',         'icon' => 'bi-image'],
    ['table' => 'newsletters',   'label' => 'Newsletters',  'href' => 'communication/newsletters_view.php',   'icon' => 'bi-envelope'],
];

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/module_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
