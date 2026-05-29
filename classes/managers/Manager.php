<?php

class Manager
{
    private PDO $pdo;

    private TourOperatorRepository $tourOperatorRepo;
    private DestinationRepository  $destinationRepo;
    private ReviewRepository       $reviewRepo;
    private ScoreRepository        $scoreRepo;
    private AuthorRepository       $authorRepo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;

        $this->tourOperatorRepo = new TourOperatorRepository($pdo);
        $this->destinationRepo  = new DestinationRepository($pdo);
        $this->reviewRepo       = new ReviewRepository($pdo);
        $this->scoreRepo        = new ScoreRepository($pdo);
        $this->authorRepo       = new AuthorRepository($pdo);
    }

    // -------------------------------------------------------------------------
    // Destinations
    // -------------------------------------------------------------------------

    public function getAllDestinations(): array
    {
        return $this->destinationRepo->findAll();
    }

    public function getMainDestinations(): array
    {
        return $this->destinationRepo->findAllMainDestination();
    }

    public function createDestination(string $location, string $country, int $price, string $image, int $tourOperatorId): bool
    {
        return $this->destinationRepo->create($location, $country, $price, $image, $tourOperatorId);
    }

    public function updateDestination(int $id, string $location, string $country, int $price, int $tourOperatorId): bool
    {
        return $this->destinationRepo->update($id, $location, $country, $price, $tourOperatorId);
    }

    // -------------------------------------------------------------------------
    // Tour Operators
    // -------------------------------------------------------------------------

    public function getAllOperators(): array
    {
        $operators = $this->tourOperatorRepo->findAll();

        foreach ($operators as $operator) {
            $operator->setScores($this->scoreRepo->findByTourOperator($operator->getId()));
            $operator->setReviews($this->reviewRepo->findByTourOperator($operator->getId()));
            $operator->setDestinations($this->destinationRepo->findByTourOperator($operator->getId()));
        }

        return $operators;
    }

    public function getOperatorsByLocation(string $location): array
    {
        $operators = $this->tourOperatorRepo->findByLocation($location);

        foreach ($operators as $operator) {
            $operator->setScores($this->scoreRepo->findByTourOperator($operator->getId()));
            $operator->setReviews($this->reviewRepo->findByTourOperator($operator->getId()));
        }

        return $operators;
    }

    public function createTourOperator(string $name, string $link, bool $isPremium = false): bool
    {
        $tourOperator = new TourOperator([
            'id'         => 0,
            'name'       => $name,
            'link'       => $link,
            'is_premium' => $isPremium,
        ]);
        return $this->tourOperatorRepo->create($tourOperator);
    }

    public function updateTourOperator(int $id, string $name, string $link, bool $isPremium): bool
    {
        return $this->tourOperatorRepo->update($id, $name, $link, $isPremium);
    }

    // -------------------------------------------------------------------------
    // Reviews
    // -------------------------------------------------------------------------

    public function createReview(string $message, int $tourOperatorId, string $authorName): bool
    {
        $author = $this->authorRepo->findOrCreateByName($authorName);
        return $this->reviewRepo->create($message, $tourOperatorId, $author->getId());
    }

    public function getReviewsByOperator(int $tourOperatorId): array
    {
        return $this->reviewRepo->findByTourOperator($tourOperatorId);
    }

    // -------------------------------------------------------------------------
    // Scores
    // -------------------------------------------------------------------------

    public function getAverageScoreByOperator(int $tourOperatorId): ?float
    {
        return $this->scoreRepo->getAverageByTourOperator($tourOperatorId);
    }
}
