 <th scope="col" class="px-2 py-2" wire:click="setSortBy('{{ $name }}')">
     <button class="flex items-center">
        {{ $displayName }}
         @if ($sortBy !== $name) 
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="ml-1 w-4 h-4 size-6">
                 <path stroke-linecap="round" stroke-linejoin="round"
                     d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
             </svg>
         @elseif($sortDir === 'ASC')
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="ml-1 w-4 h-4 size-6">
                 <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
             </svg>
         @else
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="ml-1 w-4 h-4 size-6">
                 <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
             </svg>

     </button>
     @endif

 </th>
