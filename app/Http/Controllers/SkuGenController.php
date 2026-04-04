<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SkuGenController extends Controller
{
    public function __invoke(): View
    {
        return view('sku-gen');
    }
}
