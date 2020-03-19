<?php

namespace App\Http\Controllers;

use App\Decorators\TiposDeCargaCatalogControllerDecorator;
use App\Repositories\TiposDeCargaRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * Class TiposDeCargaCatalogController
 * @package App\Http\Controllers
 */
class TiposDeCargaCatalogController extends Controller
{

    /** @var TiposDeCargaRepository $tiposDeCargaRepository */
    protected $tiposDeCargaRepository;

    /** @var TiposDeCargaCatalogControllerDecorator $decorator*/
    protected $decorator;

    /**
     * TiposDeCargaCatalogController constructor.
     * @param TiposDeCargaRepository $tiposDeCargaRepository
     * @param TiposDeCargaCatalogControllerDecorator $decorator
     */
    public function __construct(
        TiposDeCargaRepository $tiposDeCargaRepository,
        TiposDeCargaCatalogControllerDecorator $decorator)
    {
        $this->tiposDeCargaRepository = $tiposDeCargaRepository;
        $this->decorator = $decorator;
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

}
