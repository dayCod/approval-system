<?php

namespace App\Services\Dashboard\Department;

use App\Models\Department;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class CreateDepartment extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

        $input_data = [
            'name' => $dto['name'],
            'code' => generateDepartmentCode($dto['name'])
        ];

        $create_department = Department::create($input_data);

        $this->result['success'] = true;
        $this->result['message'] = 'Data Berhasil Dibuat';
        $this->result['data'] = $create_department;

    }
}
