<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends PropertyController
{
    public function __construct()
    {
        $this->model = new Product;
        $this->tableName = $this->model->getTable();
    }
}
