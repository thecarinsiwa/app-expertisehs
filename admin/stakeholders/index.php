<?php
/** Tableau de bord - Module Parties prenantes */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Parties prenantes';
$active_menu = 'stakeholders';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$module_dashboard_title = 'Parties prenantes';
$module_dashboard_subtitle = 'Communautés cibles, bénéficiaires, contacts locaux et partenaires.';
$module_dashboard_entities = [
    ['table' => 'target_communities',         'label' => 'Communautés cibles',       'href' => 'stakeholders/target_communities_view.php',         'icon' => 'bi-bullseye'],
    ['table' => 'beneficiaries',              'label' => 'Bénéficiaires',            'href' => 'stakeholders/beneficiaries_view.php',              'icon' => 'bi-people'],
    ['table' => 'local_contacts',             'label' => 'Contacts locaux',           'href' => 'stakeholders/local_contacts_view.php',             'icon' => 'bi-telephone'],
    ['table' => 'local_partner_institutions',  'label' => 'Partenaires locaux',        'href' => 'stakeholders/local_partner_institutions_view.php', 'icon' => 'bi-building'],
];

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/module_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
