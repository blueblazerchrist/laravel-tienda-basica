<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use function redirect;
use function view;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::paginate(15);
        $columns = [
            'category_name' => 'Nombre de la categoria',
            'category_slug_name' => 'Categoria slug',
            'created_at' => 'Fecha de creado',
            'updated_at' => 'Fecha de ultima actualizado',
        ];

        $actions = [
            'categories_edit' => ['text-purple-600'=>'fas fa-edit'],
            'categories_delete' => ['text-red-500'=>'fas fa-trash-alt'],
        ];

        return view('backoffice.category.index', compact('categories', 'columns', 'actions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('backoffice.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $data = $request->all();
        Category::create($data);
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category)
    {
        return view('backoffice.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        if($request->has('category_name')) {
            $category->category_name = $request->get('category_name');
        }

        if($category->isClean()) {
            return redirect()->route('categories.index')->withErrors(['mensaje'=>'al menos un valor debe ser distinto']);
        }

        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return response()->json(['status'=> true]);
    }
}
