<?php
/** Tableau de bord - Module Administration */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Administration';
$active_menu = 'admin';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$module_dashboard_title = 'Administration';
$module_dashboard_subtitle = 'Utilisateurs, profils d\'accès, journal d\'activité et configurations.';
$module_dashboard_entities = [
    ['table' => 'users',            'label' => 'Utilisateurs',      'href' => 'admin/users_view.php',            'icon' => 'bi-person-gear'],
    ['table' => 'access_profiles',  'label' => 'Profils d\'accès',  'href' => 'admin/access_profiles_view.php',  'icon' => 'bi-shield-lock'],
    ['table' => 'activity_log',     'label' => 'Journal d\'activité', 'href' => 'admin/activity_log_view.php',     'icon' => 'bi-journal-text'],
    ['table' => 'configurations',   'label' => 'Configurations',     'href' => 'admin/configurations_view.php',   'icon' => 'bi-gear'],
];

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/module_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
