<?php

namespace App\Services;

use App\Services\BaseServiceInterface;

abstract class BaseService implements BaseServiceInterface
{
    protected $result;

    public function __construct()
    {
        $this->result = ['success' => null, 'message' => null, 'data' => null];
    }

    abstract protected function process( $data );

    public function execute($input)
    {
        $this->process($input);

        return $this->result;
    }
}
