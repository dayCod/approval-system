<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = [
            [
                'name' => 'Department A',
                'code' => generateDepartmentCode('Department A'),
                'created_at' => now(),
            ],
            [
                'name' => 'Department B',
                'code' => generateDepartmentCode('Department B'),
                'created_at' => now(),
            ],
            [
                'name' => 'Department C',
                'code' => generateDepartmentCode('Department C'),
                'created_at' => now()
            ],
        ];

        Department::insert($department);
    }
}
