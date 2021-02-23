<?php

namespace App\AbstractClasses;

use App\Interfaces\ResponseDecoratorInterface;
use App\Validators\ValidationRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Contracts\Validation\Validator as ValidatorObject;

use Closure;

abstract class MiddleWareValidator
{
    /**
     * @var ValidationRules $validationRules
     */
    protected ValidationRules $validationRules;

    /**
     * @var ResponseDecoratorInterface $decorator
     */
    protected ResponseDecoratorInterface $decorator;

    /**
     * @var string $operationToValidate
     */
    protected string $operationToValidate = '';

    /**
     * @var bool $isAllowedToProceed
     */
    protected bool $isAllowedToProceed = true;

    /**
     * @var ValidatorObject $validator
     */
    protected ValidatorObject $validator;
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * MiddleWareValidator constructor.
     * @param ValidationRules $validationRules
     * @param ResponseDecoratorInterface $decorator
     */
    public function __construct(ValidationRules $validationRules, ResponseDecoratorInterface $decorator)
    {
        $this->validationRules = $validationRules;
        $this->decorator = $decorator;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public abstract function handle(Request $request, Closure $next);

    public function verifyHttpRequestVerb()
    {
        switch ($this->request->method()) {
            case 'GET':
                $this->operationToValidate = 'get';
                $this->isAllowedToProceed = false;
                break;
            case 'POST':
                $this->operationToValidate = 'new';
                break;
            case 'PUT':
                $this->operationToValidate = 'edit';
                break;
            case 'DELETE':
                $this->operationToValidate = 'delete';
                break;
        }
    }

    public function validateIncomingRequestValues()
    {
        $this->validator = Validator::make(
            $this->request->all(),
            $this->validationRules->getRules($this->operationToValidate)
        );
    }

    public function generateDecoratorResponse()
    {
        return $this->decorator->decorateErrorValidationResponse($this->validator->messages()->first());
    }

}
