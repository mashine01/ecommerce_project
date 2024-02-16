<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use function App\Helpers\validateHeaders;
use function App\Helpers\verifyDataExists;

class BrandsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {  
        validateHeaders($row, ["brand_name", "vendor_name"]);
        $vendor = verifyDataExists(Vendor::class, "name", $row["vendor_name"]);
        try{
            Brand::updateOrCreate (
                ['name' => $row["brand_name"]],
                [
                    'vendor_id' => $vendor->id
                ],
            );
        } catch (\Exception $e) {
            throw new \Exception('Error updating or creating brand: ' . $e->getMessage());
        }
    }
}