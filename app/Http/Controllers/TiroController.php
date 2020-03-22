<?php

namespace App\Http\Controllers;

use App\Decorators\TiroControllerDecorator;
use App\Helpers\FileHelper;
use App\Repositories\TirosRepository;
use App\Validators\ValidationRules;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TiroController extends Controller
{
    /** @var TirosRepository $tiroRepository */
    protected $tiroRepository;

    /** @var TiroControllerDecorator $decorator */
    protected $decorator;

    /** @var ValidationRules $validator */
    protected $validator;

    /** @var FileHelper $fileHelper */
    protected $fileHelper;

    /**
     * TiroController constructor.
     * @param TirosRepository $tiroRepository
     * @param TiroControllerDecorator $decorator
     * @param ValidationRules $validator
     */
    public function __construct(
        TirosRepository $tiroRepository,
        TiroControllerDecorator $decorator,
        ValidationRules $validator,
        FileHelper $fileHelper)
    {
        $this->tiroRepository = $tiroRepository;
        $this->decorator = $decorator;
        $this->validator = $validator;
        $this->fileHelper = $fileHelper;
    }


    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $tiros = $this->tiroRepository->getAllTiros();

        return response()->json($this->decorator->decorateAllTirosResponse($tiros));
    }

    public function uploadEvidenciaToTiro(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validator->getRules('upload', 'tiro'));

        if ($validator->fails()) {
            return response()->json($this->decorator->decorateErrorValidationResponse($validator->messages()->first()));
        }

        $tiro = [
            'id' => $request->get('id'),
            'evidenciaFile' => $request->file('evidencia'),
            'evidencias' => $request->allFiles()
        ];

        Log::debug("INCOMING VALUES ".print_r($tiro, true));

        $imageUrl = $this->fileHelper->saveUploadedFile($tiro);

        $tiroFound = $this->tiroRepository->getTiroById($tiro);
        $tiroFound->url =$imageUrl;

         return response()->json($this->decorator->decorateTiroResponse($tiroFound));
    }

}
