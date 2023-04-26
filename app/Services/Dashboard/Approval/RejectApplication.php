<?php

namespace App\Services\Dashboard\Approval;

use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class RejectApplication extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

        $find_application = app('getApplication')->execute([
            'application_id' => $dto['application_id'],
        ]);

        if (!$find_application['success']) {

            $this->result['message'] = $find_application['message'];
            $this->result['data'] = [];

        } else {

            $find_application['data']->update([
                'status' => 2, // rejected
            ]);

            $this->result['success'] = true;
            $this->result['message'] = 'Application Rejected!';
            $this->result['data'] = $find_application['data'];

        }

    }
}
