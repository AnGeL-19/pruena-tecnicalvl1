@extends('app')

@section('content')
    <section>
        
        @if(session('success'))
            <h6 class="bg-green-300 rounded p-1 mb-2">{{session('success')}}</h6>
        @endif

        @error('name')
            <h6 class="bg-red-300 rounded">{{$message}}</h6>
        @enderror

        <div class="mb-3 flex justify-center">
            <div class="relative gap-2 w-1/2  flex flex-wrap items-stretch">
                
                <input
                type="number"
                name="search"
                id="input-search"
                class="relative m-0 block w-[1px] min-w-0 flex-auto rounded border-[1px] border-solid px-1"
                placeholder="Search"
                    />

                <button id="search-btn" class="hover:bg-slate-400 hover:rounded">
                    <span
                    class="input-group-text flex items-center whitespace-nowrap rounded px-3 py-1.5 text-center text-base font-normal text-neutral-700 dark:text-neutral-600"
                    id="basic-addon2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            class="h-5 w-5">
                            <path
                            fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                
            </div>
        </div>
            
    </section>

    <section 
        id="section-content" 
        class="bg-gray-300 w-full min-h-screen grid lg:grid-cols-2 justify-items-center grid-cols-1 gap-5 p-2 rounded ">
             
    </section>


    <div id="modal" class="fixed top-0 right-0 justify-center items-center hidden w-full h-full bg-black/40">
        <div id="modal-container" class="relative bg-white p-2 rounded shadow-md">
        </div>
    </div>


<script>

    const modal_container = document.getElementById('modal-container'); 

    function showModal(id,name,status,species,type,gender,origin,image,episodes) {
        //
        document.getElementById('modal').style.display = 'flex';
        
        const btn = document.getElementById('open-modal')
        const obj = {
            id,
            name,
            status,
            species,
            type,
            gender,
            origin,
            image,
            episodes
        }

        ModalContainer(obj)

    }

    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }

    function ModalContainer(data) {

        const { id, name, status, image, gender, species, origin, episodes, type  } = data;

        modal_container.innerHTML = `
        <div class="relative flex flex-col gap-1 w-96 p-2">
            
            <button onclick="closeModal();" class="absolute top-1 right-1 hover:bg-gray-300 hover:rounded-lg ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="black" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <form action="{{ route('favorites') }}" method="POST">
                @csrf
                <input type="hidden" name="name" value="${name}"/>
                <input type="hidden" name="status" value="${status}"/>
                <input type="hidden" name="species" value="${species}"/>
                <button class="absolute bottom-2 right-2" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                    </svg>
                </button>
            </form>
            <div class="flex flex-row gap-3">
                <div class="w-48 h-56">
                    <img src="${image}" class="w-full h-full object-cover rounded" />
                </div>
                <div class="flex flex-col">
                    <span class="font-bold inline">Name</span>
                    <p class="font-normal font-mono">${name}</p>
                    <span class="font-bold inline">Status</span>
                    <p class="font-normal font-mono">${status}</p>
                    <span class="font-bold inline">Species</span>
                    <p class="font-normal font-mono">${species}</p>
                    <span class="font-bold inline">Origin</span>
                    <p class="font-normal font-mono">${origin}</p>
                    <span class="font-bold inline">Gender</span>
                    <p class="font-normal font-mono">${gender}</p>
                    <span class="font-bold inline">Type</span>
                    <p class="font-normal font-mono">${type}</p>
                    <span class="font-bold inline">Episodes</span>
                    <p class="font-normal font-mono">${episodes}</p>
                </div>
            </div>         
        </dib>
        `
    }
  
</script>

@endsection