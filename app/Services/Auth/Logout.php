<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;
use Illuminate\Support\Facades\Auth;

class Logout extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

        $authenticated_user = User::where('id', $dto['user_id'])->first();

        if (empty($authenticated_user)) {

            $this->result['message'] = "Terjadi Kesalahan";
            $this->result['data'] = [];

        } else {

            $this->result['success'] = true;
            $this->result['message'] = "Berhasil Logout";
            $this->result['data'] = $authenticated_user;

        }

    }
}
