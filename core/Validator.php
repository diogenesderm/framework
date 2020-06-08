<?php

namespace Core;

class Validator
{
    public static function make(array $data, array $rules)
    {
        $erros = null;
        foreach ($rules as $key => $value) {
            foreach ($data as $dataKey => $dataValue) {
                if ($key == $dataKey) {
                    $itemsValues = [];
                    if (strpos($value, "|")) {
                        $itemsValues = explode("|", $value);
                        foreach ($itemsValues as $itemValue) :
                            $subItem = [];
                            if (strpos($itemValue, ":")) {
                                $subItem = explode(":", $itemValue);
                                switch ($subItem[0]) {
                                    case 'min':
                                        if (strlen($dataValue) < $subItem[1]) {
                                            $erros["$key"] = "O campo {$key} deve ter um minimo de {$subItem[1]} caracteres";
                                        }
                                        break;
                                    case 'max':
                                        if (strlen($dataValue) > $subItem[1]) {
                                            $erros["$key"] = "O campo {$key} deve ter um maxiimo de {$subItem[1]} caracteres";
                                        }
                                        break;
                                    case 'unique':
                                       
                                        $objModel = "\\App\\Models\\" . $subItem[1];
                                        $model = new $objModel();
                                        $find = $model->where($subItem[2], $dataValue)->first();
                                        $campo = $subItem[2];
                                        if ($find->$campo) {
                                            if ($find->$subItem[3] && $find->id == $find->$subItem[3]) {
                                                break;
                                            } else {
                                                $erros["$key"] = "O campo {$key} já existe!";
                                                break;
                                            }
                                        }
                                        break;
                                }
                            } else {
                                switch ($itemValue) {
                                    case 'required':
                                        if ($dataValue == '' || empty($dataValue)) {
                                            $erros[$key] = "O campo {$key} é obrigatorio";
                                        }

                                        break;
                                    case 'email':
                                        if (!filter_var($dataValue, FILTER_VALIDATE_EMAIL)) {
                                            $erros[$key] = "O campo {$key}  não é um email valido";
                                        }
                                        break;
                                    case 'unique':
                                        
                                        $objModel = "\\App\\Models\\" . $subItem[1];
                                        $model = new $objModel;
                                        $find = $model->where($subItem[1], $dataValue)->first();
                                        if ($find->$subItem[2]) {
                                            if ($find->$subItem[3] && $find->id == $find->$subItem[3]) {
                                                break;
                                            } else {
                                                $erros["$key"] = "O campo {$key} já existe!";
                                                break;
                                            }
                                        }
                                        break;

                                    default:
                                        break;
                                }
                            }
                        endforeach;
                    } elseif (strpos($value, ":")) {
                        $items = explode(":", $value);
                        switch ($items[0]) {
                            case 'min':
                                if (strlen($dataValue) < $items[1]) {
                                    $erros["$key"] = "O campo {$key} deve ter um minimo de {$items[1]} caracteres";
                                }
                                break;
                            case 'max':
                                if (strlen($dataValue) > $items[1]) {
                                    $erros["$key"] = "O campo {$key} deve ter um maxiimo de {$items[1]} caracteres";
                                }
                                break;
                        }
                    } else {
                        switch ($value) {
                            case 'required':
                                if ($dataValue == '' || empty($dataValue)) {
                                    $erros[$key] = "O campo {$key} é obrigatorio";
                                }

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
