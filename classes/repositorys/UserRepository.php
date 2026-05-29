<?php

class UserRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function findByUsername(string $username): ?User {
        $stmt = $this->db->prepare('SELECT * FROM `user` WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new User($data) : null;
    }

    public function findByEmail(string $email): ?User {
        $stmt = $this->db->prepare('SELECT * FROM `user` WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new User($data) : null;
    }

    public function findById(int $id): ?User {
        $stmt = $this->db->prepare('SELECT * FROM `user` WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new User($data) : null;
    }

    public function create(string $username, string $email, string $plainPassword, string $role = 'user'): bool {
        $hash = password_hash($plainPassword, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare(
            'INSERT INTO `user` (username, email, password, role) VALUES (?, ?, ?, ?)'
        );
        return $stmt->execute([$username, $email, $hash, $role]);
    }

    public function updatePassword(int $id, string $plainPassword): bool {
        $hash = password_hash($plainPassword, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare('UPDATE `user` SET password = ? WHERE id = ?');
        return $stmt->execute([$hash, $id]);
    }

    public function exists(string $username): bool {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM `user` WHERE username = ?');
        $stmt->execute([$username]);
        return (int) $stmt->fetchColumn() > 0;
    }
}
