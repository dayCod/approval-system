<?php

namespace App\Services\Dashboard\Approval;

use App\Models\Mail;
use App\Jobs\SendMail;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use App\Services\BaseServiceInterface;

class RejectApplication extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

        DB::beginTransaction();

        try {
            $find_application = app('getApplication')->execute([
                'application_id' => $dto['application_id'],
            ]);

            if (!$find_application['success']) {

                $mail_input = [
                    'to_email' => $find_application['data']->user->email,
                    'from_email' => env('MAIL_FROM_ADDRESS'),
                    'is_success' => true,
                ];

                $mail_input['payload'] = array(json_encode($mail_input));

                Mail::create($mail_input);

                $this->result['message'] = $find_application['message'];
                $this->result['data'] = [];

            } else {

                $find_application['data']->update([
                    'status' => 2, // rejected
                    'revise_notes' => null,
                ]);

                SendMail::dispatch($find_application['data']->user->email, 'Application Notification', 'template.mail.application');

                $mail_input = [
                    'to_email' => $find_application['data']->user->email,
                    'from_email' => env('MAIL_FROM_ADDRESS'),
                    'is_success' => true,
                ];

                $mail_input['payload'] = array(json_encode($mail_input));

                Mail::create($mail_input);

                DB::commit();

                $this->result['success'] = true;
                $this->result['message'] = 'Application Approved!';
                $this->result['data'] = $find_application['data'];

            }
        } catch (\Exception) {
            DB::rollBack();
        }

    }
}
