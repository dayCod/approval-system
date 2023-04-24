<?php

namespace App\Services\Dashboard\User;

use App\Models\User;
use Illuminate\Support\Str;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;
use App\Services\BaseServiceInterface;

class DeleteUser extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

        $find_user = User::where('id', $dto['user_id'])->first();

        if (empty($find_user)) {

            $this->result['message'] = 'Data Kosong';
            $this->result['data'] = [];

        } else {

            $find_user->delete();

            $this->result['success'] = true;
            $this->result['message'] = 'Data Berhasil Dihapus';
            $this->result['data'] = $find_user;

        }

    }
}
