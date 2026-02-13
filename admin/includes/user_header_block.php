<?php
/**
 * Bloc utilisateur connecté pour l'en-tête (avatar + nom).
 * Lit le cookie expertisehs_user (JSON) défini au login.
 */
$current_user = null;
if (!empty($_COOKIE['expertisehs_user'])) {
    $decoded = @json_decode($_COOKIE['expertisehs_user'], true);
    if (is_array($decoded)) {
        $current_user = $decoded;
    }
}
if (!$current_user) {
    return;
}
$name = trim(($current_user['first_name'] ?? '') . ' ' . ($current_user['last_name'] ?? ''));
if ($name === '') {
    $name = $current_user['email'] ?? 'Utilisateur';
}
$initials = '';
if (!empty($current_user['first_name']) || !empty($current_user['last_name'])) {
    $f = mb_substr($current_user['first_name'] ?? '', 0, 1);
    $l = mb_substr($current_user['last_name'] ?? '', 0, 1);
    $initials = strtoupper($f . $l);
} else {
    $initials = mb_strtoupper(mb_substr($current_user['email'] ?? 'U', 0, 2));
}
?>
<div class="user-header-block d-flex align-items-center gap-2">
    <div class="user-header-avatar" title="<?php echo htmlspecialchars($name); ?>">
        <?php echo htmlspecialchars($initials); ?>
    </div>
    <div class="user-header-info text-end">
        <span class="user-header-name"><?php echo htmlspecialchars($name); ?></span>
        <span class="user-header-email d-block small text-muted"><?php echo htmlspecialchars($current_user['email'] ?? ''); ?></span>
    </div>
</div>
