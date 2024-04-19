<div x-data x-init="$refs.answer.focus()">
    <x-mary-toast />
    <div class="flex justify-between ">
        {{-- <x-mary-button label="Go Back" link="/patient/add" icon="o-arrow-left" />
         --}}
        <x-mary-button label="Go Back" wire:click="goBack" icon="o-arrow-left" />


        <div class="px-20">
            <x-mary-modal id="modal17">
                <p>

                <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Follow this
                    instuction while registering requirements</h2>
                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">


                    <x-checkmark>This form has 2 steps </x-checkmark>
                    <x-checkmark>The referral only works for registered patients only </x-checkmark>
                    <x-checkmark>As the card number is filled data will automatically will be filled </x-checkmark>






                </ul>

                </p>

                <x-slot:actions>
                    {{-- Notice `onclick` is HTML --}}

                    <x-mary-button label="Close" class="btn-success" onclick="modal17.close()" />
                </x-slot:actions>
            </x-mary-modal>


            <div class="text-right">

                <span>

                    <x-mary-button icon="o-information-circle" label="Help" class="text-green-500"
                        onclick="modal17.showModal()" spinner />
                </span>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="register">
        <div class="grid grid-cols-12 w-full">
            <div class="header col-span-12 rounded-lg bord py-6 text-left">

                {{-- <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-xl"><span
                        class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Add</span>
                    Referral </h1> --}}
                <x-breadcrumb>
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div
                            class="flex items-center ms-1 text-sm font-medium text-gray-700  md:ms-2 dark:text-gray-400">
                            <svg class="w-3 h-3 text-gray-400 mx-1 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            Patient Management
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Add
                                Referral</span>
                        </div>
                    </li>
                </x-breadcrumb>
                <x-page-heading :title="'Add Referral'" />


            </div>

            @if ($currentStep == 1)

                <div class="grid gap-6 gap-y-2 text-sm grid-cols-12 md:grid-cols-12 col-span-12  lg:pt-4">
                    <div class="md:col-span-5 col-span-12">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Referral Id</span>
                            </div>
                            <input type="text" placeholder="referral id" class="input input-bordered input-success "
                                wire:model.live='card_number' x-ref="answer" />
                            <div class="mt-2 w-full overflow-hidden rounded-md bg-white">
                                @if (count($results) > 0)
                                    @foreach ($results as $result)
                                        <div wire:click="fillSearchInput('{{ $result }}')"
                                            class="cursor-pointer py-2 px-3 hover:bg-slate-100">
                                            <p class="text-sm font-medium text-gray-600">{{ $result }}</p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>


                        </label>
                        @error('card_number')
                            <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="md:col-span-5 col-span-12">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Patient Name</span>
                            </div>
                            <input type="text" placeholder="Name" class="input input-bordered input-success "
                                wire:model='name' />
                        </label>
                        @error('name')
                            <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="md:col-span-5 col-span-12">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">History</span>
                            </div>

                            <x-mary-textarea label="patient past treatment history"
                                class=" input-bordered border-success " wire:model="history" placeholder=""
                                hint="Max 1000 chars other wise attach it" rows="1" inline maxlength="1000" />
                        </label>

                    </div>
                    <div class="md:col-span-5 col-span-12">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Findings</span>
                            </div>

                            <x-mary-textarea label="treatmen finding" class=" input-bordered border-success "
                                wire:model="finding" placeholder="" hint="Max 1000 chars other wise attach it"
                                rows="1" inline maxlength="1000" />
                        </label>

                    </div>
                    <div class="md:col-span-5 col-span-12">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Treatment Given</span>
                            </div>

                            <x-mary-textarea label="treatment given" class=" input-bordered border-success "
                                wire:model="treatment" placeholder="" hint="Max 1000 chars other wise attach it"
                                rows="1" inline maxlength="1000" />
                        </label>

                    </div>

                    <div class="md:col-span-5 col-span-12">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Referral Reason</span>
                            </div>

                            <x-mary-textarea label="Referral Reason" class=" input-bordered border-success "
                                wire:model="reason" placeholder="" hint="Max 100 chars other wise attach it"
                                rows="1" inline maxlength="100" />
                        </label>

                    </div>


                    <div class="md:col-span-5 col-span-12">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Referring Doctor</span>
                            </div>

                            <select class="select select-success w-full  " wire:model='doctor'>
                                <option value="">Referring Doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value={{ $doctor->id }}>{{ $doctor->name }}</option>
                                @endforeach


                            </select>
                        </label>
                        @error('doctor')
                            <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end col-span-10">
                    <button type="button" class="btn btn-md btn-outline btn-success" wire:click="increaseStep">Next
                        <div wire:loading>
                            @include('utils.spinner')
                        </div>
                    </button>

                </div>
            @else
                <div class="grid gap-6 gap-y-2 text-sm grid-cols-12 md:grid-cols-12 col-span-12  lg:pt-4">

                    <div class="md:col-span-5 col-span-12">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Referral Type</span>
                            </div>

                            <select class="select select-success w-full " wire:model.live='referral_type'>
                                <option selected value="">Referral Type</option>

                                @if (!($typeinitial == 3))
                                    <option value='1'>Vertical</option>
                                @endif
                                <option value='2'>Horizontal</option>
                                @if (!($typeinitial == 1))
                                    <option value='3'>Diagonal</option>
                                @endif


                            </select>
                        </label>
                        @error('referral_type')
                            <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    @if ($notdiagonal)

                        <div class="md:col-span-5 col-span-12">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Available Departments</span>
                                </div>

                                <select class="select select-success w-full " wire:model.live='selecteddep'>
                                    <option value="">departments</option>
                                    @foreach ($availbledep as $avail)
                                        <option value={{ $avail->id }}>{{ $avail->name }}</option>
                                    @endforeach


                                </select>
                            </label>
                            @error('selecteddep')
                                <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600"
                                    role="alert">
                                    <span class="font-medium">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    @elseif (isset($initial))
                        <div class="md:col-span-5 col-span-12">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Initial Hospital</span>
                                </div>

                                <input type="text" placeholder="{{ $initial->name }}"
                                    value="{{ $initial->id }}" class="input input-bordered input-success"
                                    wire:model='initial' />
                            </label>
                            @error('selectedcenter')
                                <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600"
                                    role="alert">
                                    <span class="font-medium">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    @endif
                    {{-- common elements --}}

                    @if (!isset($initial))
                        @if ($notdiagonal && isset($selecteddep))
                            <div class="md:col-span-5 col-span-12">
                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">Choose Hospital</span>

                                    </div>
                                    <select class="select select-success" wire:model.live='selectedcenter'>
                                        @if (count($availablecenter) == 0)
                                            <option value="">No Centers</option>
                                        @else
                                            <option value="">Centers</option>
                                            @foreach ($availablecenter as $avail)
                                                <option value="{{ $avail->id }}"
                                                    class="flex justify-between items-center">

                                                    <span>{{ $avail->name }}...........</span><span
                                                        class="text-green">{{ $avail->region->name }}</span>

                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </label>
                                @error('selectedcenter')
                                    <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600"
                                        role="alert">
                                        <span class="font-medium">{{ $message }}</span>
                                    </div>
                                @enderror

                            </div>
                        @else
                            <div class="md:col-span-5 col-span-12">
                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">Available Centers</span>

                                    </div>
                                    <select class="select select-success" wire:model.live='zone' disabled>

                                        <option value=""></option>

                                    </select>
                                </label>
                                @error('selectedcenter')
                                    <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600"
                                        role="alert">
                                        <span class="font-medium">{{ $message }}</span>
                                    </div>
                                @enderror

                            </div>
                        @endif
                    @endif



                    {{-- choosing appointment day --}}
                    {{-- default view --}}
                    @if (!isset($selectedcenter))
                        <div class="md:col-span-5 col-span-12 ">
                            <label class="form-control w-full ">
                                <div class="label">
                                    <span class="label-text">Choose appointment day</span>

                                </div>

                                <x-mary-datepicker wire:model="appday" class="input input-bordered input-success"
                                    icon="o-calendar" disabled />

                            </label>

                        </div>
                        {{-- when department is choosen --}}
                    @else
                        <div class="md:col-span-5 col-span-12 ">
                            <label class="form-control w-full ">
                                <div class="label">
                                    <span class="label-text">Choose appointment day</span>

                                </div>
                                @if (!isset($sonfig1))
                                    <x-mary-datepicker wire:model="appday" class="input input-bordered input-success"
                                        icon="o-calendar" :config="$config1" />
                                @else
                                    <x-mary-datepicker wire:model="appday" class="input input-bordered input-success"
                                        icon="o-calendar" disabled />
                                @endif
                            </label>
                            @error('appday')
                                <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                    role="alert">
                                    <span class="font-medium">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    @endif
                    <div class="md:col-span-5 col-span-12 w-full">
                        <label class="form-control w-full ">
                            <div class="label">
                                <span class="label-text">Attach All the necessary Patient files as one pdf
                                    file
                                    <span class="badge badge-success badge-outline">Max 10mb</span>
                                </span>


                            </div>
                            <input type="file" class="file-input file-input-bordered w-full " accept=".pdf"
                                wire:model="fileattach" />

                        </label>
                        @error('fileattach')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>


                </div>



                {{-- <div class="flex justify-end col-span-10">


                    <a href="{{ route('generate', ['id' => $card_number]) }}" target="_blank"> <button
                            type="button" class="btn btn-md btn-outline btn-success">Generate pdf
                            <div wire:loading>
                                @include('utils.spinner')
                            </div>
                        </button> </a>

                </div> --}}
                {{-- <div class="flex justify-end col-span-10 pt-6">
                    <button type="submit" class="btn btn-md btn-outline btn-success"
                        wire:click="generatepdf">generate
                        <div wire:loading>
                            @include('utils.spinner')
                        </div>
                    </button>

                </div> --}}


                <x-mary-modal wire:model="myModal3" class="backdrop-blur ">
                    <div class="h-[80vh]">
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
            
            
                        <div class=" p-4 w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                             
                                <!-- Modal body -->
                                <div class="p-4 md:p-5">
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">{{$hospitalname}}</p>
                                    <ul class="my-4 space-y-3">
            
                                        <li>
                                            <span 
                                                class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
            
                                                <span class="flex-1 ms-3 whitespace-nowrap">Referred By:</span>
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$hospitalname}}</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span 
                                                class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
            
                                                <span class="flex-1 ms-3 whitespace-nowrap">Referred To:</span>
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$referredcenter}}</span>
                                            </span>
                                        </li>
                                        
                                        <li>
                                            <span 
                                                class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
            
                                                <span class="flex-1 ms-3 whitespace-nowrap">Appointment Day:</span>
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$appday}}</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span 
                                                class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
            
                                                <span class="flex-1 ms-3 whitespace-nowrap">Referral Type:</span>
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$referralname}}</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span 
                                                class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
            
                                                <span class="flex-1 ms-3 whitespace-nowrap">Files :</span>
                                                @if(isset($fileattach))
                                                <x-mary-button label="File is attached" class="btn-md"  icon="o-link" tooltip="file" />
                                                    
                                                @else
                                                <x-mary-button label="No file"  icon="o-link" tooltip="" />
                                                @endif
                                                
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
            
                        </div>
                    </div>
                    <x-slot:actions>
                        <x-mary-button label="Cancel" @click="$wire.myModal3 = false" />

                        <x-mary-button label="Confirm" class="btn-primary" wire:click='register' />
                    </x-slot:actions>
            
            
                  
                </x-mary-modal>
                <div class="flex justify-end col-span-10 pt-6">
                    <button type="button" class="btn btn-md btn-outline btn-success"
                    wire:click='checkentry' >Submit
                        <div wire:loading>
                            @include('utils.spinner')
                        </div>
                    </button>

                </div>
            @endif

        </div>
    </form>
    <x-mary-modal wire:model="saved"  class="">
        <div class="w-full flex justify-center"> Referral  Finished</div>
        <x-slot:actions >
       
            <div class="flex justify-between gap-4 w-full p-9">
                    
            <x-mary-button label="New Referral"    />
            @if($saved)
            <a href="{{ route('generate', ['id' => $card_number]) }}" target="_blank">
            <x-mary-button label="Generate Report"   icon="s-printer"  class="btn-warning"  />
            </a>
            @endif

           
            </div>

        </x-slot:actions>
    </x-mary-modal>
     
  

    


</div>
</div>
