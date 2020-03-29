<?php


namespace App\Repositories;


use App\Models\JefeDeSector;


class JefeDeSectorRepository
{

    /** @var JefeDeSector $jefeDeSectorCatalog */
    protected $jefeDeSectorCatalog;


    /**
     * JefeDeSector constructor.
     * @param JefeDeSector $jefeDeSectorCatalog
     */
    public function __construct(JefeDeSector $jefeDeSectorCatalog)
    {
        $this->jefeDeSectorCatalog = $jefeDeSectorCatalog;
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function getjefeDeSectorById(string $id)
    {
        return $this->jefeDeSectorCatalog::where('id', '=', $id)->get()->first();
    }

    /**
     * @param string $jefeDeSector
     * @return mixed
     */
    public function getjefeDeSectorByName(string $jefeDeSector)
    {
        return $this->jefeDeSectorCatalog::where('nombre', '=', $jefeDeSector)->get()->first();
    }
}
