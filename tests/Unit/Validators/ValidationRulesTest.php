<?php

namespace Test\Unit\Validators;

use App\Validators\ValidationRules;
use PHPUnit\Framework\TestCase;
use App\Constants\ValidationRulesConstants;

class ValidationRulesTest extends TestCase
{

    public ValidationRules $validator;


    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new ValidationRules;
    }

    public function testGetRulesForTiposDeCargaWithNew()
    {
        $actionToGet = 'new';
        $validationRule = $this->validator->getRules($actionToGet,'tiposDeCarga');
        $expectedRule = ValidationRulesConstants::TIPOS_DE_CARGA_RULES[$actionToGet];
        $this->assertSame($expectedRule['nombre'], $validationRule['nombre']);
        $this->assertSame($expectedRule['unidadMetrica'], $validationRule['unidadMetrica']);
    }

    public function testGetRulesForTiposDeCargaWithEdit()
    {
        $actionToGet = 'edit';
        $validationRule = $this->validator->getRules($actionToGet,'tiposDeCarga');
        $expectedRule = ValidationRulesConstants::TIPOS_DE_CARGA_RULES[$actionToGet];
        $this->assertSame($expectedRule['id'], $validationRule['id']);
        $this->assertSame($expectedRule['nombre'], $validationRule['nombre']);
        $this->assertSame($expectedRule['unidadMetrica'], $validationRule['unidadMetrica']);
    }

    public function testGetRulesForTiposDeCargaWithDelete()
    {
        $actionToGet = 'delete';
        $validationRule = $this->validator->getRules($actionToGet,'tiposDeCarga');
        $expectedRule = ValidationRulesConstants::TIPOS_DE_CARGA_RULES[$actionToGet];
        $this->assertSame($expectedRule['id'], $validationRule['id']);
    }

    public function testGetRulesForTirosWithDelete()
    {
        $actionToGet = 'delete';
        $validationRule = $this->validator->getRules($actionToGet,'tiro');
        $expectedRule = ValidationRulesConstants::TIROS_RULES[$actionToGet];
        $this->assertSame($expectedRule['id'], $validationRule['id']);
    }

    public function testGetRulesForTirosWithUpload()
    {
        $actionToGet = 'upload';
        $validationRule = $this->validator->getRules($actionToGet,'tiro');
        $expectedRule = ValidationRulesConstants::TIROS_RULES[$actionToGet];
        $this->assertSame($expectedRule['id'], $validationRule['id']);
        $this->assertSame($expectedRule['delivery'], $validationRule['delivery']);
        $this->assertSame($expectedRule['establecimiento'], $validationRule['establecimiento']);
    }

    public function testGetRulesForTirosWithUploadExcel()
    {
        $actionToGet = 'uploadExcel';
        $validationRule = $this->validator->getRules($actionToGet,'tiro');
        $expectedRule = ValidationRulesConstants::TIROS_RULES[$actionToGet];
        $this->assertSame($expectedRule['excelFile'], $validationRule['excelFile']);
        $this->assertSame($expectedRule['zonaRepublica'], $validationRule['zonaRepublica']);
    }

    public function testGetRulesForTirosWithSearchByDelivery()
    {
        $actionToGet = 'searchByDelivery';
        $validationRule = $this->validator->getRules($actionToGet,'tiro');
        $expectedRule = ValidationRulesConstants::TIROS_RULES[$actionToGet];
        $this->assertSame($expectedRule['deliveryNumber'], $validationRule['deliveryNumber']);
    }

    public function testGetRulesForTemporadaWithDelete()
    {
        $actionToGet = 'delete';
        $validationRule = $this->validator->getRules($actionToGet,'temporada');
        $expectedRule = ValidationRulesConstants::TEMPORADAS_RULES[$actionToGet];
        $this->assertSame($expectedRule['id'], $validationRule['id']);
    }

    public function testGetRulesForTemporadaWithUpdate()
    {
        $actionToGet = 'update';
        $validationRule = $this->validator->getRules($actionToGet,'temporada');
        $expectedRule = ValidationRulesConstants::TEMPORADAS_RULES[$actionToGet];
        $this->assertSame($expectedRule['id'], $validationRule['id']);
        $this->assertSame($expectedRule['nombre'], $validationRule['nombre']);
    }

    public function testGetRulesForTemporadaWithCreate()
    {
        $actionToGet = 'create';
        $validationRule = $this->validator->getRules($actionToGet,'temporada');
        $expectedRule = ValidationRulesConstants::TEMPORADAS_RULES[$actionToGet];
        $this->assertSame($expectedRule['nombre'], $validationRule['nombre']);
    }


}
