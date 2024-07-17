<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class MaxTipologies implements Rule
{
    private $max;

    public function __construct(int $max)
    {
        $this->max = $max;
    }

    public function passes($attribute, $value)
    {
        return count($value) <= $this->max;
    }

    public function message()
    {
        return 'Hai selezionato troppi tipi. Seleziona al massimo 2.';
    }
}
