@extends('layouts.app')

@section('title')
  {{ $post->titulo }}
@endsection

@section('content')
  <div class="container mx-auto flex">
    <div class="md:w-1/2">
      <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="" srcset="">

      <livewire:like-post :post="$post"></livewire:like-post>

      <div>
        <p class="font-bold">{{ $post->user->user }}</p>
        <p class="text-sm text-gray-500">
          {{ $post->created_at->diffForHumans() }}
        </p>
        <div class="mt-5">{{ $post->description }}</div>
      </div>

      @auth
        @if ($post->user_id === auth()->user()->id)
          <form action="{{ route('posts.destroy', $post) }}" method="post">
            @method('DELETE')
            @csrf
            <button class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-5" type="submit">Eliminar
              Publicación</button>
          </form>
        @endif
      @endauth
    </div>

    <div class="md:w-1/2 p-5">
      <div class="shadow bg-white p-5 mb-5">
        @auth
          <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

          @if (session('mensaje'))
            <div class="bg-green-500 p-2 rounded mb-6 text-white uppercase font-bold text-center">{{ session('mensaje') }}
            </div>
          @endif
          <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="post">
            @csrf
            <div class="mb-5">
              <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                Comentario
              </label>
              <textarea id="comentario" name="comentario" placeholder="Comentario"
                class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"></textarea>
              @error('comentario')
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
        @endauth

        <div class="bg-white shadow m-5 max-h-96 overflow-y-scroll">
          @if ($post->comentarios->count() > 0)
            @foreach ($post->comentarios as $comentario)
              <div class="p-5 border-gray-300 border-b">
                <a href="{{ route('posts.index', $comentario->user) }}"
                  class="font-bold">{{ $comentario->user->user }}</a>
                <p>{{ $comentario->comentario }}</p>
                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
              </div>
            @endforeach
          @else
            <p class="p-10 text-center">No hay comentarios</p>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
