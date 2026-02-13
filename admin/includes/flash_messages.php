<?php
/**
 * Messages flash (succès / erreur) à partir des paramètres GET.
 * Définir optionnellement $flash_entity (ex. "Projet", "Actualité") et $flash_entity_feminine (true pour accord au féminin).
 */
$entity = isset($flash_entity) ? $flash_entity : 'L\'enregistrement';
$fem = !empty($flash_entity_feminine);
$created_s = $fem ? 'e' : '';
$updated_label = $fem ? 'mise à jour' : 'mis à jour';
$deleted_s = $fem ? 'e' : '';
?>
<?php if (isset($_GET['created']) && $_GET['created'] === '1'): ?>
    <div class="alert alert-success" role="alert"><?php echo htmlspecialchars($entity); ?> créé<?php echo $created_s; ?> avec succès.</div>
<?php endif; ?>
<?php if (isset($_GET['updated']) && $_GET['updated'] === '1'): ?>
    <div class="alert alert-success" role="alert"><?php echo htmlspecialchars($entity); ?> <?php echo $updated_label; ?>.</div>
<?php endif; ?>
<?php if (isset($_GET['deleted']) && $_GET['deleted'] === '1'): ?>
    <div class="alert alert-success" role="alert"><?php echo htmlspecialchars($entity); ?> supprimé<?php echo $deleted_s; ?>.</div>
<?php endif; ?>
<?php if (isset($_GET['error']) && $_GET['error'] === '1'): ?>
    <div class="alert alert-danger" role="alert">Une erreur est survenue.</div>
<?php endif; ?>
