<?php

namespace App\Services\Dashboard\ApplicationApproval;

use App\Models\ApprovalApplication;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class GetApplication extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

        $find_approval = ApprovalApplication::where('id', $dto['application_id'])->first();

        if (empty($find_approval)) {

            $this->result['message'] = 'Data Kosong';
            $this->result['data'] = [];

        } else {

            $this->result['success'] = true;
            $this->result['message'] = 'Data Berhasil Diambil';
            $this->result['data'] = $find_approval;

        }

    }
}
