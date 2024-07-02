<?php

namespace App\Http\Controllers;

use App\Models\ProductFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDOException;

class ProductFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productfacility = ProductFacility::all();
        return view('frontend.productfacility-list', ['data' => $productfacility]);
    }
}
