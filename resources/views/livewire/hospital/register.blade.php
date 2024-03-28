

<div >



    <!-- component -->
<div class="min-h-screen p-6 flex  justify-center">
    <div class="container max-w-screen-lg mx-auto pt-20 relative">
        <div class="absolute top-10 left-1/2  flex flex-col items-center">
            <div>Step</div>
        <div class="w-6  h-6 rounded-full bg-lime-400 text-white text-center ">1</div></div>
      <div>
     

  
        <div class=" rounded shadow-lg p-4 px-4 md:p-8 mb-6">
          <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
            <div class="text-gray-600">
              <p class="font-medium text-lg">Health Center Details</p>
              <p></p>
            </div>
  
            <div class="lg:col-span-2">
              <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                <div class="md:col-span-2">
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                          <span class="label-text">Center Name</span>
                    
                        </div>
                        <input type="text" placeholder="name" class="input input-bordered w-full max-w-xs" />
                    
                      </label>
                </div>
                <div class="md:col-span-3">
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                          <span class="label-text">Phone Number</span>
                    
                        </div>
                        <label class="input input-bordered flex items-center ">
                            +251
                            <input type="text" pattern="[0-9]{9}" maxlength=9 minlength="9" class="grow outline-none" placeholder="Phone Number" />
                          </label>
                    
                      </label>
                </div>
  
                <div class="md:col-span-2">
                    <label class="form-control w-full ">
                        <div class="label">
                          <span class="label-text">Center Email</span>
                    
                        </div>
                        <input type="text" placeholder="email" class="input input-bordered w-full max-w-xs" />
                    
                      </label>
                </div>

                
                <div class="md:col-span-2">
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                          <span class="label-text">Region</span>
                         
                        </div>
                        <select class="select select-bordered" wire:model.live='selectedregion'>
                            <option  selected>Choose Region</option>
                          @foreach ($regions as $region)
                          <option value="{{$region->id}}" >{{$region->name}}</option>
                          @endforeach
                        </select>
                      </label>
                </div>
            
               
                    
          
                <div class="md:col-span-2">
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                          <span class="label-text">Choose Zone</span>
                         
                        </div>
                        <select class="select select-accent" wire:model="zone">
                            @if (!is_null($zones))
                            @if(count($zones)==0)
                            <option value="" >No zone</option>
                            
                                
                            @else
                                
                           
                          @foreach ($zones as $zone)
                          <option value="{{$zone->id}}" >{{$zone->name}}</option>
                          @endforeach
                          @endif
                          @endif
                        </select>
                      </label>
                </div>
                <div class="md:col-span-1">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Woreda </span>
                       
                      </div>
                    <input type="number" placeholder="Type here" class="input input-bordered w-full max-w-xs" min="1"/>
                   
                  </label>
                </div>
                
                <div class="md:col-span-2">
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                          <span class="label-text">Health Center Type</span>
                         
                        </div>
                        <select class="select select-bordered" wire:model="Type">
                            <option class="diabled" value="">choose health center type</option>
                          @foreach ($types as $Zone)

                          <option value="{{$Zone->id}}" >{{$Zone->name}}</option>
                          @endforeach
                          
                        </select>
                      </label>
                </div>

               
                <div wire:ignore class="md:col-span-5 w-full">
                    <label class="form-control w-full ">
                        <div class="label">
                          <span class="label-text">Available Departments</span>
                         
                        </div>
                    <select wire:model="departments" multiple  id="testdropdown" class="select select-bordered dark:border-gray-600">
                        @foreach ($departments as $department)
                        <option value="{{$department->id}}" >{{$department->name}}</option>
                        @endforeach
                    </select>
                    </label>
                </div>


          
  
  
                
  
                
  
             
  
                
  
             
        
            
  
              </div>
            </div>
          </div>
        </div>
        <div class=" rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
              <div class="text-gray-600">
                <p class="font-medium text-lg">Liaison Office Details</p>
                <p></p>
              </div>
    
              <div class="lg:col-span-2">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                  <div class="md:col-span-2">
                      <label class="form-control w-full max-w-xs">
                          <div class="label">
                            <span class="label-text">Liaison Officer</span>
                      
                          </div>
                          <input type="text" placeholder="name" class="input input-bordered w-full max-w-xs" />
                      
                        </label>
                  </div>
                  <div class="md:col-span-3">
                      <label class="form-control w-full max-w-xs">
                          <div class="label">
                            <span class="label-text">Phone Number</span>
                      
                          </div>
                          <label class="input input-bordered flex items-center ">
                              +251
                              <input type="text" pattern="[0-9]{9}" maxlength=9 minlength="9" class="grow outline-none" placeholder="Phone Number" />
                            </label>
                      
                        </label>
                  </div>
    
                  <div class="md:col-span-2">
                      <label class="form-control w-full ">
                          <div class="label">
                            <span class="label-text">Center Email</span>
                      
                          </div>
                          <input type="text" placeholder="email" class="input input-bordered w-full max-w-xs" />
                      
                        </label>
                  </div>
  
                  
               
  
  
            
    
    
                  
    
                  
    
               
    
                  
    
               
          
              
    
                </div>
              </div>
            </div>
          </div>
      </div>
  
     
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
