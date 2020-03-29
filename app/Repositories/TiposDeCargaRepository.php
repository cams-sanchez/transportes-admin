<?php


namespace App\Repositories;

use App\Helpers\JsonHelper;
use App\Models\TiposDeCargaCatalog;
use App\Constants\StatusConstants;

/**
 * Class TiposDeCargaRepository
 * @package App\Repositories
 */
class TiposDeCargaRepository
{
    /** @var TiposDeCargaCatalog $tiposDeCargaModel */
    protected $tiposDeCargaModel;

    /**
     * TiposDeCargaRepository constructor.
     * @param TiposDeCargaCatalog $tiposDeCargaModel
     */
    public function __construct(TiposDeCargaCatalog $tiposDeCargaModel)
    {
        $this->tiposDeCargaModel = $tiposDeCargaModel;
    }

    /**
     * @return mixed
     */
    public function getAllTiposDeCarga()
    {
        return $this->tiposDeCargaModel::where('status', '=', StatusConstants::ACTIVE_STATUS)->get();
    }

    /** @param array $tipoDeCarga
     * @return TiposDeCargaCatalog
     */
    public function newTipoDeCarga(array $tipoDeCarga)
    {

        $newTipoDeCarga = new TiposDeCargaCatalog();

        $newTipoDeCarga->nombre = $tipoDeCarga['nombre'];
        $newTipoDeCarga->unidadMetrica = $tipoDeCarga['unidadMetrica'];
        $newTipoDeCarga->descripcion = $tipoDeCarga['descripcion'];
        $newTipoDeCarga->status = StatusConstants::ACTIVE_STATUS;

        $newTipoDeCarga->save();

        return $newTipoDeCarga;
    }

    /**
     * @param array $tipoDeCarga
     * @return TiposDeCargaCatalog
     */
    public function updateTipoDeCarga(array $tipoDeCarga): TiposDeCargaCatalog
    {
        $foundTipoDeCarga = $this->searchTipoDeCargaById($tipoDeCarga['id']);

        $foundTipoDeCarga->nombre = $tipoDeCarga['nombre'];
        $foundTipoDeCarga->unidadMetrica = $tipoDeCarga['unidadMetrica'];
        $foundTipoDeCarga->descripcion = $tipoDeCarga['descripcion'];

        $foundTipoDeCarga->save();

        return $foundTipoDeCarga;

    }

    /**
     * @param array $tipoDeCarga
     * @return TiposDeCargaCatalog
     */
    public function deleteTipoDeCarga(array $tipoDeCarga): TiposDeCargaCatalog
    {
        $foundTipoDeCarga = $this->searchTipoDeCargaById($tipoDeCarga['id']);

        $foundTipoDeCarga->status = StatusConstants::DELETE_STATUS;

        $foundTipoDeCarga->save();

        return $foundTipoDeCarga;
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
