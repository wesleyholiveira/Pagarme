<?php

namespace App\Http\Validator;

use Validator;
use Fig\Http\Message\StatusCodeInterface;

abstract class AbstractValidator
{
    protected $rules = [];

    protected $messages = [
        'required'      => 'O campo :attribute e obrigatorio.',
        'max'           => 'O campo :attribute e maior que o permitido(:max).',
        'numeric'       => 'O campo :attribute deve ser um numero.'
    ];

    /**
     * @param $data
     * @throws \Exception
     */
    public function validate($data)
    {
        $validator = Validator::make($data, $this->rules, $this->messages);
        if($validator->fails())
            throw new \Exception($validator->errors()->first(), StatusCodeInterface::STATUS_BAD_REQUEST);
    }
}