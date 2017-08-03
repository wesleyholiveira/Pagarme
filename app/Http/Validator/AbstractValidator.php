<?php

namespace App\Http\Validator;

use Validator;
use Fig\Http\Message\StatusCodeInterface;

/**
 * Class AbstractValidator
 * @package App\Http\Validator
 */
abstract class AbstractValidator
{
    /* @var array */
    protected $rules = [];

    /* @var array */
    protected $messages = [
        'required'      => 'O campo :attribute é obrigatorio.',
        'min'           => 'O campo :attribute deve conter no minimo (:min) caracteres.',
        'max'           => 'O campo :attribute é maior que o permitido(:max).',
        'numeric'       => 'O campo :attribute deve ser um número.'
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
