-- ExpertiseHS - Schéma MySQL
-- Plateforme Expertise Humanitaire et Sociale
-- Clés primaires UUID, compatible MySQL 5.7+ / 8+

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- =============================================================================
-- ENTITÉS ORGANISATIONNELLES
-- =============================================================================

CREATE TABLE organizations (
    id CHAR(36) NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    legal_name VARCHAR(255),
    acronym VARCHAR(50),
    description TEXT,
    address TEXT,
    city VARCHAR(100),
    postal_code VARCHAR(20),
    country_code VARCHAR(3),
    phone VARCHAR(50),
    email VARCHAR(255),
    website VARCHAR(255),
    registration_number VARCHAR(100),
    is_non_profit TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE structures (
    id CHAR(36) NOT NULL PRIMARY KEY,
    organization_id CHAR(36) NOT NULL,
    parent_structure_id CHAR(36),
    name VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL,
    description TEXT,
    address TEXT,
    city VARCHAR(100),
    country_code VARCHAR(3),
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (organization_id) REFERENCES organizations(id) ON DELETE CASCADE,
    FOREIGN KEY (parent_structure_id) REFERENCES structures(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE departments (
    id CHAR(36) NOT NULL PRIMARY KEY,
    organization_id CHAR(36) NOT NULL,
    structure_id CHAR(36),
    parent_department_id CHAR(36),
    name VARCHAR(255) NOT NULL,
    type VARCHAR(50),
    description TEXT,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (organization_id) REFERENCES organizations(id) ON DELETE CASCADE,
    FOREIGN KEY (structure_id) REFERENCES structures(id) ON DELETE SET NULL,
    FOREIGN KEY (parent_department_id) REFERENCES departments(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE institutional_partners (
    id CHAR(36) NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(100),
    description TEXT,
    contact_person VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(50),
    address TEXT,
    country_code VARCHAR(3),
    website VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- ZONES D'INTERVENTION
-- =============================================================================

CREATE TABLE countries (
    id CHAR(36) NOT NULL PRIMARY KEY,
    code VARCHAR(3) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    region VARCHAR(100),
    is_active TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE regions (
    id CHAR(36) NOT NULL PRIMARY KEY,
    country_id CHAR(36) NOT NULL,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(50),
    is_active TINYINT(1) DEFAULT 1,
    FOREIGN KEY (country_id) REFERENCES countries(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE cities (
    id CHAR(36) NOT NULL PRIMARY KEY,
    region_id CHAR(36),
    country_id CHAR(36) NOT NULL,
    name VARCHAR(255) NOT NULL,
    latitude DECIMAL(10, 7),
    longitude DECIMAL(10, 7),
    is_active TINYINT(1) DEFAULT 1,
    FOREIGN KEY (region_id) REFERENCES regions(id) ON DELETE SET NULL,
    FOREIGN KEY (country_id) REFERENCES countries(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE priority_zones (
    id CHAR(36) NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    country_id CHAR(36),
    region_id CHAR(36),
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (country_id) REFERENCES countries(id) ON DELETE SET NULL,
    FOREIGN KEY (region_id) REFERENCES regions(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- PROJETS D'EXPERTISE
-- =============================================================================

CREATE TABLE expertise_domains (
    id CHAR(36) NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    parent_domain_id CHAR(36),
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_domain_id) REFERENCES expertise_domains(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE projects (
    id CHAR(36) NOT NULL PRIMARY KEY,
    organization_id CHAR(36) NOT NULL,
    expertise_domain_id CHAR(36),
    name VARCHAR(255) NOT NULL,
    code VARCHAR(50) UNIQUE,
    description TEXT,
    objectives TEXT,
    status VARCHAR(50) NOT NULL DEFAULT 'draft',
    start_date DATE,
    end_date DATE,
    beneficiary_count INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (organization_id) REFERENCES organizations(id) ON DELETE CASCADE,
    FOREIGN KEY (expertise_domain_id) REFERENCES expertise_domains(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE project_zones (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    priority_zone_id CHAR(36),
    country_id CHAR(36),
    region_id CHAR(36),
    city_id CHAR(36),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (priority_zone_id) REFERENCES priority_zones(id) ON DELETE CASCADE,
    FOREIGN KEY (country_id) REFERENCES countries(id) ON DELETE CASCADE,
    FOREIGN KEY (region_id) REFERENCES regions(id) ON DELETE CASCADE,
    FOREIGN KEY (city_id) REFERENCES cities(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE project_phases (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    sequence_order INT NOT NULL DEFAULT 1,
    start_date DATE,
    end_date DATE,
    status VARCHAR(50) DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE deliverables (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    phase_id CHAR(36),
    name VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(100),
    due_date DATE,
    delivery_date DATE,
    status VARCHAR(50) DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (phase_id) REFERENCES project_phases(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- RESSOURCES HUMAINES
-- =============================================================================

CREATE TABLE skills (
    id CHAR(36) NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    category VARCHAR(100),
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE employees (
    id CHAR(36) NOT NULL PRIMARY KEY,
    organization_id CHAR(36) NOT NULL,
    department_id CHAR(36),
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    job_title VARCHAR(255),
    hire_date DATE,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (organization_id) REFERENCES organizations(id) ON DELETE CASCADE,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE experts (
    id CHAR(36) NOT NULL PRIMARY KEY,
    employee_id CHAR(36),
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255),
    phone VARCHAR(50),
    type VARCHAR(50) NOT NULL,
    bio TEXT,
    nationality VARCHAR(3),
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE expert_skills (
    id CHAR(36) NOT NULL PRIMARY KEY,
    expert_id CHAR(36) NOT NULL,
    skill_id CHAR(36) NOT NULL,
    level VARCHAR(50),
    UNIQUE KEY (expert_id, skill_id),
    FOREIGN KEY (expert_id) REFERENCES experts(id) ON DELETE CASCADE,
    FOREIGN KEY (skill_id) REFERENCES skills(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE project_roles (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    expert_id CHAR(36) NOT NULL,
    role VARCHAR(100) NOT NULL,
    start_date DATE,
    end_date DATE,
    allocation_percentage INT,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (expert_id) REFERENCES experts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- FINANCEMENT ET BUDGET
-- =============================================================================

CREATE TABLE donors (
    id CHAR(36) NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(100),
    contact_person VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(50),
    address TEXT,
    country_code VARCHAR(3),
    website VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE funding_contracts (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    donor_id CHAR(36) NOT NULL,
    reference VARCHAR(100),
    title VARCHAR(255),
    amount DECIMAL(15, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'EUR',
    start_date DATE,
    end_date DATE,
    status VARCHAR(50) DEFAULT 'active',
    signed_date DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (donor_id) REFERENCES donors(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE project_budgets (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    funding_contract_id CHAR(36),
    name VARCHAR(255) NOT NULL,
    fiscal_year INT,
    total_amount DECIMAL(15, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'EUR',
    status VARCHAR(50) DEFAULT 'draft',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (funding_contract_id) REFERENCES funding_contracts(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE budget_lines (
    id CHAR(36) NOT NULL PRIMARY KEY,
    budget_id CHAR(36) NOT NULL,
    parent_line_id CHAR(36),
    name VARCHAR(255) NOT NULL,
    code VARCHAR(50),
    category VARCHAR(100),
    planned_amount DECIMAL(15, 2) NOT NULL,
    committed_amount DECIMAL(15, 2) DEFAULT 0,
    spent_amount DECIMAL(15, 2) DEFAULT 0,
    sequence_order INT DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (budget_id) REFERENCES project_budgets(id) ON DELETE CASCADE,
    FOREIGN KEY (parent_line_id) REFERENCES budget_lines(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- PARTIES PRENANTES
-- =============================================================================

CREATE TABLE target_communities (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    estimated_size INT,
    location_description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE beneficiaries (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    target_community_id CHAR(36),
    type VARCHAR(50),
    name VARCHAR(255) NOT NULL,
    description TEXT,
    contact_info TEXT,
    country_id CHAR(36),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (target_community_id) REFERENCES target_communities(id) ON DELETE SET NULL,
    FOREIGN KEY (country_id) REFERENCES countries(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE local_contacts (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    role VARCHAR(255),
    organization VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(50),
    country_id CHAR(36),
    city_id CHAR(36),
    notes TEXT,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (country_id) REFERENCES countries(id) ON DELETE SET NULL,
    FOREIGN KEY (city_id) REFERENCES cities(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE local_partner_institutions (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    institutional_partner_id CHAR(36),
    role VARCHAR(255),
    responsibilities TEXT,
    contact_person VARCHAR(255),
    start_date DATE,
    end_date DATE,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (institutional_partner_id) REFERENCES institutional_partners(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- MISSIONS D'EXPERTISE
-- =============================================================================

CREATE TABLE expertise_missions (
    id CHAR(36) NOT NULL PRIMARY KEY,
    commissioning_organization_id CHAR(36) NOT NULL,
    expertise_domain_id CHAR(36),
    code VARCHAR(50),
    title VARCHAR(255) NOT NULL,
    description TEXT,
    objectives TEXT,
    external_project_reference VARCHAR(255),
    mission_type VARCHAR(50) NOT NULL,
    destination_country_id CHAR(36),
    destination_region_id CHAR(36),
    destination_city_id CHAR(36),
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status VARCHAR(50) DEFAULT 'planned',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (commissioning_organization_id) REFERENCES institutional_partners(id) ON DELETE RESTRICT,
    FOREIGN KEY (expertise_domain_id) REFERENCES expertise_domains(id) ON DELETE SET NULL,
    FOREIGN KEY (destination_country_id) REFERENCES countries(id) ON DELETE SET NULL,
    FOREIGN KEY (destination_region_id) REFERENCES regions(id) ON DELETE SET NULL,
    FOREIGN KEY (destination_city_id) REFERENCES cities(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE mission_participants (
    id CHAR(36) NOT NULL PRIMARY KEY,
    mission_id CHAR(36) NOT NULL,
    expert_id CHAR(36) NOT NULL,
    role VARCHAR(100) NOT NULL,
    is_lead TINYINT(1) DEFAULT 0,
    start_date DATE,
    end_date DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY (mission_id, expert_id),
    FOREIGN KEY (mission_id) REFERENCES expertise_missions(id) ON DELETE CASCADE,
    FOREIGN KEY (expert_id) REFERENCES experts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE mission_activities (
    id CHAR(36) NOT NULL PRIMARY KEY,
    mission_id CHAR(36) NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    activity_date DATE NOT NULL,
    sequence_order INT DEFAULT 1,
    status VARCHAR(50) DEFAULT 'planned',
    location VARCHAR(255),
    participants_notes TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (mission_id) REFERENCES expertise_missions(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE mission_deliverables (
    id CHAR(36) NOT NULL PRIMARY KEY,
    mission_id CHAR(36) NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(100),
    due_date DATE,
    delivery_date DATE,
    status VARCHAR(50) DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (mission_id) REFERENCES expertise_missions(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- LOGISTIQUE
-- =============================================================================

CREATE TABLE flight_tickets (
    id CHAR(36) NOT NULL PRIMARY KEY,
    mission_id CHAR(36) NOT NULL,
    traveler_expert_id CHAR(36) NOT NULL,
    airline VARCHAR(100),
    flight_number VARCHAR(50),
    departure_airport VARCHAR(10),
    arrival_airport VARCHAR(10),
    departure_date DATETIME,
    arrival_date DATETIME,
    ticket_reference VARCHAR(100),
    amount DECIMAL(10, 2),
    currency VARCHAR(3) DEFAULT 'EUR',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (mission_id) REFERENCES expertise_missions(id) ON DELETE CASCADE,
    FOREIGN KEY (traveler_expert_id) REFERENCES experts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE accommodations (
    id CHAR(36) NOT NULL PRIMARY KEY,
    mission_id CHAR(36) NOT NULL,
    expert_id CHAR(36) NOT NULL,
    establishment_name VARCHAR(255),
    address TEXT,
    city_id CHAR(36),
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    amount DECIMAL(10, 2),
    currency VARCHAR(3) DEFAULT 'EUR',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (mission_id) REFERENCES expertise_missions(id) ON DELETE CASCADE,
    FOREIGN KEY (expert_id) REFERENCES experts(id) ON DELETE CASCADE,
    FOREIGN KEY (city_id) REFERENCES cities(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE equipment (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36),
    mission_id CHAR(36),
    name VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(100),
    serial_number VARCHAR(100),
    assigned_to_expert_id CHAR(36),
    purchase_date DATE,
    value DECIMAL(10, 2),
    currency VARCHAR(3) DEFAULT 'EUR',
    status VARCHAR(50) DEFAULT 'available',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE SET NULL,
    FOREIGN KEY (mission_id) REFERENCES expertise_missions(id) ON DELETE SET NULL,
    FOREIGN KEY (assigned_to_expert_id) REFERENCES experts(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- GOUVERNANCE
-- =============================================================================

CREATE TABLE steering_committees (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    mandate TEXT,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE steering_committee_members (
    id CHAR(36) NOT NULL PRIMARY KEY,
    steering_committee_id CHAR(36) NOT NULL,
    expert_id CHAR(36),
    external_name VARCHAR(255),
    role VARCHAR(100),
    organization VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (steering_committee_id) REFERENCES steering_committees(id) ON DELETE CASCADE,
    FOREIGN KEY (expert_id) REFERENCES experts(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE meetings (
    id CHAR(36) NOT NULL PRIMARY KEY,
    steering_committee_id CHAR(36),
    project_id CHAR(36),
    title VARCHAR(255) NOT NULL,
    type VARCHAR(50),
    scheduled_at DATETIME NOT NULL,
    location VARCHAR(255),
    is_remote TINYINT(1) DEFAULT 0,
    meeting_url TEXT,
    status VARCHAR(50) DEFAULT 'scheduled',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (steering_committee_id) REFERENCES steering_committees(id) ON DELETE CASCADE,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE decisions (
    id CHAR(36) NOT NULL PRIMARY KEY,
    meeting_id CHAR(36) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    decision_type VARCHAR(50),
    status VARCHAR(50) DEFAULT 'pending',
    due_date DATE,
    responsible_person VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (meeting_id) REFERENCES meetings(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE progress_points (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    meeting_id CHAR(36),
    title VARCHAR(255) NOT NULL,
    content TEXT,
    progress_percentage INT,
    status VARCHAR(50),
    reported_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    reported_by CHAR(36),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (meeting_id) REFERENCES meetings(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- IMPACT ET ÉVALUATION
-- =============================================================================

CREATE TABLE result_indicators (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(50),
    unit VARCHAR(50),
    target_value DECIMAL(15, 2),
    baseline_value DECIMAL(15, 2),
    data_source TEXT,
    frequency VARCHAR(50),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE indicator_measurements (
    id CHAR(36) NOT NULL PRIMARY KEY,
    indicator_id CHAR(36) NOT NULL,
    value DECIMAL(15, 2) NOT NULL,
    measurement_date DATE NOT NULL,
    notes TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (indicator_id) REFERENCES result_indicators(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE project_evaluations (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    title VARCHAR(255) NOT NULL,
    type VARCHAR(50),
    evaluation_date DATE,
    evaluator VARCHAR(255),
    methodology TEXT,
    summary TEXT,
    rating VARCHAR(50),
    status VARCHAR(50) DEFAULT 'draft',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE testimonials (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author_name VARCHAR(255),
    author_role VARCHAR(255),
    author_organization VARCHAR(255),
    type VARCHAR(50),
    publication_date DATE,
    is_featured TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE impact_reports (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36) NOT NULL,
    title VARCHAR(255) NOT NULL,
    report_type VARCHAR(50),
    report_period_start DATE,
    report_period_end DATE,
    summary TEXT,
    status VARCHAR(50) DEFAULT 'draft',
    published_date DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- GESTION DES CONNAISSANCES
-- =============================================================================

CREATE TABLE documentary_resources (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36),
    title VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(50),
    file_path VARCHAR(500),
    file_url TEXT,
    language VARCHAR(10),
    publication_date DATE,
    author VARCHAR(255),
    is_public TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE best_practices (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36),
    expertise_domain_id CHAR(36),
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    context TEXT,
    application_area VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE SET NULL,
    FOREIGN KEY (expertise_domain_id) REFERENCES expertise_domains(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE lessons_learned (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36),
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(100),
    impact_level VARCHAR(50),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE model_library (
    id CHAR(36) NOT NULL PRIMARY KEY,
    expertise_domain_id CHAR(36),
    name VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(100),
    file_path VARCHAR(500),
    file_url TEXT,
    version VARCHAR(50),
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (expertise_domain_id) REFERENCES expertise_domains(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- COMMUNICATION
-- =============================================================================

CREATE TABLE news (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36),
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    excerpt TEXT,
    type VARCHAR(50),
    event_date DATE,
    event_location VARCHAR(255),
    is_published TINYINT(1) DEFAULT 0,
    published_at DATETIME,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE publications (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36),
    title VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(100),
    publisher VARCHAR(255),
    publication_date DATE,
    isbn VARCHAR(20),
    url TEXT,
    is_public TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE media (
    id CHAR(36) NOT NULL PRIMARY KEY,
    project_id CHAR(36),
    news_id CHAR(36),
    title VARCHAR(255),
    type VARCHAR(50),
    file_path VARCHAR(500),
    file_url TEXT,
    caption TEXT,
    alt_text VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE SET NULL,
    FOREIGN KEY (news_id) REFERENCES news(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE newsletters (
    id CHAR(36) NOT NULL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    subject VARCHAR(500),
    content TEXT,
    sent_at DATETIME,
    recipient_count INT,
    status VARCHAR(50) DEFAULT 'draft',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- ADMINISTRATION
-- =============================================================================

CREATE TABLE access_profiles (
    id CHAR(36) NOT NULL PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    permissions JSON,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE users (
    id CHAR(36) NOT NULL PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255),
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    employee_id CHAR(36),
    access_profile_id CHAR(36),
    is_active TINYINT(1) DEFAULT 1,
    last_login_at DATETIME,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE SET NULL,
    FOREIGN KEY (access_profile_id) REFERENCES access_profiles(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE progress_points
    ADD CONSTRAINT fk_progress_points_reported_by
    FOREIGN KEY (reported_by) REFERENCES users(id) ON DELETE SET NULL;

CREATE TABLE activity_log (
    id CHAR(36) NOT NULL PRIMARY KEY,
    user_id CHAR(36),
    action VARCHAR(100) NOT NULL,
    entity_type VARCHAR(100),
    entity_id CHAR(36),
    details JSON,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE configurations (
    id CHAR(36) NOT NULL PRIMARY KEY,
    `key` VARCHAR(255) NOT NULL UNIQUE,
    value TEXT,
    type VARCHAR(50),
    description TEXT,
    is_public TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- INDEX
-- =============================================================================

CREATE INDEX idx_projects_organization ON projects(organization_id);
CREATE INDEX idx_projects_status ON projects(status);
CREATE INDEX idx_projects_dates ON projects(start_date, end_date);
CREATE INDEX idx_project_roles_project ON project_roles(project_id);
CREATE INDEX idx_project_roles_expert ON project_roles(expert_id);
CREATE INDEX idx_funding_contracts_project ON funding_contracts(project_id);
CREATE INDEX idx_funding_contracts_donor ON funding_contracts(donor_id);
CREATE INDEX idx_expertise_missions_commissioner ON expertise_missions(commissioning_organization_id);
CREATE INDEX idx_expertise_missions_status ON expertise_missions(status);
CREATE INDEX idx_expertise_missions_dates ON expertise_missions(start_date, end_date);
CREATE INDEX idx_mission_participants_mission ON mission_participants(mission_id);
CREATE INDEX idx_mission_participants_expert ON mission_participants(expert_id);
CREATE INDEX idx_mission_activities_mission ON mission_activities(mission_id);
CREATE INDEX idx_mission_deliverables_mission ON mission_deliverables(mission_id);
CREATE INDEX idx_meetings_committee ON meetings(steering_committee_id);
CREATE INDEX idx_meetings_project ON meetings(project_id);
CREATE INDEX idx_activity_log_user ON activity_log(user_id);
CREATE INDEX idx_activity_log_created ON activity_log(created_at);
CREATE INDEX idx_activity_log_entity ON activity_log(entity_type, entity_id);
CREATE INDEX idx_users_email ON users(email);

SET FOREIGN_KEY_CHECKS = 1;
