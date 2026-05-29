<?php

class User {
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $role;
    private string $createdAt;

    public function __construct(array $data) {
        $this->id        = (int) $data['id'];
        $this->username  = $data['username'];
        $this->email     = $data['email'];
        $this->password  = $data['password'];
        $this->role      = $data['role'];
        $this->createdAt = $data['created_at'] ?? '';
    }

    public function getId(): int      { return $this->id; }
    public function getUsername(): string { return $this->username; }
    public function getEmail(): string    { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getRole(): string     { return $this->role; }
    public function getCreatedAt(): string { return $this->createdAt; }

    public function isAdmin(): bool { return $this->role === 'admin'; }

    public function verifyPassword(string $plain): bool {
        return password_verify($plain, $this->password);
    }
}
