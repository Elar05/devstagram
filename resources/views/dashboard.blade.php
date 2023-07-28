@extends('layouts.app')

@section('title')
  Perfil: {{ $user->user }}
@endsection

@section('content')
  <div class="flex justify-center">
    <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col md:flex-row items-center">
      <div class="w-8/12 lg:w-6/12 px-5">
        <img src="{{ $user->imagen ? asset('perfiles/' . $user->imagen) : asset('img/usuario.svg') }}" alt="Usuario">
      </div>

      <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start md:justify-center py-10 md:py-10">
        <div class="flex items-center gap-2 mb-3">
          <p class="text-gray-700 text-2xl">{{ $user->user }}</p>

          @auth
            @if ($user->id === auth()->user()->id)
              <a href="{{ route('perfil.index') }}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
              </a>
            @endif
          @endauth
        </div>

        <p class="text-gray-800 text-sm mb-3 font-bold">
          {{ $user->followers->count() }} <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count())</span>
        </p>
        <p class="text-gray-800 text-sm mb-3 font-bold">
          {{ $user->followings->count() }} <span class="font-normal">Siguiendo</span>
        </p>
        <p class="text-gray-800 text-sm mb-3 font-bold">
          {{ $user->posts->count() }} <span class="font-normal">Posts</span>
        </p>

        @auth
          @if ($user->id !== auth()->user()->id)
            @if ($user->following(auth()->user()))
              <form action="{{ route('users.unfollow', $user) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="bg-red-500 text-white uppercase rounded-lg px-3 py-1 text-sm font-bold cursor-pointer">Dejar de
                  seguir</button>
              </form>
            @else
              <form action="{{ route('users.follow', $user) }}" method="post">
                @csrf
                <button type="submit"
                  class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-sm font-bold cursor-pointer">Seguir</button>
              </form>
            @endif
          @endif
        @endauth
      </div>
    </div>
  </div>

  <section class="container mx-auto mt-10">
    <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
    <x-listar-post :posts="$posts" />
  </section>
@endsection
