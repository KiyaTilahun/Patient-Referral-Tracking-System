{{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
           
              <th scope="col" class="px-6 py-3">
                 Health center name
              </th>
              <th scope="col" class="px-6 py-3">
                  Registry Date
              </th>
             
             
              <th scope="col" class="px-6 py-3">
                  <span class="sr-only"></span>
              </th>
          </tr>
      </thead>
      <tbody>
        @foreach ($pendings as $pending)
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 hover:cursor-pointer" wire:key="{{$pending->id}}" wire:click='show({{$pending->id}})'>
              
              <td class="px-6 py-4">
                {{$pending->name}}
              </td>
              <td class="px-6 py-4">
                {{$pending->created_at->format('m/d/Y')}}
              </td>
              
               <td class="px-6 py-4"  >
                <div class="flex gap-8"><svg class="w-6 h-6 text-gray-800 dark:text-white hover:dark:text-[#059669]  hover:text-[#059669]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                  <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>
                
                </div>
              </td>
            </tr>
            @endforeach
          
            
      </tbody>
     <tfoot>
  
      </tfoot> 
  </table>
  {{ $pendings->links() }}  
</div> --}}


<div>
  
  <x-mary-header title="Centers" subtitle="Search centers">
    <x-slot:middle class="!justify-end">
        <x-mary-input icon="o-magnifying-glass" class="border-green-500 focus:border-green-500" wire:model.live='search' placeholder="Search..." />
    </x-slot:middle>
  
        

       
</x-mary-header>

  <x-mary-table :headers="$headers" :rows="$pendings" :sort-by="$sortBy" with-pagination >

  @scope('cell_status', $pending)
  <x-mary-badge :value="($pending->status==1)?'Active':'Inactive'" class="{{$pending->status ? 'btn-outline btn-success btn-disabled':'btn-outline btn-warning btn-disabled'}}" />
  @endscope
  @scope('actions', $pending)
  <x-mary-button icon="c-pencil-square" class="text-green-500 btn-sm" wire:click="show({{ $pending->id }})" spinner  />
@endscope
  </x-mary-table>
 </div>
