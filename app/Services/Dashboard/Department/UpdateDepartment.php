<?php

namespace App\Services\Dashboard\Department;

use App\Models\Department;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class UpdateDepartment extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

        $input_data = [
            'name' => $dto['name']
        ];

        $find_department = Department::where('id', $dto['department_id'])->first();

        if (empty($find_department)) {

            $this->result['message'] = 'Data Kosong';
            $this->result['data'] = [];

        } else {

            $find_department->update($input_data);

            $this->result['success'] = true;
            $this->result['message'] = 'Data Berhasil Diupdate';
            $this->result['data'] = $find_department;

        }
    }
}
