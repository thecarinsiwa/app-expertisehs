<?php
/**
 * Connexion - ExpertiseHS Admin
 * Appel API: POST /api/index.php/auth/login
 * Structure : même layout que l'admin (head, main, scripts), sans sidebar.
 */
if (!empty($_COOKIE['expertisehs_token'])) {
    header('Location: index.php');
    exit;
}
require __DIR__ . '/includes/env.php';
$api_base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
    . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost')
    . rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/') . '/api/index.php';

$page_title = 'Connexion';
$head_extra = '<meta name="api-base" content="' . htmlspecialchars($api_base_url) . '">';
require __DIR__ . '/includes/layout_start_auth.php';
?>
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-brand">
            <div class="auth-logo">Expertise Humanitaire et Sociale</div>
        </div>
        <h1 class="auth-title">Bon retour</h1>
        <p class="auth-subtitle">Bienvenue ! Veuillez entrer vos identifiants.</p>
        <div id="authAlert" class="alert alert-danger d-none" role="alert"></div>
        <form id="loginForm" action="#" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required autocomplete="email" placeholder="Entrez votre email">
            </div>
            <div class="mb-3">
                <div class="auth-row-label">
                    <label for="password" class="form-label">Mot de passe</label>
                    <a href="forgot-password.php" class="auth-forgot">Mot de passe oublié ?</a>
                </div>
                <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password" placeholder="Mot de passe">
            </div>
            <button type="submit" class="btn btn-login" id="submitBtn">
                <span class="btn-text">Se connecter</span>
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
            <div class="auth-divider">ou</div>
            <button type="button" class="btn btn-google" disabled title="Bientôt disponible">
                <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><path d="M17.64 9.2c0-.637-.057-1.251-.164-1.84H9v3.481h4.844c-.209 1.125-.843 2.078-1.796 2.717v2.258h2.908c1.702-1.567 2.684-3.874 2.684-6.615z" fill="#4285F4"/><path d="M9 18c2.43 0 4.467-.806 5.956-2.18L12.048 13.57c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332C2.438 15.983 5.482 18 9 18z" fill="#34A853"/><path d="M3.964 10.719c-.18-.54-.282-1.117-.282-1.719 0-.602.102-1.18.282-1.719V4.969H.957C.347 6.175 0 7.55 0 9s.348 2.825.957 4.031l3.007-2.312z" fill="#FBBC05"/><path d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0 5.482 0 2.438 2.017.957 4.969L3.964 7.28C4.672 5.163 6.656 3.58 9 3.58z" fill="#EA4335"/></svg>
                Se connecter avec Google
            </button>
        </form>
        <p class="auth-footer">Pas encore de compte ? <a href="register.php">Créer un compte</a></p>
    </div>
</div>
<script>
(function () {
    if (window.location.search.indexOf('logout') !== -1) {
        localStorage.removeItem('expertisehs_user');
        localStorage.removeItem('expertisehs_token');
        document.cookie = 'expertisehs_user=; path=/; max-age=0';
        window.history.replaceState({}, '', 'login.php');
    }
    var form = document.getElementById('loginForm');
    var alertEl = document.getElementById('authAlert');
    var submitBtn = document.getElementById('submitBtn');
    var apiBase = document.querySelector('meta[name="api-base"]').getAttribute('content');

    function showError(msg) {
        alertEl.textContent = msg;
        alertEl.classList.remove('d-none');
    }
    function hideError() {
        alertEl.classList.add('d-none');
    }
    function setLoading(loading) {
        submitBtn.querySelector('.btn-text').classList.toggle('d-none', loading);
        submitBtn.querySelector('.spinner-border').classList.toggle('d-none', !loading);
        submitBtn.disabled = loading;
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        hideError();
        setLoading(true);
        var payload = { email: document.getElementById('email').value.trim(), password: document.getElementById('password').value };

        fetch(apiBase + '/auth/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(function (r) {
            return r.json().then(function (data) {
                if (!r.ok) throw new Error(data.error || 'Erreur de connexion');
                return data;
            });
        })
        .then(function (data) {
            localStorage.setItem('expertisehs_user', JSON.stringify(data.user));
            localStorage.setItem('expertisehs_token', data.token);
            document.cookie = 'expertisehs_token=' + encodeURIComponent(data.token) + '; path=/; max-age=604800; SameSite=Lax';
            document.cookie = 'expertisehs_user=' + encodeURIComponent(JSON.stringify(data.user)) + '; path=/; max-age=604800; SameSite=Lax';
            window.location.href = 'index.php';
        })
        .catch(function (err) {
            showError(err.message || 'Erreur de connexion');
            setLoading(false);
        });
    });
})();
</script>
<?php require __DIR__ . '/includes/layout_end_auth.php'; ?>
