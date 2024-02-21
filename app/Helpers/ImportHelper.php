<?php
namespace App\Helpers;

function validateHeaders(array $row, array $expectedHeaders) {
    $missingHeaders = array_diff($expectedHeaders, array_keys($row));
    if ($missingHeaders || count($row) != count($expectedHeaders)){
        throw new \Exception('Invalid columns. Missing or Additional header(s)');
    }
}

function verifyDataExists($model, $column, $value) {
    $result = $model::where($column, $value)->first();
    if (!$result) {
        throw new \Exception('Vendor does not exist: ' . $value);
    } else{
        return $result;
    }
}

?>