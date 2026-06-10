<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DetectController extends Controller
{
    public function index()
    {
        return view('detect');
    }

    public function detect(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);
        //Mengirim dan proses file gambar ke API Flask
        $response = Http::attach(
            'image',
            file_get_contents($request->image),
            $request->image->getClientOriginalName()
        )->post('http://127.0.0.1:5000/detect');

        $data = $response->json();

        return view('detect', [
            'objects' => $data['objects'],
            'detected_image' => $data['image']
        ]);
    }
}
