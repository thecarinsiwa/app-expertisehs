<?php
/**
 * Bootstrap couche données admin - charge Db et CrudHandler depuis l'API.
 * À inclure après env.php dans les pages admin qui ont besoin d'accéder à la base.
 * Depuis admin/includes/ : api est à ../../api
 */
if (!isset($api_root)) {
    $api_root = __DIR__ . '/../../api';
}
require_once $api_root . '/includes/Db.php';
require_once $api_root . '/includes/CrudHandler.php';
