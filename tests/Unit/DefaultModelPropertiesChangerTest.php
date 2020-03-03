<?php

namespace Tests\Unit;

use App\Traits\DefaultModelPropertiesChanger;
use App\Traits\UuidGenerator;
use PHPUnit\Framework\TestCase;

class DefaultModelPropertiesChangerTest extends TestCase
{
    use DefaultModelPropertiesChanger;

    public $correctDateFormat;

    public function setUp(): void
    {
        parent::setUp();
        $this->correctDateFormat = 'Y-m-d H:i:s';

    }

    /**
     * Testing getDateFormat
     *
     * @return void
     */
    public function testDateFormatProperty()
    {
        $this->assertEquals($this->correctDateFormat, $this->getDateFormat());
    }

    /**
     * Testing getIncrementing
     */
    public function testGetIncrementing()
    {
        $this->assertFalse($this->getIncrementing());
    }

    /**
     * Test getKeyType
     */
    public function testGetKeyType()
    {
        $this->assertEquals('string', $this->getKeyType());
    }

    /**
     * Test getKeyName
     */
    public function testGetKeyName()
    {
        $this->assertEquals('uuid', $this->getKeyName());
    }
}
