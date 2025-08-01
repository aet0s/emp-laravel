<?php 
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\aaisports\Aaisports;

class ProductController extends Controller
{
    // Require authentication
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $products = Aaisports::all();

        return response()->json([
            'status' => true,
            'data' => $products,
        ]);
    }
}
