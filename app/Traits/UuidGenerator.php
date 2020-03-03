<?php


namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait UuidGenerator
{

    public function getUuid()
    {
        return Uuid::uuid4();
    }
}
