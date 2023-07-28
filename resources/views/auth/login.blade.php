@extends('layouts.app')

@section('title')
  Login
@endsection

@section('content')
  <div class="md:flex md:justify-center md:gap-5 md:items-center">
    <div class="md:w-6/12 p-5">
      <img src="{{ asset('img/login.jpg') }}" alt="Login">
    </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
      <form action="{{ route('login', []) }}" method="POST" novalidate>
        @csrf
        @if (session('mensaje'))
          <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
        @endif
        <div class="mb-5">
          <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
          <input type="email" id="email" name="email"
            class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" placeholder="Ingresa tu correo"
            value="{{ old('email') }}">
          @error('email')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
          <input type="password" id="password" name="password"
            class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
            placeholder="Ingresa tu contraseña" value="{{ old('password') }}">
          @error('password')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <input type="checkbox" name="remember" id="remember">
          <label for="remember" class="text-gray-500 text-sm">Mantener mi sesión</label>
        </div>

        <button type="submit"
          class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">Iniciar</button>
      </form>
    </div>
  </div>
@endsection
