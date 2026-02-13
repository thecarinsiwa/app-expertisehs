<?php
/**
 * En-tête HTML commun (head + meta, CSS)
 * Utilisé par layout_start.php. Dépend de $admin_base (chemin relatif vers admin/).
 */
$layout_title = isset($page_title) ? $page_title : 'Dashboard';
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($layout_title); ?> - Expertise Humanitaire et Sociale</title>
<script>
(function(){var t=localStorage.getItem('expertisehs-theme');document.documentElement.setAttribute('data-theme',t==='dark'?'dark':'light');})();
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="<?php echo $admin_base; ?>assets/css/admin.css" rel="stylesheet">
<?php
if (!empty($page_styles)) {
    echo $page_styles;
}
if (!empty($head_extra)) {
    echo $head_extra;
}
?>
