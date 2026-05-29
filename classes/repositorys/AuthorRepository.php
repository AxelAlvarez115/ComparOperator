<?php

class AuthorRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function findAll(): array {
        $stmt = $this->db->query('SELECT * FROM author');
        return array_map(fn($row) => new Author($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function findById(int $id): ?Author {
        $stmt = $this->db->prepare('SELECT * FROM author WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new Author($data) : null;
    }

    public function findByName(string $name): ?Author {
        $stmt = $this->db->prepare('SELECT * FROM author WHERE name = ?');
        $stmt->execute([$name]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new Author($data) : null;
    }

    public function findOrCreateByName(string $name): Author {
        $existing = $this->findByName($name);
        if ($existing) {
            return $existing;
        }
        $stmt = $this->db->prepare('INSERT INTO author (name) VALUES (?)');
        $stmt->execute([$name]);
        $id = (int) $this->db->lastInsertId();
        return new Author(['id' => $id, 'name' => $name]);
    }
}
