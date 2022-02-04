<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiCategoryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $categories = Category::select('id','category_name')
//                                ->where('category_name', 'like', '%'.$word.'%')
                                ->limit(10)
                                ->get();

        return response()->json(['status'=> true, 'categories' => $categories]);
    }
}
