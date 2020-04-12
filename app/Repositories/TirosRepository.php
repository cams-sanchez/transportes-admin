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

    public function getTiroByDeliveryNumber(array $tiroToFind)
    {
        return $this->searchTiroByDelivery($tiroToFind['deliveryNumber']);
    }

    public function getTirosByDateRange(array $tirosToFind)
    {
        $startDate = date($tirosToFind['startDate'] . ' 00:00:00');
        $endDate = date($tirosToFind['endDate'] . ' 23:59:59');

        return $this->tiroModel::whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getTirosByViaje(array $tirosToFind)
    {
        return $this->tiroModel::where('viaje_id', '=', $tirosToFind['viajeId'])->get();
    }

    public function getTirosByCiudad(array $tirosToFind)
    {
        return $this->tiroModel::where('ciudad', '=', $tirosToFind['ciudad'])->get();
    }

    /**
     * @param string $tipoCargaId
     * @return mixed
     */
    protected function searchTiroById(string $tipoCargaId)
    {
        return $this->tiroModel::where('id', '=', $tipoCargaId)->get()->first();
    }

    /**
     * @param string $delivery
     * @return mixed
     */
    protected function searchTiroByDelivery(string $delivery)
    {
        return $this->tiroModel::where('delivery', '=', $delivery)->get()->first();
    }
}
