<?php


namespace App\Decorators;


use Exception;

class GenericResponsesDecorator
{
    public function decorateErrorValidationResponse(string $errorReponse): array
    {
        return ['success' => false, 'error' => $errorReponse];
    }

    public function decorateErrorFileUploadResponse(): array
    {
        return ['success' => false, 'error' => 'Fail to upload and process the file'];
    }

    public function decorateSuccesfullFileUpload(): array
    {
        return ['success' => true, 'message' => "Files uploaded and processed"];
    }
}
