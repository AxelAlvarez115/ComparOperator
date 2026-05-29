<?php

class TourOperator {
    private int $id;
    private string $name;
    private string $link;
    private bool $isPremium;
    private ?int $price;
    private array $destinations;
    private array $reviews;
    private array $scores;

    public function __construct(array $data) {
        $this->id          = $data['id'];
        $this->name        = $data['name'];
        $this->link        = $data['link'];
        $this->isPremium   = (bool) ($data['is_premium'] ?? $data['isPremium'] ?? false);
        $this->price       = isset($data['price']) ? (int) $data['price'] : null;
        $this->destinations = $data['destinations'] ?? [];
        $this->reviews     = $data['reviews'] ?? [];
        $this->scores      = $data['scores'] ?? [];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getLink(): string {
        return $this->link;
    }

    public function getIsPremium(): bool {
        return $this->isPremium;
    }

    public function getPrice(): ?int {
        return $this->price;
    }

    public function getDestinations(): array {
        return $this->destinations;
    }

    public function getReviews(): array {
        return $this->reviews;
    }

    public function getScores(): array {
        return $this->scores;
    }

    public function setDestinations(array $destinations): void {
        $this->destinations = $destinations;
    }

    public function setReviews(array $reviews): void {
        $this->reviews = $reviews;
    }

    public function setScores(array $scores): void {
        $this->scores = $scores;
    }

    public function getAverageScore(): ?float {
        if (empty($this->scores)) {
            return null;
        }
        $total = array_sum(array_map(fn($s) => $s->getValue(), $this->scores));
        return round($total / count($this->scores), 1);
    }

    public function getGradeTotal(): string {
        $avg = $this->getAverageScore();
        return $avg !== null ? (string) $avg : '-';
    }
}
