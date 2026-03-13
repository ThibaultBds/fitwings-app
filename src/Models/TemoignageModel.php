<?php

namespace App\Models;

class TemoignageModel extends BaseModel
{
    public ?int $id = null;
    public int $user_id = 0;
    public int $note = 0;
    public string $contenu = '';
    public string $statut = 'en_attente';
    public ?string $created_at = null;
    public ?string $username = null; // jointure users
}
