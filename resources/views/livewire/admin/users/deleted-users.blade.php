<div>
    <x-mary-toast />

    <div class="flex justify-between mb-4 ">
        {{-- <x-mary-button label="Go Back" link="/patient/add" icon="o-arrow-left" />
         --}}
        <x-mary-button label="Go Back" wire:click="goBack" icon="o-arrow-left" />


      
    </div>
    <x-mary-header title="Deleted Users" subtitle="Search centers">
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-magnifying-glass" class="border-green-500 focus:border-green-500"
                wire:model.live='search' placeholder="Search..." />
        </x-slot:middle>




    </x-mary-header>

    {{-- <div>{{$departments}}</div> --}}
    <x-mary-table :headers="$headers" :rows="$deletedusers" :sort-by="$sortBy">
        @scope('actions', $deleteduser)
            <span class="flex gap-4">

                <x-mary-button icon="c-archive-box-arrow-down" wire:click="restore({{ $deleteduser->id }})" spinner
                    class="btn-sm text-success" />
                <x-mary-button icon="o-trash" wire:click="delete({{ $deleteduser->id }})" spinner
                    class="btn-sm text-error" />
            </span>
        @endscope

        </x-table>



        


</div>
<script>
     window.addEventListener('swal_update',function(e){
    Swal.fire({
  icon: "warning",
  title : 'Are you sure to Update Department Name? ',
  showCancelButton: true,
text:"Will be saved if you choose OK!",
  confirmButtonColor: "#00ca92",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, Update it!"
}).then((result) => {
  if (result.isConfirmed) {
    @this.dispatch('gosave');
    Swal.fire({
      title: "Updated!",
      text: "Department updated successfully",
      icon: "success"
    });
  }
 
 
});
        });
</script>
