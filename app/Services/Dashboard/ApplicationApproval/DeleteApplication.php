<?php

namespace App\Services\Dashboard\ApplicationApproval;

use App\Services\BaseService;
use App\Models\ApprovalApplication;
use Illuminate\Support\Facades\File;
use App\Services\BaseServiceInterface;

class DeleteApplication extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

        $find_approval = ApprovalApplication::where('id', $dto['application_id'])->first();

        if (empty($find_approval)) {

            $this->result['message'] = 'Data Kosong';
            $this->result['data'] = [];

        } else {
            File::delete(public_path($find_approval->evidence_img));

            $find_approval->delete();

            $this->result['success'] = true;
            $this->result['message'] = 'Data Berhasil Dihapus';
            $this->result['data'] = $find_approval;

        }

    }
}
