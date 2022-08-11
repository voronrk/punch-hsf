<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends PropertyController
{
    public function __construct()
    {
        $this->model = new Material;
        $this->tableName = $this->model->getTable();
    }
}
