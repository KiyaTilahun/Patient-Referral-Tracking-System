<div class="mx-auto grid grid-cols-12 gap-4  p-1">
   <div class="header col-span-12 rounded-lg bord py-8">
      <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-5xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Roles and Permission</span> Management   </h1>
     
  </div>
   <div class="col-span-12 md:col-span-7">
      <div class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400 font-bold">All Roles</div>
    @foreach ($roles as $role)
        <x-mary-list-item :item="$role" >
        <x-slot:actions>
          
            <x-mary-button icon="s-pencil-square" class="text-green-500" wire:click="show({{ $role->id }})" spinner />

        </x-slot:actions>
        </x-mary-list-item>
    @endforeach
   </div>
   <div class="col-span-12 md:col-span-5">
     <livewire:role-permission.role-edit>


   </div>
   <div class="col-span-12 md:col-span-7">
      <div class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400 font-bold">All Permissions</div>
    @foreach ($permissions as $permission)
        <x-mary-list-item :item="$permission" >
        <x-slot:actions>
          
            <x-mary-button icon="s-pencil-square" class="text-green-500" wire:click="showperm({{ $permission->id }})" spinner />

        </x-slot:actions>
        </x-mary-list-item>
    @endforeach
   </div>
   <div class="col-span-12 md:col-span-5">
     <livewire:role-permission.permission-edit>


   </div>






</div>
