@extends('layouts.app')

@section('title')
  Perfil - {{ auth()->user()->name }}
@endsection

@section('content')
  <div class="md:flex md:justify-center">
    <div class="md:w-1/2 bg-white shadow p-6">
      <form action="{{ route('perfil.store', []) }}" class="mt-10 md:mt-0" method="post" enctype="multipart/form-data">
        @csrf
        @if (session('mensaje'))
          <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
        @endif
        <div class="mb-5">
          <label for="user" class="mb-2 block uppercase text-gray-500 font-bold">Nombre de usuario</label>
          <input type="text" id="user" name="user"
            class="border p-3 w-full rounded-lg @error('user') border-red-500 @enderror"
            value="{{ auth()->user()->user }}">

          @error('user')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen de perfil</label>
          <input type="file" id="imagen" name="imagen" accept=".jpg, .jpeg, .png"
            class="border p-3 w-full rounded-lg @error('imagen') border-red-500 @enderror">

          @error('imagen')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Correo</label>
          <input type="email" id="email" name="email"
            class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
            value="{{ auth()->user()->email }}">

          @error('email')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        {{-- <div class="mb-5">
          <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña actual</label>
          <input type="password" id="password" name="password" placeholder="Contraseña actual"
            class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">

          @error('password')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Nueva contraseña</label>
          <input type="password" id="password_confirmation" name="password_confirmation"
            class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror"
            placeholder="Nueva contraseña" value="{{ old('password_confirmation') }}">
          @error('password_confirmation')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div> --}}

        <button type="submit"
          class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">Guardar
          Cambios</button>
      </form>
    </div>
  </div>
@endsection
