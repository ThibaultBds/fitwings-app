<?php

namespace App\Models;

class ProgressionModel extends BaseModel
{
    public ?int $id = null;
    public int $user_id = 0;
    public float $poids = 0.0;
    public float $tour_taille = 0.0;
    public int $nombre_seances = 0;
    public ?string $date_suivi = null;
}
