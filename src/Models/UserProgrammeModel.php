<?php

namespace App\Models;

class UserProgrammeModel extends BaseModel
{
    public ?int $id = null;
    public int $user_id = 0;
    public int $programme_id = 0;
    public string $statut = 'en_cours';
    public ?string $created_at = null;
}
