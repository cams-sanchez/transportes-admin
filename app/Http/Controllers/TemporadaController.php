<?php

namespace App\Http\Controllers;

use App\Decorators\TemporadaControllerDecorator;
use App\Decorators\TiroControllerDecorator;
use App\Repositories\TemporadaRepository;
use App\Temporada;
use App\Validators\ValidationRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TemporadaController extends Controller
{

    /** @var TemporadaControllerDecorator $decorator */
    protected $decorator;

    /** @var ValidationRules $validator */
    protected $validator;

    /** @var TemporadaRepository $repository */
    protected $repository;

    /**
     * TemporadaController constructor.
     * @param ValidationRules $validator
     * @param TemporadaControllerDecorator $decorator
     */
    public function __construct(
        ValidationRules $validator,
        TemporadaControllerDecorator $decorator,
        TemporadaRepository $repository
    )
    {
        $this->validator = $validator;
        $this->decorator = $decorator;
        $this->repository = $repository;
    }

    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validator->getRules('create', 'temporada'));

        if ($validator->fails()) {
            return response()->json($this->decorator->decorateErrorValidationResponse($validator->messages()->first()));
        }

        $temporada = [
            'nombre' => $request->file('delivery'),
            'descripcion' => $request->file('establecimiento'),
        ];

        $returnedValue = $this->repository->newTemporada($temporada);

        return response()->json($this->decorator->decorateTemporadaResponse($returnedValue));
    }
}
