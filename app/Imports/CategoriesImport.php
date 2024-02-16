<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use function App\Helpers\validateHeaders;

class CategoriesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row) {
        validateHeaders($row, ["category_name"]);
        try {
            Category::updateOrCreate(
                ['name' => $row["category_name"]],
            );
        } catch (\Exception $e) {
            throw new \Exception('Error updating or creating category: ' . $e->getMessage());
        }
    }
}
