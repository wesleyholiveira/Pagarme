<?php

namespace App\Http\Validator;

/**
 * Class FornecedorValidator
 * @package App\Http\Validator
 */
class ImagemValidator extends AbstractValidator
{
    protected $rules = [
        'id' => 'numeric|required',
        'uri' => 'required|min:8|max:255'
    ];
}
