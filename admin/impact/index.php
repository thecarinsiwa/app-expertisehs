<?php
/** Tableau de bord - Module Impact et évaluation */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Impact et évaluation';
$active_menu = 'impact';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$module_dashboard_title = 'Impact et évaluation';
$module_dashboard_subtitle = 'Indicateurs, mesures, évaluations, témoignages et rapports d\'impact.';
$module_dashboard_entities = [
    ['table' => 'result_indicators',     'label' => 'Indicateurs de résultat', 'href' => 'impact/result_indicators_view.php',     'icon' => 'bi-graph-up'],
    ['table' => 'indicator_measurements', 'label' => 'Mesures indicateurs',     'href' => 'impact/indicator_measurements_view.php', 'icon' => 'bi-rulers'],
    ['table' => 'project_evaluations',   'label' => 'Évaluations projet',      'href' => 'impact/project_evaluations_view.php',   'icon' => 'bi-clipboard-check'],
    ['table' => 'testimonials',          'label' => 'Témoignages',            'href' => 'impact/testimonials_view.php',          'icon' => 'bi-chat-quote'],
    ['table' => 'impact_reports',        'label' => 'Rapports d\'impact',       'href' => 'impact/impact_reports_view.php',        'icon' => 'bi-file-earmark-bar-graph'],
];

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/module_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
