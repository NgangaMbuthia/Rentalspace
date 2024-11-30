<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Backend\Entities\Contact;

class SendReminderEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    public $contact;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact=$contact;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Contact $model)
    {
        //
          

          return true;
    }
}
