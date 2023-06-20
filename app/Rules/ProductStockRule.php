<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProductStockRule implements Rule
{
    protected $in_stock ;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($in_stock)
    {
        $this->in_stock = $in_stock ;
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
       if($this->in_stock == 1 && $value == null)
       return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'the qty is required.';
    }
}
