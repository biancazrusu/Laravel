<?php
namespace App\Helpers;

use App\Jobs\SendEmail;

class EmailToSend
{

    public function __construct()
    {

    }

    public function sendEmail($dataEmail)
    {
        dispatch(new SendEmail($dataEmail));
    }

}
