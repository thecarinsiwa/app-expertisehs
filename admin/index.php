<?php
/**
 * Tableau de bord - ExpertiseHS (Expertise Humanitaire et Sociale)
 */
require __DIR__ . '/includes/env.php';

$page_title = 'Tableau de bord';
$active_menu = 'dashboard';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

require __DIR__ . '/includes/layout_start.php';
?>

<header class="page-header">
    <h1 class="page-title">Tableau de bord</h1>
    <div class="d-flex flex-wrap align-items-center gap-2">
        <div class="input-group flex-nowrap" style="max-width: 220px;">
            <span class="input-group-text bg-white input-group-text-theme"><i class="bi bi-calendar3 text-muted"></i></span>
            <input type="text" class="form-control form-control-theme" value="<?php echo date('d/m/Y'); ?>" readonly aria-label="Date">
        </div>
        <a href="<?php echo $admin_base; ?>projects/projects_view.php" class="btn btn-outline-teal btn-sm"><i class="bi bi-briefcase me-1"></i> Voir les projets</a>
        <a href="<?php echo $admin_base; ?>missions/expertise_missions_view.php" class="btn btn-teal btn-sm"><i class="bi bi-airplane me-1"></i> Voir les missions</a>
        <?php require __DIR__ . '/includes/user_header_block.php'; ?>
    </div>
</header>

<section class="dashboard-welcome">
    <h2>Expertise Humanitaire et Sociale</h2>
    <p>Vue d'ensemble des projets d'expertise, des missions pour organisations externes (UNICEF, OIM, PAM…), du financement et de l'avancement.</p>
</section>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <a href="<?php echo $admin_base; ?>projects/projects_view.php" class="text-decoration-none">
            <div class="dashboard-metric-card">
                <div class="icon-wrap icon-teal"><i class="bi bi-briefcase"></i></div>
                <div class="metric-label">Projets d'expertise</div>
                <div class="metric-value">—</div>
                <div class="metric-sub">En cours / Total</div>
                <div class="metric-link text-primary">Gérer les projets <i class="bi bi-arrow-right ms-1"></i></div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-xl-3">
        <a href="<?php echo $admin_base; ?>missions/expertise_missions_view.php" class="text-decoration-none">
            <div class="dashboard-metric-card">
                <div class="icon-wrap icon-orange"><i class="bi bi-airplane"></i></div>
                <div class="metric-label">Missions d'expertise</div>
                <div class="metric-value">—</div>
                <div class="metric-sub">En cours / À venir</div>
                <div class="metric-link text-primary">Voir les missions <i class="bi bi-arrow-right ms-1"></i></div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-xl-3">
        <a href="<?php echo $admin_base; ?>hr/experts_view.php" class="text-decoration-none">
            <div class="dashboard-metric-card">
                <div class="icon-wrap icon-blue"><i class="bi bi-person-badge"></i></div>
                <div class="metric-label">Experts</div>
                <div class="metric-value">—</div>
                <div class="metric-sub">Internes et externes</div>
                <div class="metric-link text-primary">Ressources humaines <i class="bi bi-arrow-right ms-1"></i></div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-xl-3">
        <a href="<?php echo $admin_base; ?>funding/funding_contracts_view.php" class="text-decoration-none">
            <div class="dashboard-metric-card">
                <div class="icon-wrap icon-green"><i class="bi bi-currency-dollar"></i></div>
                <div class="metric-label">Financement</div>
                <div class="metric-value">—</div>
                <div class="metric-sub">Contrats / Budgets</div>
                <div class="metric-link text-primary">Financement et budget <i class="bi bi-arrow-right ms-1"></i></div>
            </div>
        </a>
    </div>
</div>

<section class="dashboard-quick-links">
    <h3 class="h6 text-muted text-uppercase mb-3" style="letter-spacing: 0.05em;">Accès rapide</h3>
    <div class="row g-2 g-md-3">
        <div class="col-6 col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <a href="<?php echo $admin_base; ?>projects/projects_view.php">
                        <span class="quick-icon"><i class="bi bi-briefcase"></i></span>
                        <span class="fw-medium">Projets</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <a href="<?php echo $admin_base; ?>missions/expertise_missions_view.php">
                        <span class="quick-icon"><i class="bi bi-airplane"></i></span>
                        <span class="fw-medium">Missions</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <a href="<?php echo $admin_base; ?>governance/steering_committees_view.php">
                        <span class="quick-icon"><i class="bi bi-diagram-3"></i></span>
                        <span class="fw-medium">Gouvernance</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <a href="<?php echo $admin_base; ?>impact/impact_reports_view.php">
                        <span class="quick-icon"><i class="bi bi-graph-up"></i></span>
                        <span class="fw-medium">Impact</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <a href="<?php echo $admin_base; ?>stakeholders/beneficiaries_view.php">
                        <span class="quick-icon"><i class="bi bi-people"></i></span>
                        <span class="fw-medium">Parties prenantes</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <a href="<?php echo $admin_base; ?>knowledge/documentary_resources_view.php">
                        <span class="quick-icon"><i class="bi bi-journal-bookmark"></i></span>
                        <span class="fw-medium">Connaissances</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-lg-6">
        <div class="dashboard-section-card">
            <div class="card-header">
                <span><i class="bi bi-briefcase me-2"></i>Projets d'expertise</span>
                <a href="<?php echo $admin_base; ?>projects/projects_view.php" class="btn btn-teal btn-sm">Voir tout</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Projet</th>
                            <th>Phase</th>
                            <th>État</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3" class="text-muted text-center py-4">Aucun projet pour le moment. <a href="<?php echo $admin_base; ?>projects/projects_view.php">Gérer les projets</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="dashboard-section-card">
            <div class="card-header">
                <span><i class="bi bi-airplane me-2"></i>Missions d'expertise</span>
                <a href="<?php echo $admin_base; ?>missions/expertise_missions_view.php" class="btn btn-teal btn-sm">Voir tout</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Mission</th>
                            <th>Organisation</th>
                            <th>État</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3" class="text-muted text-center py-4">Aucune mission pour le moment. <a href="<?php echo $admin_base; ?>missions/expertise_missions_view.php">Gérer les missions</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/includes/layout_end.php'; ?>
