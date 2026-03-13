<?php

namespace App\Models;

class CandidatureModel extends BaseModel
{
    public ?int $id = null;
    public string $nom = '';
    public string $email = '';
    public string $telephone = '';
    public string $poste = '';
    public string $message = '';
    public ?string $created_at = null;
}
