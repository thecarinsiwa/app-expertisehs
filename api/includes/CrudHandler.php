<?php
/**
 * Generic CRUD handler for MySQL tables (UUID primary key)
 */
class CrudHandler
{
    private PDO $pdo;
    private string $table;
    private array $allowedTables = [
        'organizations', 'structures', 'departments', 'institutional_partners',
        'countries', 'regions', 'cities', 'priority_zones', 'expertise_domains',
        'projects', 'project_zones', 'project_phases', 'deliverables', 'skills',
        'employees', 'experts', 'expert_skills', 'project_roles', 'donors',
        'funding_contracts', 'project_budgets', 'budget_lines', 'target_communities',
        'beneficiaries', 'local_contacts', 'local_partner_institutions',
        'expertise_missions', 'mission_participants', 'mission_activities',
        'mission_deliverables', 'flight_tickets', 'accommodations', 'equipment',
        'steering_committees', 'steering_committee_members', 'meetings', 'decisions',
        'progress_points', 'result_indicators', 'indicator_measurements',
        'project_evaluations', 'testimonials', 'impact_reports', 'documentary_resources',
        'best_practices', 'lessons_learned', 'model_library', 'news', 'publications',
        'media', 'newsletters', 'access_profiles', 'users', 'activity_log', 'configurations',
    ];

    public function __construct(PDO $pdo, string $table)
    {
        $this->pdo = $pdo;
        $table = strtolower(trim($table));
        if (!in_array($table, $this->allowedTables, true)) {
            throw new InvalidArgumentException("Table not allowed: $table");
        }
        $this->table = $table;
    }

    private function quoteIdentifier(string $name): string
    {
        return '`' . str_replace('`', '``', $name) . '`';
    }

    private function getColumns(): array
    {
        $db = $this->pdo->query('SELECT DATABASE()')->fetchColumn();
        $stmt = $this->pdo->prepare(
            "SELECT COLUMN_NAME FROM information_schema.COLUMNS 
             WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? 
             ORDER BY ORDINAL_POSITION"
        );
        $stmt->execute([$db, $this->table]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    private function getWritableColumns(): array
    {
        $columns = $this->getColumns();
        $skip = ['id', 'created_at'];
        return array_values(array_filter($columns, fn($c) => !in_array($c, $skip, true)));
    }

    /** Expose writable column names for admin forms (same as getWritableColumns). */
    public function getEditableColumnNames(): array
    {
        return $this->getWritableColumns();
    }

    /** Expose all column names (for building table header when no rows). */
    public function getColumnNames(): array
    {
        return $this->getColumns();
    }

    private static function uuid(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public function count(): int
    {
        $t = $this->quoteIdentifier($this->table);
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM $t");
        return (int) $stmt->fetchColumn();
    }

    public function list(int $limit = 100, int $offset = 0): array
    {
        $limit = max(1, min(500, (int) $limit));
        $offset = max(0, (int) $offset);
        $columns = $this->getColumns();
        $cols = implode(', ', array_map([$this, 'quoteIdentifier'], $columns));
        $t = $this->quoteIdentifier($this->table);
        $orderCol = in_array('created_at', $columns, true) ? 'created_at DESC, id' : 'id';
        // LIMIT/OFFSET en entiers : MySQL n'accepte pas les paramètres liés (chaînes) ici
        $sql = "SELECT $cols FROM $t ORDER BY $orderCol LIMIT $limit OFFSET $offset";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get(string $id): ?array
    {
        $columns = $this->getColumns();
        $cols = implode(', ', array_map([$this, 'quoteIdentifier'], $columns));
        $t = $this->quoteIdentifier($this->table);
        $stmt = $this->pdo->prepare("SELECT $cols FROM $t WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function create(array $data): array
    {
        $writable = $this->getWritableColumns();
        $data = array_intersect_key($data, array_flip($writable));
        if (empty($data)) {
            throw new InvalidArgumentException('No valid fields to insert');
        }
        if (!isset($data['id'])) {
            $data['id'] = self::uuid();
        }
        if (in_array('updated_at', $this->getColumns(), true)) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }
        $columns = array_keys($data);
        $placeholders = array_map(fn($c) => ':' . $c, $columns);
        $cols = implode(', ', array_map([$this, 'quoteIdentifier'], $columns));
        $t = $this->quoteIdentifier($this->table);
        $sql = "INSERT INTO $t ($cols) VALUES (" . implode(', ', $placeholders) . ")";
        $this->pdo->prepare($sql)->execute($data);
        return $this->get($data['id']);
    }

    public function update(string $id, array $data): ?array
    {
        $existing = $this->get($id);
        if (!$existing) {
            return null;
        }
        $writable = $this->getWritableColumns();
        $data = array_intersect_key($data, array_flip($writable));
        if (empty($data)) {
            return $existing;
        }
        if (in_array('updated_at', $this->getColumns(), true)) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }
        $sets = [];
        foreach (array_keys($data) as $col) {
            $sets[] = $this->quoteIdentifier($col) . ' = :' . $col;
        }
        $t = $this->quoteIdentifier($this->table);
        $sql = "UPDATE $t SET " . implode(', ', $sets) . " WHERE id = :id";
        $data['id'] = $id;
        $this->pdo->prepare($sql)->execute($data);
        return $this->get($id);
    }

    public function delete(string $id): bool
    {
        $t = $this->quoteIdentifier($this->table);
        $stmt = $this->pdo->prepare("DELETE FROM $t WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}
