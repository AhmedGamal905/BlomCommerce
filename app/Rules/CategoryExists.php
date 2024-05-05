<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Category;

class CategoryExists implements Rule
{
    public function passes($attribute, $value)
    {
        return Category::where('id', $value)->exists();
    }

    public function message()
    {
        return 'The selected category does not exist.';
    }
}
