<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProductController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx',
        ]);

        $file = $request->file('file');
        $filePath = $file->getRealPath();

        $this->process($filePath);

        Session::flash('success', 'Products imported successfully.');
        return redirect()->back();
    }

    private function process($filePath): void
    {
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        foreach ($rows as $index => $row) {
            if ($index < 3) {
                continue;
            }

            $vendor_product_id = $row[1];
            $ean = $row[2];
            $model = $row[3];
            $warranty = $row[4];
            $handling_time = $row[5];
            $name = $row[6];
            $brand = $row[7];
            $category_name = $row[8];
            $subcategory_name = $row[9];
            $childcategory_name = $row[10];
            $sale_price = $row[11];
            $original_sale_price = $row[12];
            $vat_rate = $row[13];
            $stock_quantity = $row[14];
            $status = $row[15];

            $category = Category::firstOrCreate(['category_name' => $category_name]);
            $subcategory = Subcategory::firstOrCreate([
                'subcategory_name' => $subcategory_name,
                'category_id' => $category->id,
            ]);
            $childcategory = Childcategory::firstOrCreate([
                'childcategory_name' => $childcategory_name,
                'subcategory_id' => $subcategory->id,
            ]);

            Product::create([
                'vendor_product_id' => $vendor_product_id,
                'ean' => $ean,
                'model' => $model,
                'warranty' => $warranty,
                'handling_time' => $handling_time,
                'name' => $name,
                'brand' => $brand,
                'cat_id' => $category->id,
                'subcat_id' => $subcategory->id,
                'childcat_id' => $childcategory->id,
                'sale_price' => $sale_price,
                'original_sale_price' => $original_sale_price,
                'vat_rate' => $vat_rate,
                'stock' => $stock_quantity,
                'status' => $status,
            ]);
        }
    }
}
