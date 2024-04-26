<div wire:poll class="w-full">

    <x-mary-header title="Centers" subtitle="Search centers">
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-magnifying-glass" class="border-green-500 focus:border-green-500"
                wire:model.live='search' placeholder="Search..." />
        </x-slot:middle>




    </x-mary-header>

    <x-mary-table :headers="$headers" :rows="$centers" :sort-by="$sortBy" with-pagination>

        @scope('cell_referrtype_name', $center)
       
            <x-mary-badge 
                :value="$center->referrtype_name" 
                class="{{ 
                    $center->referrtype_name== 'diagonal' ? 'btn-outline btn-info btn-disabled' : '' 
                }} 
                {{
                    $center->referrtype_name== 'vertical' ? 'btn-outline btn-info btn-disabled' : ''
                }} 
                {{
                    $center->referrtype_name== 'horizontal' ? 'btn-outline btn-warning btn-disabled' : ''
                }} 
               " 
            />
      
    @endscope
    @scope('cell_referral_date', $center)
    <x-mary-button label="{{$center->referral_date}}"   icon="o-calendar"  class="btn-sm"  />

    @endscope


              
    </x-mary-table>
</div>
