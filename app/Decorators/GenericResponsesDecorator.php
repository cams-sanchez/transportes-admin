<?php


namespace App\Decorators;


class GenericResponsesDecorator
{
    public function decorateErrorValidationResponse(string $errorReponse): array
    {
        return ['sucess' => false, 'error' => $errorReponse];
    }
}
