<?php

namespace App\Services\Dashboard\User;

use App\Models\User;
use Illuminate\Support\Str;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;
use App\Services\BaseServiceInterface;

class CreateUser extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

        $input_user = [
            'name' => $dto['name'],
            'email' => $dto['email'],
            'password' => Hash::make($dto['password']),
            'email_verified_at' => now(),
            'role' => 'user',
            'remember_token' => Str::random(10),
        ];

        $created_user = app('register')->execute($input_user);

        $created_user['data']->assignRole('user');

        $this->result['success'] = true;
        $this->result['message'] = 'Data Berhasil Dibuat';
        $this->result['data'] = $created_user['data'];

    }
}
