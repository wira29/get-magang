<?php 

namespace App\Helpers;

class UserHelper 
{
    /**
     * check role admin
     * 
     * @return bool
     */
    public static function checkRoleAdmin(): bool
    {
        return auth()->user()->role->role_name === "admin";
    }

    /**
     * check role siswa
     * 
     * @return bool
     */
    public static function checkRoleSiswa(): bool
    {
        return auth()->user()->role->role_name === "siswa";
    }
}