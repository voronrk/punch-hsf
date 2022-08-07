<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;

class MachineController extends PropertyController
{
    public function __construct()
    {
        $this->model = new Machine;
    }
}
