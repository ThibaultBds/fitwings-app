<?php

namespace App\Models;

class ProgrammeModel extends BaseModel
{
    public ?int $id = null;
    public string $title = '';
    public string $description = '';
    public string $niveau = '';
    public string $objectif = '';
    public ?int $duree_semaines = null;
    public ?string $seances_par_semaine = null;
    public ?int $duree_seance_minutes = null;
    public ?string $materiel = null;
    public ?string $structure_plan = null;
    public ?string $conseils = null;
    public ?string $benefices = null;
}
