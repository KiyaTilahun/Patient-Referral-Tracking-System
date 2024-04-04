<div>
    @if (!is_null($editable))


<label class="form-control w-full max-w-xs">
    <div class="label">
      <span class="label-text">Department name</span>
     
    </div>  
    <input type="text" placeholder="{{$editable['name']}}" class="input input-bordered w-full max-w-xs" disabled/>
  </label>

  <label class="form-control w-full max-w-xs">
    <div class="label">
      <span class="label-text">Daily Referral Slot Available</span>
     
    </div>  
    <input type="number" placeholder="{{$editable['pivot']['slot']}}" class="input input-bordered w-full max-w-xs" wire:model='slot'  value=" "/>
   
  </label>
        
  <div class="header col-span-12 rounded-lg bord py-8">
    <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Days</span> Available   </h1>
   
</div>
    @else
      
    
    <label class="form-control w-full max-w-xs">
      <div class="label">
        <span class="label-text">Department name</span>
       
      </div>  
      <input type="text" placeholder="Department Name" class="input input-bordered w-full max-w-xs" disabled />
    </label>
  
    <label class="form-control w-full max-w-xs">
      <div class="label">
        <span class="label-text">Daily Referral Slot Available</span>
       
      </div>  
      <input type="text" placeholder="Availble slots" class="input input-bordered w-full max-w-xs"   value="0" disabled/>
     
    </label>
    @endif
</div>
