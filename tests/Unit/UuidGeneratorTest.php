<?php

namespace Tests\Unit;

use App\Traits\UuidGenerator;
use PHPUnit\Framework\TestCase;

class UuidGeneratorTest extends TestCase
{
    use UuidGenerator;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetUuid()
    {
        $uuid = $this->getUuid()->toString();
        $valid_uuid = preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/',
            $uuid);
        $this->assertEquals(1, $valid_uuid);
        $this->assertIsString($uuid);
    }
}
