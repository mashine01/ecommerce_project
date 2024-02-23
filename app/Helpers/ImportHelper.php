<?php
namespace App\Helpers;

function validateHeaders(array $row, array $expectedHeaders) {
    $missingHeaders = array_diff($expectedHeaders, array_keys($row));
    $additionalHeaders = array_diff(array_keys($row), $expectedHeaders);
    if ($missingHeaders || count($row) != count($expectedHeaders)){
        $errorMessage = 'Invalid columns. ';
        if (!empty($missingHeaders)) {
            $errorMessage .= 'Missing header(s): ' . implode(', ', $missingHeaders) . '. ';
        }
        if (!empty($additionalHeaders)) {
            $errorMessage .= 'Additional header(s): ' . implode(', ', $additionalHeaders) . '.';
        }
        throw new \Exception($errorMessage);
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