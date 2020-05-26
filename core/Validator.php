<?php

namespace Core;

class Validator
{
    public static function make(array $data, array $rules)
    {
        $errors = null;
        foreach ($rules as $key => $value) {

            if (strpos($value, ':')) {
                $items = explode(":", $value);
                foreach ($data as $dataKey => $dataValue) {
                    if ($key == $dataKey) {
                        switch ($items[0]) {
                            case 'min':
                                if (strlen($dataValue) < $items[1]) {
                                    $erros[$key] = "O campo {$key} deve ter um minimo de {$items[1]}";  
                                })
                                break;
                            case 'max':
                                if (strlen($dataValue) > $items[1]) {
                                    $erros[$key] = "O campo {$key} deve ter um maximo de {$items[1]}";  
                                })
                                break;
                        }
                    }
                }
            } else {

                foreach ($data as $dataKey => $dataValue) {
                    if ($key == $dataKey) {
                        switch ($value) {
                            case  'required':
                                if ($dataValue == '' || empty($dataValue))
                                    $erros[$key] = "O campo {$key} é obrigatorio";
                                break;
                            case 'email':
                                if (!filter_var($dataValue, FILTER_VALIDATE_EMAIL)) {
                                    $erros[$key] = "O campo {$key}  não é um email valido";
                                }
                                break;

                            default:
                                break;
                        }
                    }
                }
            }
        }

        if ($erros) {
            Session::set('message', $erros);
            Session::set('inputs', $data);
            return true;
        } else {
            Session::destroy(['message', 'inputs']);
            return false;
        }
    }
}
