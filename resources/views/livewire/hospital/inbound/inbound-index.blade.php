<div wire:poll class="w-full">
    <x-mary-header title="InBound Referrals" subtitle="Search Referral by Card Number">
        <x-slot:middle class="!justify-end">
            <span class="flex items-center gap-6">

                <x-mary-input icon="o-magnifying-glass" class="border-green-500 focus:border-green-500"
                    wire:model.live='search' placeholder="Search Referral_id" />
            </span>
        </x-slot:middle>




    </x-mary-header>
    <div class="w-1/3">
        <x-mary-datepicker wire:model.live="chooseddate" icon="o-calendar" hint="Choose Day" class="input-sm"
            :config="$config1" />
    </div>

    <x-mary-table :headers="$headers" :rows="$centers" :sort-by="$sortBy" with-pagination>

        @scope('cell_referrtype_name', $center)
            <x-mary-badge :value="$center->referrtype_name"
                class="{{ $center->referrtype_name == 'diagonal' ? 'text-info' : '' }} 
                {{ $center->referrtype_name == 'vertical' ? 'text-info' : '' }} 
                {{ $center->referrtype_name == 'horizontal' ? 'text-warning' : '' }} 
               " />
        @endscope


        @scope('cell_statustype_name', $center)
            <x-mary-badge :value="$center->statustype_name"
                class="{{ $center->statustype_name == 'pending' ? 'btn-outline btn-warning btn-disabled' : '' }} 
        {{ $center->statustype_name == 'completed' ? 'btn-outline btn-info btn-disabled' : '' }} 
      
       " />
        @endscope
        @scope('cell_referral_date', $center)
            <x-mary-button label="{{ $center->referral_date }}" icon="o-calendar" class="btn-sm"
                link="inbound/{{ $center->referral_date }}" />
        @endscope
        @scope('cell_receiving_hospital_name', $center)
            <strong>{{ Str::limit($center->receiving_hospital_name, 20, '...') }}</strong>
        @endscope


        @scope('actions', $center)
            <x-mary-button icon="m-eye" class="text-warning btn-sm" wire:click="show({{ $center->id }})" spinner />
        @endscope



    </x-mary-table>




    <x-mary-modal wire:model="myModal3" class="backdrop-blur overflow-auto ">
        <div class="h-[80vh] ">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Referral Detail
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    @click="$wire.myModal3 = false">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            @isset($referral)






                <div class=" p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->

                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->

                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400"></p>
                            <span class=" text-right mb-2  flex justify-end gap-4">
                                {{-- <x-mary-button label="Close" class="btn-error"  @click="$wire.myModal3 = false" /> --}}

                                <x-mary-button label="Expand" class="btn-primary" wire:click="register({{ $referral }})"
                                    icon="o-arrows-pointing-out" />

                            </span>
                            <ul class="my-4 space-y-3">

                                <li>
                                    <span
                                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">

                                        <span class="flex-1 ms-3 whitespace-nowrap">Referred By:</span>
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{ $referral->card_number }}</span>
                                    </span>
                                </li>
                                <li>
                                    <span
                                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">

                                        <span class="flex-1 ms-3 whitespace-nowrap">Referred By:</span>
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{ $referral->referringHospital->name }}</span>
                                    </span>
                                </li>
                                <li>
                                    <span
                                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">

                                        <span class="flex-1 ms-3 whitespace-nowrap">Referred To:</span>
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{ $referral->receivingHospital->name }}</span>
                                    </span>
                                </li>

                                <li>
                                    <span
                                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">

                                        <span class="flex-1 ms-3 whitespace-nowrap">Appointment Day:</span>
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{ $referral->referral_date }}</span>
                                    </span>
                                </li>
                                <li>
                                    <span
                                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">

                                        <span class="flex-1 ms-3 whitespace-nowrap">Referral Type:</span>
                                        <span
                                            class="{{ $referral->referrtype->name == 'diagonal' ? 'btn-outline btn-info btn-disabled' : '' }} 
                                    {{ $referral->referrtype->name == 'vertical' ? 'btn-outline btn-info btn-disabled' : '' }} 
                                    {{ $referral->referrtype->name == 'horizontal' ? 'btn-outline btn-warning btn-disabled' : '' }}">

                                            {{ $referral->referrtype->name }}
                                        </span>
                                    </span>
                                </li>
                                <li>
                                    <span
                                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">

                                        <span class="flex-1 ms-3 whitespace-nowrap">Files :</span>
                                        @if (!is_null($referral->file_path))
                                            <x-mary-button label="File is attached" class="btn-md" icon="o-link"
                                                tooltip="file" wire:click="openpdf({{ $referral }})" type="button" />
                                        @else
                                            <x-mary-button label="No file" icon="o-link" tooltip="" />
                                        @endif

                                    </span>
                                </li>


                            </ul>

                        </div>
                    </div>



                </div>

            @endisset
        </div>




    </x-mary-modal>
</div>
