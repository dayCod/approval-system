<?php

namespace App\Services\Dashboard\User;

use App\Models\User;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class GetUser extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

        $latest_user = User::where('id', $dto['user_id'])->first();

        if (empty($latest_user)) {

            $this->result['message'] = 'Data Kosong';
            $this->result['data'] = [];

        } else {

            $this->result['success'] = true;
            $this->result['message'] = 'Data Berhasil Diambil';
            $this->result['data'] = $latest_user;

        }

    }
}
