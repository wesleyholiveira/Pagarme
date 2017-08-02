<?php

namespace App\Http\Validator;

class CheckoutValidator extends AbstractValidator
{
    protected $rules = [
        'nome' => 'required|min:4|max:60',
        'valor' => 'required|numeric'
    ];
}
