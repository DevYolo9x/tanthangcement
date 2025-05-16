<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class QuantityAvailable implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($productId)
    {
        $this->productId = $productId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $product = DB::table('products')->where('id', $this->productId)->first();

        return $product && $value < $product->quantity;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Số lượng răng không được lớn hơn số lượng trong kho';
    }
}
