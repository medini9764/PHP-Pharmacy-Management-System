<?php

namespace App\Jobs;

use App\Mail\QuotationMailSend;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class QuotationJobSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $pres_id;
    /**
     * Create a new job instance.
     */
    public function __construct($pres_id)
    {
        $this->pres_id= $pres_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $prescription = Prescription::findOrFail( $this->pres_id);
        $user = User::findOrFail( $prescription->user_id);

        Mail::to($user->email)
        ->send(new QuotationMailSend($this->pres_id,$user->name));
    }
}
