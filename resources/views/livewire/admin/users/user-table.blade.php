<div>
  
    <x-mary-header title="Centers" subtitle="Search centers">
      <x-slot:middle class="!justify-end">
          <x-mary-input icon="o-magnifying-glass" class="border-green-500 focus:border-green-500" wire:model.live='search' placeholder="Search..." />
      </x-slot:middle>
    
          

         
  </x-mary-header>

    <x-mary-table :headers="$headers" :rows="$users" :sort-by="$sortBy" with-pagination >

    @scope('cell_roles_name', $user)
    <x-mary-badge :value="$user->roles_name" class="{{($user->roles_name=='superadmin') ? 'btn-outline btn-error btn-disabled':''}} {{ ($user->roles_name=='doctor') ?'btn-outline btn-info btn-disabled':''}}{{ ($user->roles_name=='admin') ?'btn-outline btn-disabled btn-success':''}}{{ ($user->roles_name=='staff') ?'btn-neutral btn-outline btn-disabled ':''}}" />
    @endscope
    @scope('actions', $center)
    <x-mary-button icon="m-eye" class="text-green-500 btn-sm" wire:click="show({{ $center->id }})" spinner  />
@endscope
    </x-mary-table>
   </div>

