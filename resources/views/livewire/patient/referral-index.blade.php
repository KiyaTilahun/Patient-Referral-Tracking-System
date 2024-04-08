<div x-data x-init="$refs.answer.focus()">
    <div class="flex justify-between ">
        <x-mary-button label="Go Back" link="/patient/add" icon="o-arrow-left" />
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

                    <x-mary-button label="Close" class="btn-accent" onclick="modal17.close()" />
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

                <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-xl"><span
                        class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Add</span>
                    Referral </h1>


            </div>

            @if ($currentStep == 1)

                <div class="grid gap-6 gap-y-2 text-sm grid-cols-12 md:grid-cols-12 col-span-12  lg:pt-4">
                    <div class="md:col-span-5">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Referral Id</span>
                            </div>
                            <input type="text" placeholder="referral id" class="input input-bordered input-accent "
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
                    <div class="md:col-span-5">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Patient Name</span>
                            </div>
                            <input type="text" placeholder="Name" class="input input-bordered input-accent "
                                wire:model='name' />
                        </label>
                        @error('name')
                            <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="md:col-span-5">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">History</span>
                            </div>

                            <x-mary-textarea label="patient past treatment history"
                                class=" input-bordered border-accent " wire:model="history" placeholder=""
                                hint="Max 1000 chars other wise attach it" rows="1" inline maxlength="1000" />
                        </label>

                    </div>
                    <div class="md:col-span-5">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Findings</span>
                            </div>

                            <x-mary-textarea label="treatmen finding" class=" input-bordered border-accent "
                                wire:model="finding" placeholder="" hint="Max 1000 chars other wise attach it"
                                rows="1" inline maxlength="1000" />
                        </label>

                    </div>
                    <div class="md:col-span-5">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Treatment Given</span>
                            </div>

                            <x-mary-textarea label="treatment given" class=" input-bordered border-accent "
                                wire:model="treatment" placeholder="" hint="Max 1000 chars other wise attach it"
                                rows="1" inline maxlength="1000" />
                        </label>

                    </div>

                    <div class="md:col-span-5">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Referral Reason</span>
                            </div>

                            <x-mary-textarea label="Referral Reason" class=" input-bordered border-accent "
                                wire:model="reason" placeholder="" hint="Max 100 chars other wise attach it"
                                rows="1" inline maxlength="100" />
                        </label>

                    </div>


                    <div class="md:col-span-5">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Referring Doctor</span>
                            </div>

                            <select class="select select-accent w-full " wire:model='doctor'>
                                <option disabled selected>Referring Doctor</option>
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
                <div class="md:col-span-6 pt-4">
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Date of Birth</span>

                        </div>
                   
                        <x-mary-datepicker  wire:model="dob" class="input input-bordered input-accent" icon="o-calendar"  :config="$config1" />

                    </label>
                    @error('dob')
                        <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                            role="alert">
                            <span class="font-medium">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="flex justify-end col-span-10">
                    <button type="button" class="btn btn-md btn-outline btn-accent" wire:click="increaseStep">Next
                        <div wire:loading>
                            @include('utils.spinner')
                        </div>
                    </button>

                </div>

            @else
                <div class="grid gap-6 gap-y-2 text-sm grid-cols-12 md:grid-cols-12 col-span-12  lg:pt-4">

                    <div class="md:col-span-5">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Referral Type</span>
                            </div>

                            <select class="select select-accent w-full " wire:model.live='referral_type'>
                                <option disabled selected value="">Referral Type</option>

                                @if (!($typeinitial == 1))
                                    <option value='1'>Vertical</option>
                                @endif
                                <option value='2'>Horizontal</option>
                                <option value='3'>Diagonal</option>


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
                        
                        <div class="md:col-span-5">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Available Departments</span>
                                </div>

                                <select class="select select-accent w-full " wire:model='selecteddep'>
                                    <option disabled selected>departments</option>
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
                        <div class="md:col-span-5">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Initial Hospital</span>
                                </div>

                                <input type="text" placeholder="{{ $initial->name }}"
                                    class="input input-bordered input-accent disabled:input-accent"
                                    wire:model='$initial' disabled />
                            </label>
                            @error('doctor')
                                <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600"
                                    role="alert">
                                    <span class="font-medium">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    @endif
                    

                </div>

                <div class="flex justify-end col-span-10">
                    <button type="submit" class="btn btn-md btn-outline btn-accent" wire:click="increaseStep">Submit
                        <div wire:loading>
                            @include('utils.spinner')
                        </div>
                    </button>

                </div>
            @endif

        </div>
    </form>



</div>
</div>
