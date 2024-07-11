<?php
namespace App\Enums;

enum PermissionsEnums : string
{
    case ALLUSERS = "all-users";
    case CREATEUSER = "create-user";
    case UPDATEUSER = "update-user";
    case SHOWUSER = "show-user";
    case DELETEUSER = "delete-user";
}