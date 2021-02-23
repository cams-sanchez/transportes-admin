<?php


namespace App\Decorators;


use App\Interfaces\ResponseDecoratorInterface;

class GenericResponsesDecorator implements ResponseDecoratorInterface
{
    public function decorateErrorValidationResponse(string $errorResponse): array
    {
        return ['success' => false, 'error' => $errorResponse];
    }

    public function decorateErrorFileUploadResponse(): array
    {
        return ['success' => false, 'error' => 'Fail to upload and process the file'];
    }

    public function decorateSuccessfulFileUpload(): array
    {
        return ['success' => true, 'message' => "Files uploaded and processed"];
    }
}
