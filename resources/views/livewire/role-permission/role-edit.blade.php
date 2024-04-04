<div>
    @if (is_null($role))
    <div class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400 font-bold text-right">Edit Role</div>
    <x-mary-input label="Name" wire:model="name" disabled value="choose role" />
    <div class=" pt-5 text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400 font-bold text-right">Role permissions</div>
    <select class="select select-accent w-full max-w-xs" disabled>
       <option disabled selected></option>
       <option>Auto</option>
       <option>Dark mode</option>
       <option>Light mode</option>
     </select>

  
@else
<div>{{$role}}</div>
<x-mary-form wire:submit="save">
<div class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400 font-bold text-right">Edit Role</div>
<x-mary-input label="Name" wire:model="rolename"  value="{{$role->name}}" />
<div class=" pt-5 text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400 font-bold text-right">Role permissions</div>
<select class="select select-accent w-full max-w-xs" disabled>
 <option disabled selected></option>
 <option>Auto</option>
 <option>Dark mode</option>
 <option>Light mode</option>
</select>

<x-slot:actions>
 
    <x-mary-button label="Click me!" class="btn-primary" type="submit" spinner="save" />
</x-slot:actions>
</x-mary-form>
@endif
</div>
