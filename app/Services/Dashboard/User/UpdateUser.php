<?php

namespace App\Services\Dashboard\User;

use App\Models\User;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class UpdateUser extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

        $input_user = [
            'name' => $dto['name'],
            'email' => $dto['email']
        ];

        $find_user = User::where('id', $dto['user_id'])->first();

        if (empty($find_user)) {

            $this->result['message'] = 'Data Kosong';
            $this->result['data'] = [];

        } else {

            $find_user->update($input_user);

            $this->result['success'] = true;
            $this->result['message'] = 'Data Berhasil Di Update';
            $this->result['data'] = $find_user;

        }
    }
}
