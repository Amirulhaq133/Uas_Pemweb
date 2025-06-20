<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Wajib login untuk semua method
    }
    
    // Method lainnya...
}