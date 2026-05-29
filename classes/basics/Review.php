<?php

class Review {
    private int $id;
    private string $message;
    private int $tour_operator_id;
    private int $author_id;
    private ?string $author_name;
    private ?int $grade;

    public function __construct(array $data) {
        $this->id               = $data['id'];
        $this->message          = $data['message'];
        $this->tour_operator_id = $data['tour_operator_id'];
        $this->author_id        = $data['author_id'];
        $this->author_name      = $data['author_name'] ?? null;
        $this->grade            = isset($data['grade']) ? (int) $data['grade'] : null;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getMessage(): string {
        return $this->message;
    }

    public function getContent(): string {
        return $this->message;
    }

    public function getTourOperatorId(): int {
        return $this->tour_operator_id;
    }

    public function getAuthorId(): int {
        return $this->author_id;
    }

    public function getUsername(): string {
        return $this->author_name ?? 'Anonymous';
    }

    public function getGrade(): ?int {
        return $this->grade;
    }
}
