<?php


namespace App\Repositories;

use App\Helpers\JsonHelper;
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
     * @var JsonHelper
     */
    protected $jsonHelper;

    /**
     * TirosRepository constructor.
     * @param Tiro $tiroModel
     * @param JsonHelper $jsonHelper
     */
    public function __construct(Tiro $tiroModel, JsonHelper $jsonHelper)
    {
        $this->tiroModel = $tiroModel;
        $this->jsonHelper = $jsonHelper;
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
}
