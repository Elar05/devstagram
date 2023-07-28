<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user' => ['required', 'unique:users,user,' . auth()->user()->id, 'not_in:twitter,instagram,facebook,linkedin,google,youtube']
        ]);

        if ($request->imagen) {
            $imagen = $request->file('imagen');

            $nameImg = Str::uuid() . "." . $imagen->extension();

            $imageServe = Image::make($imagen);
            $imageServe->fit(1000, 1000);

            $imagePath = public_path('/perfiles') . '/' . $nameImg;
            $imageServe->save($imagePath);
        }

        // if (empty($request->password) || empty($request->password_confirmation)) {
        //     return back()->with('mensaje', 'Falta contraseña actual o la nueva contraseña');
        // }

        $usuario = User::find(auth()->user()->id);
        $usuario->user = $request->user;
        $usuario->email = $request->email;
        $usuario->imagen = $nameImg ?? auth()->user()->imagen ?? null;

        // if ($request->password && $request->password_confirmation) {
        //     if (auth()->attempt(['password' => $request->password])) {
        //         return back()->with('mensaje', 'Contraseña actual correcta');
        //     } else {
        //         return back()->with('mensaje', 'Contraseña actual incorrecta');
        //     }

        //     if ($request->password !== $request->password_confirmation) {
        //         return back()->with('mensaje', 'Las contraseñas son incorrectas');
        //     }

        //     $usuario->password = $request->password_confirmation;
        // }

        $usuario->save();

        return redirect()->route('posts.index', $usuario->user);
    }
}
