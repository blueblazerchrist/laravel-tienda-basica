<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method static paginate(int $int)
 * @method static select(string $string, string $string1)
 * @method static create(array $data)
 * @property mixed $category_name
 */
class Category extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'category_name',
        'category_slug_name',
    ];

    /**
     * Set the category name to slug name category.
     *
     * @return void
     */
    public function setCategoryNameAttribute($categoryName)
    {
        $this->attributes['category_name'] = $categoryName;
        $this->attributes['category_slug_name'] = Str::slug($categoryName);
    }
}
