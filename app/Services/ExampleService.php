<?php

namespace App\Services;

use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class ExampleService extends BaseService implements BaseServiceInterface
{
    public function process($dto)
    {
        $this->result['success'] = false;

    }
}
