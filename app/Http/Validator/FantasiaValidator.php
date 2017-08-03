<?php

namespace App\Http\Validator;

class FantasiaValidator extends AbstractValidator
{
    protected $rules = [
        'id' => 'numeric|required',
        'descricao' => 'required|min:4|max:60',
        'valor' => 'required|numeric',
    ];
}
