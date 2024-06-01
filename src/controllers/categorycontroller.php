<?php

namespace App\Controllers;

use App\Models\Category;


class CategoryController extends Category
{
    public function __construct($name)
    {
        parent::__construct($name);
    }
}
