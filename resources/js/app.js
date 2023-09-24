import './bootstrap';
import axios from 'axios';

const baseUrl = 'https://rickandmortyapi.com/api/'

const button = document.getElementById('search-btn')
const section = document.getElementById('section-content')
const search = document.getElementById('input-search')

button.addEventListener("click", async (event) => {
    event.preventDefault()

    const value = search.value;
    
   
    try {
        Loading() 

        if (!value) return Alert('Error Input!', 'Input empty','warning') 
        
        const data = await fetchData('location',value.trim())
        
        ChangeBackgroundColor(value)

        if (!data) return Alert('Error!', 'Location is not found','warning') 
        
        

        const residents = data.residents.slice(0,5);
    
        const characters = await getCharacters(residents)

        Loaded()
        if (characters.length === 0) return Alert('Data', 'Not data', 'not-data')
     
        characters.sort((a, b) => a.name - b.name).forEach( character => {
            Characters(character)
        })
    } catch (error) {
        Alert('Error fetching!', 'Something not ideal might be happening.','warning')
    }
   
    
});

function ChangeBackgroundColor(id) {
    if (id < 50) {
        section.style.backgroundColor = 'rgb(134,239,172)'
    }else if(id > 50 && id < 80) { 
        section.style.backgroundColor = 'rgb(147,197,253)' 
    }else if ( id > 80) {
        section.style.backgroundColor  = 'rgb(252,165,165)'
    }
}

function Characters(data){
    
    
    const { id, name, status, image, gender, species, origin, episode, type,   } = data;


    section.innerHTML += `
            <article class="relative w-[450px] h-80 p-2 bg-white/70 rounded hover:cursor-pointer shadow-md">
                <button id="open-modal" class="abosolute top-0 left-0 w-full h-full flex flex-col gap-1" onclick="showModal(${id},'${name}','${status}','${species}','${type ? type:'none'}','${gender}','${origin.name}','${image}',${episode.length})">
                    <div class="flex flex-row gap-3">
                        <div class="w-48 h-56">
                            <img src="${image}" class="w-full h-full object-cover rounded" />
                        </div>
                        <div class="flex flex-col justify-start items-start">
                            <span class="font-bold inline">Name</span>
                            <p class="font-normal font-mono">${name}</p>
                            <span class="font-bold inline">Status</span>
                            <p class="font-normal font-mono">${status}</p>
                            <span class="font-bold inline">Species</span>
                            <p class="font-normal font-mono">${species}</p>
                            <span class="font-bold inline">Origin</span>
                            <p class="font-normal font-mono">${origin.name}</p>
                        </div>
                    </div>
                    <div class="w-full flex justify-start">
                        <ul>
                            <li>
                                ${episode[0] ? `<a href="${episode[0]}" target="_blank" class="text-cyan-400 hover:underline">${episode[0]}</a>`:''}
                            </li>
                            <li>
                                ${episode[1] ? `<a href="${episode[1]}" target="_blank" class="text-cyan-400 hover:underline">${episode[1]}</a>`:''}
                            </li>
                            <li>
                                ${episode[2] ? `<a href="${episode[2]}" target="_blank" class="text-cyan-400 hover:underline">${episode[2]}</a>`:''}
                            </li>
                        </ul>
                    </div>
                  </button>
               
            </article>
            `
}

function Loading() {
    return section.innerHTML = `
    <div
    class="absolute inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
    role="status">
    <span
        class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
        >Loading...</span
    >
    </div>
    `
}

function Loaded() {
    return section.innerHTML = ''
}

function Alert(title,message,status) {
    
    let colors = {
        containerTitle: '',
        containerMessage: ''
    };
    if (status === 'success') {
        colors = {
            containerTitle: 'bg-green-500',
            containerMessage: 'border-green-400 bg-green-100 text-green-700'
        }
    }else if (status === 'warning') {
        colors = {
            containerTitle: 'bg-red-500',
            containerMessage: 'border-red-400 bg-red-100 text-red-700'
        }
    }else if (status === 'not-data') {
        colors = {
            containerTitle: 'bg-gray-500',
            containerMessage: 'border-gray-500 bg-gray-100 text-gray-700'
        }
    }
    
    return section.innerHTML = `
    <div role="alert" class="absolute">
        <div class="${colors.containerTitle} text-white font-bold rounded-t px-4 py-2">
            ${title}
        </div>
        <div class="border border-t-0 rounded-b px-4 py-3 ${colors.containerMessage}">
            <p>${message}</p>
        </div>
    </div>
    `
}

async function getCharacters(residents) {
    const respCharacters = residents.map( async (resident) => {
        const { query, id } = getQueryAndId(resident)
        const resp = await fetchData(query, id)
        return resp;
    })

    const characters = await Promise.all(respCharacters)

    return characters
}

function getQueryAndId(url) {

    const splitQuery = url.split('/');
    const query = splitQuery[splitQuery.length - 2];
    const id = splitQuery[splitQuery.length - 1];

    return {query, id};

}

async function fetchData(query, id) {

    try {
        const resp = await axios.get(`${baseUrl}/${query}/${id}`)
        const data = resp.data;
        return data;
    } catch (error) {
        console.log('Error',error);
        return null;
    }
    

}
