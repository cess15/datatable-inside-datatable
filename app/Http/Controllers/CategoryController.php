<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function findAll()
    {
        $categories = Category::all();
        return DataTables::of($categories)
            ->addColumn('subCategory', function($category) {
                return $category->subCategories;
            })
            ->addColumn('name', function ($category) {
                return $category->name;
            })
            ->addColumn('status', function ($category) {
                return $category->status==='A' ? 'Activo' : 'Inactivo';
            })
            ->make(true);
    }
}
