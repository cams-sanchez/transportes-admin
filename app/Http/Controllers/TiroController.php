<?php

namespace App\Http\Controllers;

use App\Decorators\TiroControllerDecorator;
use App\Handlers\EvidenciasImagesHandler;
use App\Handlers\ExcelFileUploadHandler;
use App\Helpers\FileHelper;
use App\Repositories\TirosRepository;
use App\Validators\ValidationRules;
use Exception;
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

    /** @var ExcelFileUploadHandler $excelHandler */
    protected $excelHandler;

    /** @var EvidenciasImagesHandler $excelHandler */
    protected $evidenciasImagesHandler;

    /**
     * TiroController constructor.
     * @param TirosRepository $tiroRepository
     * @param TiroControllerDecorator $decorator
     * @param ValidationRules $validator
     * @param FileHelper $fileHelper
     * @param ExcelFileUploadHandler $excelHandler
     * @param EvidenciasImagesHandler $evidenciasImagesHandler
     */
    public function __construct(
        TirosRepository $tiroRepository,
        TiroControllerDecorator $decorator,
        ValidationRules $validator,
        FileHelper $fileHelper,
        ExcelFileUploadHandler $excelHandler,
        EvidenciasImagesHandler $evidenciasImagesHandler
    )
    {
        $this->tiroRepository = $tiroRepository;
        $this->decorator = $decorator;
        $this->validator = $validator;
        $this->fileHelper = $fileHelper;
        $this->excelHandler = $excelHandler;
        $this->evidenciasImagesHandler = $evidenciasImagesHandler;
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
            'delivery' => $request->file('delivery'),
            'establecimiento' => $request->file('establecimiento'),
            'comentarios' => $request->get('comentarios'),
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
        ];

        Log::debug("INCOMING VALUES " . print_r($tiro, true));

        $this->evidenciasImagesHandler->processEvidenciasFilesForTiro($tiro);

        $tiroFound = $this->tiroRepository->getTiroById($tiro);

        return response()->json($this->decorator->decorateTiroResponse($tiroFound));
    }


    public function uploadExcel(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validator->getRules('uploadExcel', 'tiro'));

        if ($validator->fails()) {
            return response()->json($this->decorator->decorateErrorValidationResponse($validator->messages()->first()));
        }

        $excelInfo = [
            'excelFile' => $request->file('excelFile'),
        ];

        try {
            $this->excelHandler->processUploadedExcelFile($excelInfo);
        } catch (Exception $exception) {

            Log::debug("Error Message While processing Excel Upload" . $exception->getMessage());
            Log::debug("Error Trace: " . print_r($exception->getTrace(), true));

            return response()->json($this->decorator->decorateErrorFileUploadResponse());
        }


        return response()->json($this->decorator->decorateSuccesfullFileUpload(), 200);
    }
}
