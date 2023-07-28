<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file('file');

        $nameImg = Str::uuid() . "." . $imagen->extension();

        $imageServe = Image::make($imagen);
        $imageServe->fit(1000, 1000);

        $imagePath = public_path('/uploads') . '/' . $nameImg;
        $imageServe->save($imagePath);

        return response()->json(["imagen" => $nameImg]);
    }
}
