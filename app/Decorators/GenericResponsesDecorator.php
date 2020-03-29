<?php


namespace App\Decorators;


use Exception;

class GenericResponsesDecorator
{
    public function decorateErrorValidationResponse(string $errorReponse): array
    {
        return ['sucess' => false, 'error' => $errorReponse];
    }

    public function decorateErrorFileUploadResponse(): array
    {
        return ['sucess' => false, 'error' => 'Fail to upload and process the file'];
    }

    public function decorateSuccesfullFileUpload(): array
    {
        return ['sucess' => true, 'message' => "Files uploaded and processed"];
    }
}
