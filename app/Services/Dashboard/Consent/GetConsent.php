<?php

namespace App\Services\Dashboard\Consent;

use App\Models\Consent;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class GetConsent extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

        $find_consent = Consent::where('id', $dto['consent_id'])->first();

        if (empty($find_consent)) {

            $this->result['message'] = 'Data Kosong';
            $this->result['data'] = [];

        } else {

            $this->result['success'] = true;
            $this->result['message'] = 'Data Berhasil Diambil';
            $this->result['data'] = $find_consent;

        }

    }
}
