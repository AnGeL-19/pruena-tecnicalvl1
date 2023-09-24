@extends('app')

@section('content')
    
    <h2 class="text-3xl font-bold text-slate-700 mb-5">Saved Characters</h2>

    @if(session('success'))
            <h6 class="bg-green-300 rounded p-1">{{session('success')}}</h6>
    @endif

    <section class="w-full flex flex-row flex-wrap gap-3">
        @foreach ($characters as $character)
            <article class="relative p-3 w-40 h-50 bg-green-200 rounded shadow-md">
                  
                <div class="flex flex-col gap-2 justify-start items-start ">
                    <div>
                        <span class="font-bold inline">Name</span>
                        <p class="font-norma font-monol">{{$character->name}}</p>
                    </div>
                    <div>
                        <span class="font-bold inline">Status</span>
                        <p class="font-normal font-mono">{{$character->status}}</p>
                    </div>
                    <div>
                        <span class="font-bold inline">Species</span>
                        <p class="font-normal font-mono">{{$character->species}}</p>
                    </div>
                </div>
                <form action="{{ route('character-destroy', [$character->id]) }}" class="flex justify-end" method="POST" >
                        @method('DELETE')
                        @csrf
                        <button class="flex justify-center items-center" type="submit">
                            <span class="font-bold text-red-400">Quit</span> 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="rgb(248,113,113)" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                            </svg>
                            
                        </button>
                </form>
            </article>
            
        @endforeach
    </section>

   
@endsection