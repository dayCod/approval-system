<?php

namespace App\Services\Dashboard\ApplicationApproval;

use App\Models\ApprovalApplication;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;
use App\Traits\Image;

class UpdateApplication extends BaseService implements BaseServiceInterface
{
    use Image;

    public function process($dto)
    {
        $this->result['success'] = false;

        $input_data = [
            'user_id' => $dto['user_id'],
            'consent_id' => $dto['consent_id'],
            'department_id' => $dto['department_id'],
            'need_remark' => $dto['need_remark'],
            'remark' => $dto['remark'] ?? null,
        ];

        $find_application = ApprovalApplication::where('id', $dto['application_id'])->first();

        if (empty($find_application)) {

            $this->result['message'] = 'Data Kosong';
            $this->result['data'] = [];

        } else {

            $upsert_image_check = $this->uploadImage($dto['evidence_img'], 'upload/evidence_img/', $find_application->evidence_img);

            if (!$upsert_image_check['upload_image']) {

                $input_data['evidence_img'] = $find_application['evidence_img'];

                $find_application->update($input_data);

                $this->result['success'] = true;
                $this->result['message'] = 'Data Berhasil Diupdate Tanpa Gambar';
                $this->result['data'] = $find_application;

            } else {

                $input_data['evidence_img'] = $upsert_image_check['path'];

                $find_application->update($input_data);

                $this->result['success'] = true;
                $this->result['message'] = 'Data Berhasil Diupdate Dengan Gambar';
                $this->result['data'] = $find_application;

            }

        }
    }
}
