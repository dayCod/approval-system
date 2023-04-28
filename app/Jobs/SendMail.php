<?php

namespace App\Jobs;

use App\Helpers\Email;
use App\Models\ApprovalApplication;
use App\Models\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $to, $title, $view;

    public function __construct($to, $title, $view)
    {
        $this->to = $to;
        $this->title = $title;
        $this->view = $view;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::where('email', $this->to)->first();

        $application = ApprovalApplication::where('user_id', $user['id'])->first();

        $data['name'] = $user['name'];

        switch ($application['status']) {
            case 1:
                $data['status'] = 'Approve';
                break;
            case 2:
                $data['status'] = 'Reject';
                break;
            case 3:
                $data['status'] = 'Revise';
                break;
            default:
                $data['status'] = 'Process';
        }

        Email::send($this->to, $this->title, $this->view, $data);
    }
}
