<?php

namespace App\Rules;

use App\Models\Products;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductCodeRule implements ValidationRule
{
    protected $ignoreId;

    public function __construct($ignoreId = null)
    {
        $this->ignoreId = $ignoreId;
    }

    public function passes($value)
    {
        $query = Products::where('product_code', $value);
        if ($this->ignoreId !== null) {
            $query->where('id', '!=', $this->ignoreId);
        }
        return !$query->exists();
    }


    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->passes($value)) {
            $fail('The Product Code has already been taken.');
        }
    }
}
