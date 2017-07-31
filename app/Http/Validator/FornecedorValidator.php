<?php

namespace App\Http\Validator;

class FornecedorValidator extends AbstractValidator
{
    protected $rules = [
        'id' => 'numeric|required',
        'nome' => 'required|max:60',
        'comissao' => 'required|numeric'
    ];
}