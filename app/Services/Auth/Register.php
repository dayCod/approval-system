<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Register extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $input_user = [
            'name' => $dto['name'],
            'email' => $dto['email'],
            'password' => Hash::make($dto['password']),
            'email_verified_at' => now(),
            'role' => 'user',
            'remember_token' => Str::random(10),
        ];

        $registered_user = User::create($input_user);

        $this->result['success'] = true;
        $this->result['message'] = 'User Berhasil Dibuat';
        $this->result['data'] = $registered_user;
    }
}
