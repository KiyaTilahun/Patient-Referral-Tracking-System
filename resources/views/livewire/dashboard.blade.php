<div class="flex-col w-full">
    <div class="w-full">     <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-5xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">DashBoard</span>    </h1></div>
   <div class="w-full inline-flex"> <x-mary-stat title="Messages" value="44" icon="o-envelope" tooltip="Hello" />
 
    <x-mary-stat
        title="Sales"
        description="This month"
        value="22.124"
        icon="o-arrow-trending-up"
        tooltip-bottom="There" />
     
    <x-mary-stat
        title="Lost"
        description="This month"
        value="34"
        icon="o-arrow-trending-down"
        tooltip-left="Ops!" />
     
    <x-mary-stat
        title="Sales"
        description="This month"
        value="22.124"
        icon="o-arrow-trending-down"
        class="text-orange-500"
        color="text-pink-500"
        tooltip-right="Gosh!" /></div>

        <div class="w-full">     <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-2xl lg:text-2xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Generate Report</span>    </h1></div>
        <div class="w-full inline-flex gap-10"> 
        <div>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Table</span>

                </div>
                <select class="select select-bordered" wire:model.live='selectedtable'>
                    <option selected>Choose table</option>
                    @foreach ($tablenames as $table)
                        <option value="{{ $table }}">{{ $table}}</option>
                    @endforeach
                </select>
            </label>
        </div>

        <div>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Choose Column </span>

                </div>
                <select
                class="select select-bordered {{ !(is_null($columns)) ? 'select-accent' : 'select-bordered' }} "
                wire:model.live="selectedcolumn">
                @if (!is_null($columns))
                    @if (count($columns) == 0)
                        <option value="">No Column</option>
                    @else
                        @foreach ($columns as $column)
                            <option value="{{ $column }}">{{ $column }}
                            </option>
                        @endforeach
                    @endif
                @endif
            </select>
            </label>
        </div>
        @if (!empty($columnvalues))
            
        <div>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Choose  </span>

                </div>
                <select
                class="select select-bordered {{ !(is_null($columnvalues)) ? 'select-accent' : 'select-bordered' }} "
                wire:model="selectedcolumn">
              
                    @if (count($columnvalues) == 0)
                        <option value="">No Column</option>
                    @else
                        @foreach ($columnvalues as $column)
                            <option value="{{ $column }}">{{ $column }}
                            </option>
                        @endforeach
                    @endif
       
            </select>
            </label>
        </div>
      
        @endif


          <div class="md:col-span-5 ">
                        <label class="form-control w-full ">
                            <div class="label">
                                <span class="label-text">Choose appointment day</span>
    
                            </div>
                       
                            <x-mary-datepicker  wire:model="appday" class="input input-bordered input-success" icon="o-calendar" :config="$config1"   />
    
                        </label>
                        @error('appday')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
      
        
        </div></div>

</div>