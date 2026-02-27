<?php 

    public function getByNiveau(string $niveau): array
{
    $stmt = $this->pdo->prepare(
        "SELECT * FROM programmes WHERE niveau = :niveau"
    );

    $stmt->execute([
        'niveau' => $niveau
    ]);

    return $stmt->fetchAll();
}