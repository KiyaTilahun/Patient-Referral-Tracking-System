{{-- user table name convention centers=users in this case --}}
<div>
  
    <x-mary-header title="Centers" subtitle="Search centers">
      <x-slot:middle class="!justify-end">
          <x-mary-input icon="o-magnifying-glass" class="border-green-500 focus:border-green-500" wire:model.live='search' placeholder="Search..." />
      </x-slot:middle>
    
          

         
  </x-mary-header>
  <div class="w-full">
    <div class="flex justify-between">
      <span class="flex gap-4 flex-col md:flex-row">
        @if ((auth()->user()->hasRole('superadmin')))
        <select class="select select-primary " wire:model.live='selectedhospital'>
            <option selected class="text-sm pt-0 mt-0" value="{{null}}">All Centers</option>
            @foreach ($allhospitals as $hospital)
                <option value="{{$hospital->id}}">{{$hospital->name}}</option>
            @endforeach
        </select>
            
        @else
        <select class="select select-primary " wire:model.live='selectedrole'>
            <option selected class="text-sm pt-0 mt-0" value="{{null}}">All Users</option>
            @foreach ($allroles as $role)
                <option value="{{$role->name}}">{{$role->name}}s</option>
            @endforeach
        </select> 
        @endif
       
        
        {{-- <select class="select select-primary " wire:model.live='selectedtype'>
          <option selected class="text-sm pt-0 mt-0" value="{{null}}">All  Type</option>
          @foreach ($alltypes as $type)
              <option value="{{$type->id}}">{{$type->name}}</option>
          @endforeach
      </select> --}}
    
    </span>
    <span>
        @if(!$selectedhospital)
      <x-mary-button label="Export pdf" icon="o-printer" class="text-sm btn-warning " wire:click='printpdf' spinner />
      @endif
    </span>
    </div>
  </div>
    <x-mary-table :headers="$headers" :rows="$users" :sort-by="$sortBy" with-pagination >
        
        @scope('cell_roles_name', $user)
        @foreach($user->roles as $role)
            <x-mary-badge 
                :value="$role->name" 
                class="{{ 
                    $role->name == 'superadmin' ? 'btn-outline btn-error btn-disabled' : '' 
                }} 
                {{
                    $role->name == 'doctor' ? 'btn-outline btn-info btn-disabled' : ''
                }} 
                {{
                    $role->name == 'admin' ? 'btn-outline btn-success btn-disabled' : ''
                }} 
                {{
                    $role->name == 'staff' ? 'btn-neutral btn-outline btn-disabled' : ''
                }}" 
            />
        @endforeach
    @endscope
    
    @scope('actions', $center)
    <x-mary-button icon="m-eye" class="text-green-500 btn-sm" wire:click="show({{ $center->id }})" spinner  />
    

@endscope
    </x-mary-table>
   </div>

