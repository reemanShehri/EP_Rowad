<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

     public function index()
    {
        $entrepreneurServices = Service::forEntrepreneurs()->get();
        $consultantServices = Service::forConsultants()->get();

        return view('services.index', compact('entrepreneurServices', 'consultantServices'));
    }
    //
}
