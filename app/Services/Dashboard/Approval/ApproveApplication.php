<?php

namespace App\Services\Dashboard\Approval;

use App\Jobs\SendMail;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;
use Illuminate\Support\Facades\DB;

class ApproveApplication extends BaseService implements BaseServiceInterface
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

                $this->result['message'] = $find_application['message'];
                $this->result['data'] = [];

            } else {

                $find_application['data']->update([
                    'status' => 1, // approved
                ]);

                SendMail::dispatch($find_application['data']->user->email, 'Application Notification', 'template.mail.application');

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
