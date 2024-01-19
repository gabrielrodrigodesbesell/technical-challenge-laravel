<?php

if (!function_exists('CPF2Mask')) {
    function CPF2Mask($cpf) {
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }
}
if (!function_exists('CEP2Mask')) {
    function CEP2Mask($cep) {
        return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
    }
}

