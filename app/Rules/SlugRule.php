<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SlugRule implements ValidationRule
{
    protected $modelClass;
    protected $ignoreId;
    protected $fieldName;
    
    public function __construct($modelClass, $fieldName = 'slug', $ignoreId = null)
    {
        $this->modelClass = $modelClass;
        $this->ignoreId = $ignoreId;
        $this->fieldName = $fieldName;
    }

    public function passes($attribute, $value)
    {
        $model = new $this->modelClass;

        $query = $model->where($this->fieldName, $value);

        if ($this->ignoreId !== null) {
            $query->where('id', '!=', $this->ignoreId);
        }

        return !$query->exists();
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->passes($attribute, $value)) {
            $fail('The :attribute has already been taken.');
        }
    }
}
