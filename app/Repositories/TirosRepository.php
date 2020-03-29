<?php


namespace App\Repositories;


use App\Models\Tiro;
use App\Constants\StatusConstants;

/**
 * Class TirosRepository
 * @package App\Repositories
 */
class TirosRepository
{
    /** @var Tiro $tiroModel */
    protected $tiroModel;


    /**
     * TirosRepository constructor.
     * @param Tiro $tiroModel
     */
    public function __construct(Tiro $tiroModel)
    {
        $this->tiroModel = $tiroModel;
    }

    /**
     * @return mixed
     */
    public function getAllTiros()
    {
        return $this->tiroModel::where('status', '=', StatusConstants::ACTIVE_STATUS)->get();
    }


    public function getTiroById(array $tiro)
    {
        return $this->searchTiroById($tiro['id']);
    }


    /**
     * @param string $tipoCargaId
     * @return mixed
     */
    public function searchTiroById(string $tipoCargaId)
    {
        return $this->tiroModel::where('id', '=', $tipoCargaId)->get()->first();
    }

    /**
     * @param string $delivery
     * @return mixed
     */
    public function searchTiroBydelivery(string $delivery)
    {
        return $this->tiroModel::where('delivery', '=', $delivery)->get()->first();
    }
}
