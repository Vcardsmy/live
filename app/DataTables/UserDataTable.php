<?php

namespace App\DataTables;

use App\Models\User;

/**
 * Class UserDataTable
 */
class UserDataTable
{
    /**
     * @return User
     */
    public function get()
    {
        /** @var User $query */
        $query = User::query()->where('id', '!=', getLogInUserId())->select('users.*');
        
        return $query;
    }
}
