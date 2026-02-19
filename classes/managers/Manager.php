<?php

class Manager
{
    private PDO $pdo;

    private TourOperatorRepository $tourOperatorRepo;
    private DestinationRepository  $destinationRepo;
    private ReviewRepository       $reviewRepo;
    private ScoreRepository        $scoreRepo;
    private CertificateRepository  $certificateRepo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;

        $this->tourOperatorRepo = new TourOperatorRepository($pdo);
        $this->destinationRepo  = new DestinationRepository($pdo);
        $this->reviewRepo       = new ReviewRepository($pdo);
        $this->scoreRepo        = new ScoreRepository($pdo);
        $this->certificateRepo  = new CertificateRepository($pdo);
    }

    // -------------------------------------------------------------------------
    // Destinations
    // -------------------------------------------------------------------------

    public function getAllDestination(): array
    {
        return $this->destinationRepo->findAll();
    }

    public function getOperatorByDestination(int $destinationId): ?TourOperator
    {
        return $this->tourOperatorRepo->findByDestination($destinationId);
    }

    public function createDestination(string $location, int $price, int $tourOperatorId): bool
    {
        $destination = new Destination([
            'id'               => 0,
            'location'         => $location,
            'price'            => $price,
            'tour_operator_id' => $tourOperatorId,
        ]);
        return $this->destinationRepo->create($destination);
    }

    // -------------------------------------------------------------------------
    // Reviews
    // -------------------------------------------------------------------------

    public function createReview(string $message, int $tourOperatorId, int $authorId): bool
    {
        $review = new Review([
            'id'               => 0,
            'message'          => $message,
            'tour_operator_id' => $tourOperatorId,
            'author_id'        => $authorId,
        ]);
        return $this->reviewRepo->create($review);
    }

    public function getReviewByOperatorId(int $tourOperatorId): array
    {
        return $this->reviewRepo->findByTourOperator($tourOperatorId);
    }

    // -------------------------------------------------------------------------
    // Tour Operators
    // -------------------------------------------------------------------------

    public function getAllOperator(): array
    {
        $operators = $this->tourOperatorRepo->findAll();

        foreach ($operators as $operator) {
            $operator->setDestinations($this->destinationRepo->findByTourOperator($operator->getId()));
            $operator->setReviews($this->reviewRepo->findByTourOperator($operator->getId()));
            $operator->setScores($this->scoreRepo->findByTourOperator($operator->getId()));
            $operator->setCertificate($this->certificateRepo->findByTourOperator($operator->getId()));
        }

        return $operators;
    }

    public function updateOperatorToPremium(int $tourOperatorId, string $signatory, string $expiresAt): bool
    {
        // Remove existing certificate if any
        $this->certificateRepo->delete($tourOperatorId);

        $certificate = new Certificate([
            'tour_operator_id' => $tourOperatorId,
            'expires_at'       => $expiresAt,
            'signatory'        => $signatory,
        ]);

        return $this->certificateRepo->create($certificate);
    }

    public function createTourOperator(string $name, string $link): bool
    {
        $tourOperator = new TourOperator([
            'id'   => 0,
            'name' => $name,
            'link' => $link,
        ]);
        return $this->tourOperatorRepo->create($tourOperator);
    }
}