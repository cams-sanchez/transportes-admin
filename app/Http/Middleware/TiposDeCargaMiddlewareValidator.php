<?php

namespace App\Http\Middleware;

use App\AbstractClasses\MiddleWareValidator;
use Closure;
use Illuminate\Http\Request;
use App\Validators\ValidationRules;
use Illuminate\Support\Facades\Log;
use App\Decorators\TiposDeCargaCatalogControllerDecorator;

class TiposDeCargaMiddlewareValidator extends MiddleWareValidator
{

    public function __construct(
        ValidationRules $validationRules,
        TiposDeCargaCatalogControllerDecorator $decorator)
    {
        parent::__construct($validationRules, $decorator);
    }


    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->request = $request;
        Log::debug('____________MIDDLE WARE CARGA INCOMMING ');
        Log::info(json_encode($request->all()));
        Log::debug('Reqquest Method '.$request->method());
        $this->verifyHttpRequestVerb();
        if($this->isAllowedToProceed ) {
            $this->validateIncomingRequestValues();

            if ($this->validator->fails()) {
                Log::debug('We have Validation Error '. $this->validator->messages()->first());
                return response()->json($this->generateDecoratorResponse());
            }
        }

        return $next($request);
    }
}
