<div wire:poll class="w-full">
  <div class="flex justify-between w-full mb-6 px-6">  <x-mary-button label="Go Back" wire:click="goBack" icon="o-arrow-left" />
    <x-mary-button label="{{$date}}"   icon="o-calendar"  class="btn-warning cursor-default"  /></div>


    <x-mary-header title="OutBound Referrals" subtitle="Search Referral by Card Number">
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
  


              
    </x-mary-table>
</div>
