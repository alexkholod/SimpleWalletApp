<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function allCategories()
    {
        return view('categories', ['data' => Category::all()]);
    }
}
