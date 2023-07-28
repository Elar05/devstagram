@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('title')
  Crea una nueva Publicación
@endsection

@section('content')
  <div class="md:flex md:items-center px-10">
    <div class="md:w-1/2 px-10">
      <form action="{{ route('imagenes.store', []) }}" method="post" id="dropzone"
        class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center"
        enctype="multipart/form-data">
        @csrf
      </form>
    </div>

    <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
      <form action="{{ route('posts.store', []) }}" method="POST" novalidate>
        @csrf
        @if (session('mensaje'))
          <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
        @endif
        <div class="mb-5">
          <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Titulo</label>
          <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" placeholder="Titulo"
            class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror">
          @error('titulo')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="description" class="mb-2 block uppercase text-gray-500 font-bold">
            Descripción
          </label>
          <textarea id="description" name="description" placeholder="Descripción"
            class="border p-3 w-full rounded-lg @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
          @error('description')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-5">
          <input name="imagen" type="hidden" value="{{ old('imagen') }}">
          @error('imagen')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
              {{ $message }}
            </p>
          @enderror
        </div>

        <button type="submit"
          class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
          Publicar
        </button>
      </form>
    </div>
  </div>
@endsection
