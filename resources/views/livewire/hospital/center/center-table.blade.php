{{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
             
                <th scope="col" class="px-6 py-3">
                   Health center name
                </th>
                <th scope="col" class="px-6 py-3">
                    Region
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
               
               
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only"></span>
                </th>
            </tr>
        </thead>
        <tbody>
          @foreach ($centers as $center)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" wire:key="{{$center->id}}" wire:click='show({{$center->id}})'>
                
                <td class="px-6 py-4">
                  {{$center->name}}
                </td>
                <td class="px-6 py-4">
                    {{$center->region->name}}
               
                </td>
                <td class="px-6 py-4">
                    @if($center->status==1)
                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">Active</span>
                  
                    @endif
                  </td>

                
                 <td class="px-6 py-4"  >
                  <div class="flex gap-8"><svg class="w-6 h-6 text-gray-800 dark:text-white hover:dark:text-[#059669]  hover:text-[#059669]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                  </svg>
                  
                  <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                  </svg></div>
                </td>
              </tr>
              @endforeach
            
              
        </tbody>
       <tfoot>
    
        </tfoot> 
    </table>
    {{ $centers->links() }}  
  </div>
  
   --}}




   <div>
  
    <x-mary-header title="Centers" subtitle="Search centers">
      <x-slot:middle class="!justify-end">
          <x-mary-input icon="o-magnifying-glass" class="border-green-500 focus:border-green-500" wire:model.live='search' placeholder="Search..." />
      </x-slot:middle>
    
          

         
  </x-mary-header>

    <x-mary-table :headers="$headers" :rows="$centers" :sort-by="$sortBy" with-pagination >

    @scope('cell_status', $center)
    <x-mary-badge :value="($center->status==1)?'Active':'Inactive'" class="{{$center->status ? 'btn-outline btn-success btn-disabled':'btn-outline btn-warning btn-disabled'}}" />
    @endscope
    @scope('actions', $center)
    <x-mary-button icon="c-pencil-square" class="text-green-500 btn-sm" wire:click="show({{ $center->id }})" spinner  />
@endscope
    </x-mary-table>
   </div>