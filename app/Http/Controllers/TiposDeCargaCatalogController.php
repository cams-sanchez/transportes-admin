<?php

namespace App\Http\Controllers;

use App\Decorators\TiposDeCargaCatalogControllerDecorator;
use App\Helpers\TipoDeCargaCatalogValidatorHelper;
use App\Repositories\TiposDeCargaRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * Class TiposDeCargaCatalogController
 * @package App\Http\Controllers
 */
class TiposDeCargaCatalogController extends Controller
{

    /** @var TiposDeCargaRepository $tiposDeCargaRepository */
    protected $tiposDeCargaRepository;

    /** @var TiposDeCargaCatalogControllerDecorator $decorator */
    protected $decorator;

    protected $validator;

    /**
     * TiposDeCargaCatalogController constructor.
     * @param TiposDeCargaRepository $tiposDeCargaRepository
     * @param TiposDeCargaCatalogControllerDecorator $decorator
     */
    public function __construct(
        TiposDeCargaRepository $tiposDeCargaRepository,
        TiposDeCargaCatalogControllerDecorator $decorator,
        TipoDeCargaCatalogValidatorHelper $validator)
    {
        $this->tiposDeCargaRepository = $tiposDeCargaRepository;
        $this->decorator = $decorator;
        $this->validator = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $tiposDeCarga = $this->tiposDeCargaRepository->getAllTiposDeCarga();

        return response()->json($this->decorator->decorateAllTiposDeCargaResponse($tiposDeCarga));
    }

    public function createNewTipoCarga(Request $request)
    {

        $validator = Validator::make($request->all(), $this->validator->getRules('new'));

        if ($validator->fails()) {
            return response()->json($this->decorator->decorateErrorValidationResponse($validator->messages()->first()));
        }

        $tipoDeCarga = [
            'nombre' => $request->get('nombre'),
            'unidadMetrica' => $request->get('unidadMetrica'),
            'descripcion' => $request->get('descripcion'),
        ];

        $newTipoDeCarga = $this->tiposDeCargaRepository->newTipoDeCarga($tipoDeCarga);

        return response()->json($this->decorator->decorateResponseTipoDeCarga($newTipoDeCarga));
    }

    public function updateTipoDeCarga(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validator->getRules('edit'));

        if ($validator->fails()) {
            return response()->json($this->decorator->decorateErrorValidationResponse($validator->messages()->first()));
        }


        $tipoDeCarga = [
            'id' => $request->get('id'),
            'nombre' => $request->get('nombre'),
            'unidadMetrica' => $request->get('unidadMetrica'),
            'descripcion' => $request->get('descripcion')
        ];

        $updatedTipoDeCarga = $this->tiposDeCargaRepository->updateTipoDeCarga($tipoDeCarga);

        return response()->json($this->decorator->decorateResponseTipoDeCarga($updatedTipoDeCarga));

    }

    public function getById(Request $request)
    {
        $rules = [
            'id' => 'required',
        ];

        $request->validate($rules);

        $tipoDeCarga = [
            'id' => $request->get('id'),
        ];

        $this->tiposDeCargaRepository->searchTipoDeCargaById($tipoDeCarga);
    }

    public function deleteTipoDeCarga(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validator->getRules('delete'));

        if ($validator->fails()) {
            return response()->json($this->decorator->decorateErrorValidationResponse($validator->messages()->first()));
        }

        $tipoDeCarga = [
            'id' => $request->get('id'),
        ];

        $deletedTipodeCarga = $this->tiposDeCargaRepository->deleteTipoDeCarga($tipoDeCarga);

        return response()->json($this->decorator->decorateResponseTipoDeCarga($deletedTipodeCarga));

    }
}
