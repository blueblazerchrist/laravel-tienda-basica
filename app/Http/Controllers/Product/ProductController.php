<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use function redirect;
use function response;
use function view;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = Product::paginate(15);

        $columns = [
            'product_name' => 'Nombre del producto',
            'product_image' => ['img','Imagen del producto'],
            'reference' => 'Referencia',
            'sale_price' => 'Precio de venta',
            'category' => ['category_name' => 'Categoria'],
        ];

        $actions = [
            'products_edit' => ['text-purple-500'=>'fas fa-edit'],
            'products_delete' => ['text-red-500'=>'fas fa-trash-alt'],
            'products_show' => ['text-green-500'=>'fas fa-eye'],
            'prices_modal' => ['text-pink-500'=>'fas fa-donate'],
        ];

        return view('backoffice.product.index', compact('products', 'columns', 'actions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('backoffice.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->all();
        Product::create($data);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function show(Product $product)
    {
        return view('backoffice.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(Product $product)
    {
        return view('backoffice.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        if($request->has('product_name')) {
            $product->product_name = $request->get('product_name');
        }

        if($request->hasFile('product_image')) {
            $product->product_image = $request->file('product_image');
        }

        if($request->has('reference')) {
            $product->reference = $request->get('reference');
        }

        if($request->has('category_id')) {
            $product->category_id = $request->get('category_id');
        }

        if($product->isClean()) {
            return redirect()->route('product.index')->withErrors(['mensaje'=>'al menos un valor debe ser distinto']);
        }

        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        if(Storage::disk('products')->exists($product->product_image)){
            Storage::disk('products')->delete($product->product_image);
        }
        return response()->json(['status'=>true]);
    }
}
