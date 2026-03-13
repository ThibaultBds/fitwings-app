<?php

namespace App\Models;

class ReservationModel extends BaseModel
{
    public ?int $id = null;
    public string $nom = '';
    public string $email = '';
    public string $cours = '';
    public string $message = '';
    public ?string $created_at = null;
}
