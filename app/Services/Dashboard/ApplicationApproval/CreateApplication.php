<?php

namespace App\Services\Dashboard\ApplicationApproval;

use App\Models\ApprovalApplication;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;
use App\Traits\Image;

class CreateApplication extends BaseService implements BaseServiceInterface
{
    use Image;

    public function process($dto)
    {
        $this->result['success'] = false;
        dd($dto);

        $input_data = [
            'consent_id' => $dto['consent_id'],
            'department_id' => $dto['department_id'],
            'need_remark' => $dto['need_remark'],
            'remark' => $dto['remark'],
        ];

        $upload_image = $this->uploadImage($dto['evidence_img'], 'upload/evidence_img');

        $input_data['evidence_img'] = $upload_image['path'];

        $create_application = ApprovalApplication::create($input_data);

        $this->result['success'] = true;
        $this->result['message'] = 'Data Berhasil Dibuat';
        $this->result['data'] = $create_application;
    }
}
