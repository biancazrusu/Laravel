<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $dataEmail;

    public function __construct($dataEmail)
    {
        $this->dataEmail        = $dataEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    private function randomPassword()
    {
        $alphabet    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass        = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n      = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function build()
    {
        if ($this->dataEmail['subject'] == '[Lori] Forgot Password') {
            $password       = $this->randomPassword();
            $user           = User::where('email', $this->dataEmail['email'])->first();
            $user->password = password_hash($password, PASSWORD_BCRYPT);
            $user->save();
            $pTag = 'Someone requested a new password for your Lori account. Your new password is <strong>'
                    .$password.
                    '</strong> .You can change your password using it.';
            $name = 'there';
            $link = 'http://lori-back.icoldo.com/public';
            $button = 'Change Password';
        } else if ($this->dataEmail['subject'] == 'Welcome to Lori!') {
            $pTag = 'Thanks for singing up to keep in touch with Lori.
                    Click the link below to activate your account';
            $link = 'http://lori-back.icoldo.com/public/confirm/' . $this->dataEmail['activateKey'];
            $name = $this->dataEmail['name'];
            $button = 'Confirm your account';
        } else if ($this->dataEmail['subject'] == '[Lori] Reset Password') {
            $pTag = 'Your password has been reset successfully.';
            $link = 'http://lori-back.icoldo.com/public';
            $name = $this->dataEmail['name'];
            $button = 'Login';
        } else{
            $pTag = 'Thank you for your interest in our application. Your resume for estimate: ';
            $link = $this->dataEmail['link'];
            $name = $this->dataEmail['name'];
            $button = 'View Estimate';
        }
            $emailText = '<h2 style="font-size: 25px;">Hi '. $name .',</h2>
                        <p class="lead">'. $pTag .'</p>
                        <div align="center"> <a href="'. $link .'">
                        <button style="background-color: #00e777; color: white; border: none;
                        padding: 15px 32px; text-align: center; font-size: 16px; margin: 4px 2px; cursor: pointer;"> '
                        . $button.' </button></a></div>
                        <p class="callout">
                        If you did not make this request then you can safely ignore this email :)
                        </a></p>';
            return $this->view('emailTemplate')
                ->subject($this->dataEmail['subject'])
                // ->from('lori@er-stelle-deine-app.de', 'Lori')
                ->with(['text' => $emailText]);
    }
}
