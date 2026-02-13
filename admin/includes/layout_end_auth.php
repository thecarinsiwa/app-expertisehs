<?php
/**
 * Fin du layout pour les pages d'authentification.
 * Fermeture de <main>, scripts communs, body, html.
 */
?>
    </main>
    <?php require __DIR__ . '/scripts.php'; ?>
    <?php
    if (!empty($page_scripts)) {
        echo $page_scripts;
    }
    ?>
</body>
</html>
