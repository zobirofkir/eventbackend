<?php
namespace App\Enums;

enum RolesEnums : string
{
    case ADMIN = "admin";
    case CLIENT = "client";

    public function label(): string
    {
        return match ($this)
        {
            static::ADMIN => "Admin",
            static::CLIENT => "Client"
        };
    }
}