<?php

namespace App\Enums;

enum FormTypeEnum: string
{
    case USER_REGISTER = "user_register";
    case USER_UPDATE = "user_update";
    case ADMIN_REGISTER = "admin_register";
    case ADMIN_UPDATE = "admin_update";
}
