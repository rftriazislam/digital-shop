<?php

namespace App\Http\Controllers\Api;

use App\Discount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function product_discount()
    {
        $data = Discount::select(['id', 'title', 'description', 'discount'])->where('status', 1)->get();

        if (count($data) > 0) {
            return response()->json(['success' => true,  'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'No data found'], 200);
        }
    }
}