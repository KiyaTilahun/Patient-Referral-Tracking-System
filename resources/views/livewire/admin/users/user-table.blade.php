<div>
  
    <x-mary-header title="Centers" subtitle="Search centers">
      <x-slot:middle class="!justify-end">
          <x-mary-input icon="o-magnifying-glass" class="border-green-500 focus:border-green-500" wire:model.live='search' placeholder="Search..." />
      </x-slot:middle>
    
          

         
  </x-mary-header>

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

