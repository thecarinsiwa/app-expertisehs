<?php
/** Tableau de bord - Module Gestion des connaissances */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Gestion des connaissances';
$active_menu = 'knowledge';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$module_dashboard_title = 'Gestion des connaissances';
$module_dashboard_subtitle = 'Ressources documentaires, bonnes pratiques, leçons apprises et bibliothèque de modèles.';
$module_dashboard_entities = [
    ['table' => 'documentary_resources', 'label' => 'Ressources documentaires', 'href' => 'knowledge/documentary_resources_view.php', 'icon' => 'bi-journal-bookmark'],
    ['table' => 'best_practices',        'label' => 'Bonnes pratiques',          'href' => 'knowledge/best_practices_view.php',        'icon' => 'bi-star'],
    ['table' => 'lessons_learned',       'label' => 'Leçons apprises',            'href' => 'knowledge/lessons_learned_view.php',       'icon' => 'bi-lightbulb'],
    ['table' => 'model_library',         'label' => 'Bibliothèque de modèles',   'href' => 'knowledge/model_library_view.php',         'icon' => 'bi-collection'],
];

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/module_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
