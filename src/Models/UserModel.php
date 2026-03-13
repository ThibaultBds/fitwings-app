<?php

namespace App\Models;

class UserModel extends BaseModel
{
    public ?int $id = null;
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $role = 'user';
    public ?string $plan = null;
    public ?string $created_at = null;
}
