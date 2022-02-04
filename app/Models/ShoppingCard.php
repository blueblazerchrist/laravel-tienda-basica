<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ShoppingCard extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shopping_cards';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'product_id',
        'quantity',
        'user_id',
    ];

    /**
     *
     * @return HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'product_id', 'id');
    }

    /**
     *
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'product_id', 'id');
    }
}
