<?php
/**
 * Scripts communs (Bootstrap + sidebar)
 * Utilisé par layout_end.php.
 */
?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
(function () {
    var sidebar = document.getElementById('sidebar');
    var overlay = document.getElementById('sidebarOverlay');
    var toggler = document.getElementById('sidebarToggler');
    function openSidebar() {
        sidebar.classList.add('show');
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    }
    if (toggler) toggler.addEventListener('click', function () {
        sidebar.classList.contains('show') ? closeSidebar() : openSidebar();
    });
    if (overlay) overlay.addEventListener('click', closeSidebar);
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) closeSidebar();
    });
})();

(function () {
    var STORAGE_KEY = 'expertisehs-theme';
    var lightRadio = document.getElementById('themeLight');
    var darkRadio = document.getElementById('themeDark');
    function getStored() { return localStorage.getItem(STORAGE_KEY) || 'light'; }
    function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme === 'dark' ? 'dark' : 'light');
        if (lightRadio) lightRadio.checked = (theme !== 'dark');
        if (darkRadio) darkRadio.checked = (theme === 'dark');
    }
    function setTheme(theme) {
        localStorage.setItem(STORAGE_KEY, theme);
        applyTheme(theme);
    }
    applyTheme(getStored());
    if (lightRadio) lightRadio.addEventListener('change', function () { if (this.checked) setTheme('light'); });
    if (darkRadio) darkRadio.addEventListener('change', function () { if (this.checked) setTheme('dark'); });
})();
</script>
<?php
if (!empty($page_scripts)) {
    echo $page_scripts;
}
?>
