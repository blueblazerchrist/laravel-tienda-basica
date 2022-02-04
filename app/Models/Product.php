<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @method static paginate(int $int)
 * @method static create(array $data)
 * @property mixed $product_name
 * @property mixed $product_image
 * @property mixed $reference
 * @property mixed $category_id
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'product_name',
        'product_image',
        'product_slug_name',
        'reference',
        'sale_price',
        'category_id',
    ];

    /**
     * Set the product name to product slug name.
     *
     * @return void
     */
    public function setProductNameAttribute($productName)
    {
        $this->attributes['product_slug_name'] = Str::slug($productName);
        $this->attributes['product_name'] = $productName;
    }

    /**
     * Set the product image move to storage image products.
     *
     * @return void
     */
    public function setProductImageAttribute($productImage)
    {
        if(isset($this->attributes['id'])){
            $product = Product::where('id',$this->attributes['id'])->first();
            if(!is_null($product)) {
                if(Storage::disk('products')->exists($productImage)){
                    Storage::disk('products')->delete($productImage);
                }
            }
        }

        $extension = $productImage->getClientOriginalExtension();
        $fileImageName = Carbon::now()->timestamp . '_Product' . '.' . $extension;
        \Storage::disk('products')->put($fileImageName, \File::get($productImage));
        $this->attributes['product_image'] = $fileImageName;
    }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

}
