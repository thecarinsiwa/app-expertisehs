<?php
/**
 * Mot de passe oublié - ExpertiseHS Admin
 * Appel API: POST /api/index.php/auth/forgot-password
 * Structure : même layout que l'admin (head, main, scripts), sans sidebar.
 */
require __DIR__ . '/includes/env.php';
$api_base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
    . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost')
    . rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/') . '/api/index.php';

$page_title = 'Mot de passe oublié';
$head_extra = '<meta name="api-base" content="' . htmlspecialchars($api_base_url) . '">';
require __DIR__ . '/includes/layout_start_auth.php';
?>
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-brand">
            <div class="auth-logo">Expertise Humanitaire et Sociale</div>
        </div>
        <h1 class="auth-title">Mot de passe oublié</h1>
        <p class="auth-subtitle">Saisissez l'email de votre compte. Un lien de réinitialisation vous sera envoyé si le compte existe.</p>
        <div id="authAlert" class="alert alert-danger d-none" role="alert"></div>
        <div id="authSuccess" class="alert alert-success d-none" role="alert"></div>
        <form id="forgotForm" action="#" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required autocomplete="email" placeholder="Entrez votre email">
            </div>
            <button type="submit" class="btn btn-login" id="submitBtn">
                <span class="btn-text">Envoyer le lien</span>
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
        </form>
        <p class="auth-footer"><a href="login.php">Retour à la connexion</a></p>
    </div>
</div>
<script>
(function () {
    var form = document.getElementById('forgotForm');
    var alertEl = document.getElementById('authAlert');
    var successEl = document.getElementById('authSuccess');
    var submitBtn = document.getElementById('submitBtn');
    var apiBase = document.querySelector('meta[name="api-base"]').getAttribute('content');

    function showError(msg) {
        successEl.classList.add('d-none');
        alertEl.textContent = msg;
        alertEl.classList.remove('d-none');
    }
    function showSuccess(msg) {
        alertEl.classList.add('d-none');
        successEl.textContent = msg;
        successEl.classList.remove('d-none');
    }
    function setLoading(loading) {
        submitBtn.querySelector('.btn-text').classList.toggle('d-none', loading);
        submitBtn.querySelector('.spinner-border').classList.toggle('d-none', !loading);
        submitBtn.disabled = loading;
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        alertEl.classList.add('d-none');
        successEl.classList.add('d-none');
        setLoading(true);
        var payload = { email: document.getElementById('email').value.trim() };

        fetch(apiBase + '/auth/forgot-password', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(function (r) {
            return r.json().then(function (data) {
                if (!r.ok) throw new Error(data.error || 'Erreur');
                return data;
            });
        })
        .then(function (data) {
            successEl.textContent = data.message || 'Si un compte existe avec cet email, un lien de réinitialisation a été envoyé.';
            successEl.classList.remove('d-none');
            setLoading(false);
        })
        .catch(function (err) {
            showError(err.message || 'Une erreur est survenue.');
            setLoading(false);
        });
    });
})();
</script>
<?php require __DIR__ . '/includes/layout_end_auth.php'; ?>
