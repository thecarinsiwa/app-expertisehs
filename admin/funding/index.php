<?php
/** Tableau de bord - Module Financement et budget */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Financement et budget';
$active_menu = 'funding';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$module_dashboard_title = 'Financement et budget';
$module_dashboard_subtitle = 'Donateurs, contrats, budgets et lignes budgétaires.';
$module_dashboard_entities = [
    ['table' => 'donors',              'label' => 'Donateurs',           'href' => 'funding/donors_view.php',              'icon' => 'bi-currency-dollar'],
    ['table' => 'funding_contracts',   'label' => 'Contrats de financement', 'href' => 'funding/funding_contracts_view.php', 'icon' => 'bi-file-earmark-text'],
    ['table' => 'project_budgets',    'label' => 'Budgets projet',      'href' => 'funding/project_budgets_view.php',    'icon' => 'bi-wallet2'],
    ['table' => 'budget_lines',       'label' => 'Lignes budgétaires',  'href' => 'funding/budget_lines_view.php',       'icon' => 'bi-list-ul'],
];

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/module_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
