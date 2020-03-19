<?php


namespace App\Repositories;

use App\Helpers\JsonHelper;
use App\Models\TiposDeCargaCatalog;

/**
 * Class TiposDeCargaRepository
 * @package App\Repositories
 */
class TiposDeCargaRepository
{
    /** @var TiposDeCargaCatalog $tiposDeCargaModel */
    protected $tiposDeCargaModel;

    protected $jsonHelper;

    /**
     * TiposDeCargaRepository constructor.
     * @param TiposDeCargaCatalog $tiposDeCargaModel
     */
    public function __construct(TiposDeCargaCatalog $tiposDeCargaModel, JsonHelper $jsonHelper)
    {
        $this->tiposDeCargaModel = $tiposDeCargaModel;
        $this->jsonHelper = $jsonHelper;
    }

    /**
     * @return mixed
     */
    public function getAllTiposDeCarga()
    {
        return $this->tiposDeCargaModel::where('status', '=', 'ACTIVO')->get();
    }

    public function newTipoDeCarga(string $tipoDeCarga)
    {
        $tipoDeCargaArray = $this->jsonHelper->decodeJSONString($tipoDeCarga);
        $newTipoDeCarga = new TiposDeCargaCatalog();

        $newTipoDeCarga->nombre = $tipoDeCargaArray['nombre'];
        $newTipoDeCarga->unidadMetrica = $tipoDeCargaArray['unidadMetrica'];
        $newTipoDeCarga->descripcion = $tipoDeCargaArray['descripcion'];
        $newTipoDeCarga->status = 'ACTIVO';
    }

    /**
     * @param TiposDeCargaCatalog $tipoDeCarga
     */
    public function updateTipoDeCarga(string $tipoDeCarga)
    {
        $tipoDeCargaArray = $this->jsonHelper->decodeJSONString($tipoDeCarga);
        $foundTipoDeCarga = $this->searchTipoDeCargaById($tipoDeCargaArray['id']);

        $foundTipoDeCarga->nombre = $tipoDeCargaArray['nombre'];
        $foundTipoDeCarga->unidadMetrica = $tipoDeCargaArray['unidadMetrica'];
        $foundTipoDeCarga->descripcion = $tipoDeCargaArray['descripcion'];

        $foundTipoDeCarga->save();

    }

    /**
     * @param TiposDeCargaCatalog $tipoDeCarga
     */
    public function deleteTipoDeCarga(TiposDeCargaCatalog $tipoDeCarga)
    {
        $foundTipoDeCarga = $this->searchTipoDeCargaById($tipoDeCarga->id);

        $foundTipoDeCarga->status = 'BORRADO';

        $foundTipoDeCarga->save();
    }

    /**
     * @param string $tipoCargaId
     * @return mixed
     */
    public function searchTipoDeCargaById(string $tipoCargaId)
    {
        return $this->tiposDeCargaModel::where('id', '=', $tipoCargaId)->get()->first();
    }
}
