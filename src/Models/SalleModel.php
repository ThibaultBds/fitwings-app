<?php

namespace App\Models;

class SalleModel extends BaseModel
{
    public ?int $id = null;
    public string $nom = '';
    public string $ville = '';
    public string $adresse = '';
    public string $code_postal = '';
    public string $telephone = '';
    public string $email = '';
    public string $horaires = '';
    public string $description = '';
}
