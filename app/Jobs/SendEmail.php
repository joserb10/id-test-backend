<?php

namespace App\Jobs;

use App\Mail\MailForQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $title;
    private $description;
    private $to;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title,$description,$to)
    {
        $this->title = $title;
        $this->description = $description;
        $this->to = $to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new MailForQueue($this->title,$this->description);
        Mail::to($this->to)->send($email);
    }
}
