<?php

namespace App\Http\Validator;

/**
 * Class FornecedorValidator
 * @package App\Http\Validator
 */
class FornecedorValidator extends AbstractValidator
{
    protected $rules = [
        'id' => 'numeric|required',
        'nome' => 'required|min:4|max:60',
    ];
}
