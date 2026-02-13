<?php
/** Tableau de bord - Module Missions d'expertise */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Missions d\'expertise';
$active_menu = 'missions';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$module_dashboard_title = 'Missions d\'expertise';
$module_dashboard_subtitle = 'Missions, participants, activités et livrables.';
$module_dashboard_entities = [
    ['table' => 'expertise_missions',   'label' => 'Missions',            'href' => 'missions/expertise_missions_view.php',   'icon' => 'bi-airplane'],
    ['table' => 'mission_participants', 'label' => 'Participants',         'href' => 'missions/mission_participants_view.php', 'icon' => 'bi-people'],
    ['table' => 'mission_activities',   'label' => 'Activités',            'href' => 'missions/mission_activities_view.php',  'icon' => 'bi-activity'],
    ['table' => 'mission_deliverables', 'label' => 'Livrables mission',    'href' => 'missions/mission_deliverables_view.php', 'icon' => 'bi-check2-square'],
];

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/module_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
