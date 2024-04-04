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
        <div  class="md:col-span-4 max-h-80 overflow-y-scroll">
            <p class="font-medium text-lg"> Available Departments</p>
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                  <!-- head -->
                  <thead>
                    <tr>
                      <th>Departments</th>
                      <th></th>
                    
                    </tr>
                  </thead>
                  <tbody>
            @foreach ($deps as $department)
             
                    <!-- row 1 -->
                    @if ($hospital->departments->contains($department->id))
                    <tr>
                      <td>
                        <x-checkmark>{{ $department->name }}</x-checkmark>
                       </td>
                      <td><x-mary-button icon="o-trash" class="text-red-500" wire:click.live="detachdep({{ $department->id }})" spinner /></td>
                    </tr>
                    @endif
                    <!-- row 2 -->
                   
                  
               
              
            @endforeach
        </tbody>
        
    </table>
     
  </div>
          

         
          
       
        </div>

    </div>



    <script>



        window.addEventListener('swal_remdep',function(e){
            Swal.fire({
          icon: "warning",
          title : 'Are you sure to remove Department? ',
          showCancelButton: true,
        text:"Will be saved if you choose OK!",
          confirmButtonColor: "#d33",
          cancelButtonColor: "#00ca92",
          confirmButtonText: "Yes, Delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            @this.dispatch('goremove');
            Swal.fire({
              title: "Deleted!",
              text: "Centered  has been activated.",
              icon: "warning"
            });
          }
         
         
        });
                });
        
        
        
        </script>
</div>



