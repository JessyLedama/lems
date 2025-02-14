<?php 

namespace App\Services;

use App\Models\EmailAccount;

class EmailAccountService
{
    /**
     *  get all accounts.
     *  returns a collection.
     */
    public static function all()
    {
        $emails = EmailAccount::all();

        return $emails;
    }
}