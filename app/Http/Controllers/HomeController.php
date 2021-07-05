<?php

namespace App\Http\Controllers;

use Com\Tecnick\Barcode\Barcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $files = $user->files;
        $filesArray = Array();

        foreach($files as $file) {

            $barcode = new Barcode();
            $url = URL::to($file->link);
            $qrObj = $barcode->getBarcodeObj('QRCODE,H', $url,-6,-6, 'black', array(-2, -2, -2, -2))->setBackgroundColor('white');

            $filesArray[] = [
                "name" => $file->name,
                "link" => $file->link,
                "full_url" => $url,
                "qr" => $qrObj,
                "downloads" => $file->downloads
            ];

        }
        return view('personal.disk', compact('filesArray', 'user'));
    }


}
