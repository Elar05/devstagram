@extends('layouts.app')

@section('title')
  Crea tu cuenta
@endsection

@section('content')
  <div class="md:flex md:justify-center md:gap-5 md:items-center">
    <div class="md:w-6/12 p-5">
      <img src="{{ asset('img/registrar.jpg') }}" alt="Registrar">
    </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
      <form action="{{ route('register', []) }}" method="POST" novalidate>
        @csrf
        <div class="mb-5">
          <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
          <input type="text" id="name" name="name"
            class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" placeholder="Ingresa tu nombre"
            value="{{ old('name') }}">
          @error('name')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="user" class="mb-2 block uppercase text-gray-500 font-bold">User</label>
          <input type="text" id="user" name="user"
            class="border p-3 w-full rounded-lg @error('user') border-red-500 @enderror" placeholder="Ingresa tu usuario"
            value="{{ old('user') }}">
          @error('user')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

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
          <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Confirma tu
            Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation"
            class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror"
            placeholder="Confirma tu contraseña" value="{{ old('password_confirmation') }}">
          @error('password_confirmation')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <button type="submit"
          class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">Crear
          Cuenta</button>
      </form>
    </div>
  </div>
@endsection
