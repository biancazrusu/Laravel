<?php

namespace App\Jobs;

use App\Mail\EmailSend;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $dataEmail;

    public function __construct($dataEmail)
    {
        $this->dataEmail   = $dataEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sendEmail = new EmailSend($this->dataEmail);
        Mail::to($this->dataEmail['email'])->send($sendEmail);
    }
}
