<?php

namespace App\Repositories;

use App\Models\ProgrammeModel;

class ProgrammeRepository extends BaseRepository
{
    private function normalizeFilterValue(string $value): string
    {
        $normalized = mb_strtolower(trim($value));
        $normalized = str_replace('-', ' ', $normalized);
        $normalized = preg_replace('/\s+/', ' ', $normalized);

        return match ($normalized) {
            'bien etre' => 'bienetre',
            default => $normalized,
        };
    }

    public function getAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM programme");
        $stmt->execute();

        return $this->toObjects($stmt->fetchAll(), ProgrammeModel::class);
    }

    public function getFiltered(?string $objectif = null, ?string $niveau = null): array
    {
        $objectif = $this->normalizeFilterValue((string) $objectif);
        $niveau = $this->normalizeFilterValue((string) $niveau);

        $conditions = [];
        $params = [];

        if ($objectif !== '') {
            $conditions[] = 'objectif = :objectif';
            $params['objectif'] = $objectif;
        }

        if ($niveau !== '') {
            $conditions[] = 'niveau = :niveau';
            $params['niveau'] = $niveau;
        }

        $sql = "SELECT * FROM programme";
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $this->toObjects($stmt->fetchAll(), ProgrammeModel::class);
    }

    public function findById(int $id): ?ProgrammeModel
    {
        $stmt = $this->db->prepare("SELECT * FROM programme WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);

        return $this->toObject($stmt->fetch() ?: null, ProgrammeModel::class);
    }

    public function create(string $title, string $description, string $niveau, string $objectif, array $details = []): string
    {
        $stmt = $this->db->prepare("
            INSERT INTO programme (
                title, description, niveau, objectif,
                duree_semaines, seances_par_semaine, duree_seance_minutes,
                materiel, structure_plan, conseils, benefices
            )
            VALUES (
                :title, :description, :niveau, :objectif,
                :duree_semaines, :seances_par_semaine, :duree_seance_minutes,
                :materiel, :structure_plan, :conseils, :benefices
            )
        ");
        $stmt->execute([
            'title'                => $title,
            'description'          => $description,
            'niveau'               => $niveau,
            'objectif'             => $objectif,
            'duree_semaines'       => $details['duree_semaines'] ?? null,
            'seances_par_semaine'  => $details['seances_par_semaine'] ?? null,
            'duree_seance_minutes' => $details['duree_seance_minutes'] ?? null,
            'materiel'             => $details['materiel'] ?? null,
            'structure_plan'       => $details['structure_plan'] ?? null,
            'conseils'             => $details['conseils'] ?? null,
            'benefices'            => $details['benefices'] ?? null,
        ]);

        return $this->db->lastInsertId();
    }

    public function update(int $id, string $title, string $description, string $niveau, string $objectif, array $details = []): void
    {
        $stmt = $this->db->prepare("
            UPDATE programme
            SET title                = :title,
                description          = :description,
                niveau               = :niveau,
                objectif             = :objectif,
                duree_semaines       = :duree_semaines,
                seances_par_semaine  = :seances_par_semaine,
                duree_seance_minutes = :duree_seance_minutes,
                materiel             = :materiel,
                structure_plan       = :structure_plan,
                conseils             = :conseils,
                benefices            = :benefices
            WHERE id = :id
        ");
        $stmt->execute([
            'id'                   => $id,
            'title'                => $title,
            'description'          => $description,
            'niveau'               => $niveau,
            'objectif'             => $objectif,
            'duree_semaines'       => $details['duree_semaines'] ?? null,
            'seances_par_semaine'  => $details['seances_par_semaine'] ?? null,
            'duree_seance_minutes' => $details['duree_seance_minutes'] ?? null,
            'materiel'             => $details['materiel'] ?? null,
            'structure_plan'       => $details['structure_plan'] ?? null,
            'conseils'             => $details['conseils'] ?? null,
            'benefices'            => $details['benefices'] ?? null,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM programme WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
