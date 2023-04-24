<?php

function generateDepartmentCode($name)
{
    $name = strtoupper($name);

    return ($name[0] . $name[strlen($name) - 1]);
}
