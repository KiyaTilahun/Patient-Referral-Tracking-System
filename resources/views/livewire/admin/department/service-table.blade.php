<div class="col-span-12 rounded-lg  shadow-md sm:col-span-5 ">


    <div class="flex justify-between">

    <span class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500  dark:text-gray-400">
      <span class="mb-4 text-lg font-extrabold leading-none tracking-tight text-gray-900 md:text-lg dark:text-white">department services
            </span> </span>
            <div>
           
    </div>
        </div>

            <div class="sm:max-h-[50vh] overflow-y-auto">
    <x-mary-toast />  
    <x-mary-toast />  

    @if (!is_null($editable))
   
        <form wire:submit="servicesubmit">
       

            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Department name</span>

                </div>
                <input type="text" placeholder="{{ $editable['name'] }}" class="input input-bordered w-full max-w-xs"
                    disabled />
            </label>

            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Available Services</span>

                </div>

                <select class="select select-bordered w-full max-w-xs">
                    
                    @foreach ($departmentservice as $service)
                    <option class="text-warning">{{$service->departmentService->service->name}}</option>
                    @endforeach

                  </select>
               
              
                   
            
            </label>


<div class="flex flex-col justify-end mr-4 mt-4 mb-4">  
       @if ($updatebutton)
    <x-mary-button label="Update Department"  icon="c-pencil-square" class="btn-warning"  type="submit" spinner/>
    @error('depser')
    <div class="px-2 mr-4 mt-4 mb-4 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600 w-full"
        role="alert">
        <span class="font-medium">{{ $message }}</span>
    </div>
@enderror
    @else
    <x-mary-button label="Edit User"  icon="c-pencil-square" disabled />
@endif</div>
            <div class="flex flex-col overflow-auto space-x-5 whitespace-nowrap items-start ">
                @foreach ($alldepser as $ser)
                    <x-mary-checkbox 
                        label="{{ $ser->service->name }}" 
                        wire:model.live="depser" 
                        class="checkbox-warning pb-4 mb-2" 
                        value="{{ $ser->id }}" 
                        omit-error 
                    />
                @endforeach
            </div>
            @error('depdays')
                <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600" role="alert">
                    <span class="font-medium">{{ $message }}</span>
                </div>
            @enderror 
          
        </form>
    @else
        <label class="form-control w-full max-w-xs">
            <div class="label">
                <span class="label-text">Department name</span>

            </div>
            <input type="text" placeholder="Department Name" class="input input-bordered w-full max-w-xs" disabled />
        </label>

        <label class="form-control w-full max-w-xs">
            <div class="label">
                <span class="label-text">Available Services</span>

            </div>

            <select class="select select-bordered w-full max-w-xs" disabled>
                
                
                <option class="text-warning"></option>
              

              </select>
           
          
               
        
        </label>
     
        {{-- <div class="grid grid-cols-3 gap-5">
            @foreach ($days as $day)
                <x-mary-checkbox label="{{ $day->name }}" wire:model="depdays" disabled />
            @endforeach
        </div> --}}
    @endif
</div>