<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;
use Illuminate\Support\Facades\Auth;

class Login extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

        $data = [
            'email' => $dto['email'],
            'password' => $dto['password'],
        ];

        if (Auth::attempt($data)) {

            $this->result['success'] = true;

            $attemped_user = User::where('id', auth()->id())->first();

            $this->result['message'] = "Anda Berhasil Login";
            $this->result['data'] = $attemped_user;

        } else {

            $this->result['message'] = "Akun Yang Di input tidak match dengan record di database";
            $this->result['data'] = [];

        }


    }
}
