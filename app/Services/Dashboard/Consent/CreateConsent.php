<?php

namespace App\Services\Dashboard\Consent;

use App\Models\Consent;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class CreateConsent extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

        $input_data = [
            'name' => $dto['name']
        ];

        $create_consent = Consent::create($input_data);

        $this->result['success'] = true;
        $this->result['message'] = 'Data Berhasil Diambil';
        $this->result['data'] = $create_consent;

    }
}
