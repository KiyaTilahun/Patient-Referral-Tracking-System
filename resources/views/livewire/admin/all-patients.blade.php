<div wire:poll class="w-full">
    <x-mary-toast/>

    <x-mary-header title="All Patients" subtitle="Search Patients by Card Number">
        <x-slot:middle class="!justify-end">
            <span class="flex items-center gap-6">

                <x-mary-input icon="o-magnifying-glass" class="border-green-500 focus:border-green-500"
                    wire:model.live='search' placeholder="Search Referral_id" />
            </span>
        </x-slot:middle>




    </x-mary-header>
    {{-- <div class="w-1/3">
        <x-mary-datepicker wire:model.live="chooseddate" icon="o-calendar" hint="Choose Day" class="input-sm"
            :config="$config1" />
    </div> --}}


    <x-mary-table :headers="$headers" :rows="$patients" :sort-by="$sortBy" with-pagination>



        @scope('actions', $patient)
        <span class="flex gap-4">
            <x-mary-button icon="m-eye" class="text-warning btn-sm" wire:click="show({{ $patient->id }})" spinner />
            <x-mary-button icon="s-pencil-square" wire:click="edit({{ $patient->id }})" spinner
                class="btn-sm text-success" />
        </span>
        @endscope





    </x-mary-table>

    {{-- edit --}}
    <x-mary-modal wire:model="patienteditmodal" class="backdrop-blur">
        <form wire:submit.prevent="patientupdate">
            <div class="flex items-center justify-end p-2 ">

                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    @click="$wire.patienteditmodal = false">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>

                </button>
            </div>
            <div class="flex flex-col ">
                <span class=" cursor-default w-fit text-warning">Edit Patient</span>


                @isset($indvidualpatient)
                    <div class="mt-4">
                        <x-mary-input label="Name" placeholder="Your name" icon="o-shield-check" wire:model.live='name' autofocus />
                    </div>
                    <div class="mt-4">
                        <x-mary-input label="Phone" placeholder="Your name" icon="o-shield-check" wire:model.live='phone' autofocus />
                    </div>
                    <div class="mt-4">
                        <x-mary-input label="Email" placeholder="Your phone" icon="o-shield-check" wire:model.live='email' autofocus />
                    </div>
                    <div class="text-right mt-4">
                        @if($updatedinfo)
                         <x-mary-button label="Update" class="btn btn-outline btn-warning"
                            type="submit" />
                            @else
                            <x-mary-button label="Update" class=" btn-outline btn-disable"
                           disabled />
                            @endif

                    </div>
                @endisset


            </div>

        </form>

    </x-mary-modal>
    {{-- patient --}}

    <x-mary-modal wire:model="patientdetail" class="backdrop-blur overflow-auto ">
        <div class="h-[80vh] ">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Patient Detail
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    @click="$wire.patientdetail = false">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            @isset($indvidualpatient)






                <div class=" p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->

                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->

                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400"></p>

                            <ul class="my-4 space-y-3">
                                <li>
                                    <span
                                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">

                                        <span class="flex-1 ms-3 whitespace-nowrap">Patient Card number</span>
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{ $indvidualpatient->card_number }}</span>
                                    </span>
                                </li>
                                <li>
                                    <span
                                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">

                                        <span class="flex-1 ms-3 whitespace-nowrap">Patient Name</span>
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{ $indvidualpatient->name }}</span>
                                    </span>
                                </li>
                                <li>
                                    <span
                                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">

                                        <span class="flex-1 ms-3 whitespace-nowrap">Gender:</span>
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{ $indvidualpatient->gender->name }}</span>
                                    </span>
                                </li>
                                <li>
                                    <span
                                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">

                                        <span class="flex-1 ms-3 whitespace-nowrap">Patient Phone number</span>
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{ $indvidualpatient->phone }}</span>
                                    </span>
                                </li>
                                <li>
                                    <span
                                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">

                                        <span class="flex-1 ms-3 whitespace-nowrap">Patient Email:</span>
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{ $indvidualpatient->email }}</span>
                                    </span>
                                </li>

                                <li>
                                    <span>
                                        @if (!$emailstatus)
                                            <x-mary-button tooltip-left="EMAIL"
                                                class="btn  w-12 h-12  text-green-500 p-2 rounded-full"
                                                icon="o-device-phone-mobile" wire:click="emailsend" spinner />
                                        @else
                                            <x-mary-button tooltip-left="Email"
                                                class="btn  w-12 h-12  text-orange-500 p-2 rounded-full"
                                                icon="o-device-phone-mobile" label="Email sent" disabled />
                                        @endif
                                        @if (!$smsstatus)
                                            <x-mary-button tooltip-left="SMS"
                                                class="btn  w-12 h-12  text-orange-500 p-2 rounded-full" icon="s-envelope"
                                                wire:click="smssend" spinner />
                                        @else
                                            <x-mary-button tooltip-left="SMS"
                                                class="btn  w-12 h-12  text-orange-500 p-2 rounded-full" icon="s-envelope"
                                                label="SMS sent" disabled />
                                        @endif
                                        {{-- @isset($copiedref, $tokentext)
        <a href="{{ route('generate.patient', ['id' => $copiedref,'token'=>$tokentext]) }}" target="_blank">

        <x-mary-button tooltip-left="PRINT"  class="btn  w-12 h-12  text-info p-2 rounded-full" icon="o-printer"  />
        @endisset --}}
                                        </a>
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

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
