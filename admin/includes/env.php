<?php
/**
 * Variables d'environnement layout (chemin vers admin pour assets et liens).
 * À inclure en premier dans chaque page admin, ou est inclus par layout_start.php.
 * admin_base = '' depuis admin/, '../' depuis admin/sous-dossier/, etc.
 */
if (!isset($admin_base)) {
    $dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    $dir = trim($dir, '/');
    $segments = $dir ? explode('/', $dir) : [];
    $depth = count($segments);
    // Remonter d'un niveau par sous-dossier sous "admin" (admin = dernier segment utile)
    $levels_up = max(0, $depth - 2);
    $admin_base = $levels_up > 0 ? str_repeat('../', $levels_up) : '';
}
