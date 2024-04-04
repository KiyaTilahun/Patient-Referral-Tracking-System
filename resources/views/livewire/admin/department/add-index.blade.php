<div>
    <x-mary-toast />  

    <div class="grid grid-cols-12">
        <div class="header col-span-12 rounded-lg bord py-8">
            <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Add</span> Department   </h1>
           
        </div>

        <div  class="md:col-span-7 w-full">
            
        <form wire:submit="adddep"> 
            <label wire:ignore class="form-control w-full ">
                <div class="label">
                    <span class="label-text">Available Departments</span>

                </div>

                @php
                $newdep = [];
                foreach ($deps as $department) {
                    if (!$hospital->departments->contains($department->id)) {
                        $newdep[] = $department;
                    }
                }
                @endphp
             

             <x-mary-choices  wire:model.live="departmentlist" :options="$newdep"  />
               
            </label>
            {{-- @error('departmentlist')
            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                role="alert">
                <span class="font-medium">{{ $message }}</span>
            </div>
        @enderror --}}
            <div class="pt-4">  <x-mary-button  label="Add Departments" class="btn-accent "  badge="{{$numberchoosed}}" badge-classes="badge-warning"  type="submit" spinner="save" /></div>
        </form>
        </div>
   
        <div class="col-span-1"></div>
        <div  class="md:col-span-4">
            <p class="font-medium text-lg"> Available Departments</p>
            @foreach ($deps as $department)
                @if ($hospital->departments->contains($department->id))
                    <x-checkmark>{{ $department->name }}</x-checkmark>
                @endif
              
            @endforeach
          

         
          
       
        </div>

    </div>


    @script
    <script>
        $(document).ready(function() {
            $('#testdropdown').select2();
            $('#testdropdown').on('change', function() {
                let data = $(this).val();
                console.log(data);
                // $wire.set('companies', data, false);
                // $wire.companies = data;
                @this.companies = data;
            });
        });
    </script>
@endscript
</div>



