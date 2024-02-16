<?php

namespace App\Imports;

use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use function App\Helpers\validateHeaders;

class VendorsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {      
        validateHeaders($row, ["vendor_name"]);
        try{
            Vendor::updateOrCreate (
                ['name' => $row["vendor_name"]]
            );
        } catch (\Exception $e) {
            throw new \Exception('Error updating or creating vendor: ' . $e->getMessage());
        }
    }
}
