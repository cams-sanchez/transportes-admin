<?php

namespace App\Validators;

use App\Constants\ValidationRulesConstants;

class ValidationRules
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @param string $rulesToValidate
     * @param string $from
     * @return array
     */
    public function getRules(string $rulesToValidate = 'new', string $from = 'tiposDeCarga'): array
    {
        $rules = $this->getConstantRules($from);
        if (!empty($rules)) {
            return $rules[$rulesToValidate];
        }
    }

    protected function getConstantRules(string $from)
    {
        $constant = [];

        switch ($from) {
            case 'tiposDeCarga':
                $constant = ValidationRulesConstants::TIPOS_DE_CARGA_RULES;
                break;
            case 'tiro':
                $constant = ValidationRulesConstants::TIROS_RULES;
                break;
            case 'temporada':
                $constant = ValidationRulesConstants::TEMPORADAS_RULES;
                break;
        }

        return $constant;
    }

}
