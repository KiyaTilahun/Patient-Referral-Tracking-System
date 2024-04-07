<div x-data x-init="$refs.answer.focus()">
<div class="flex justify-between ">
    <div wire:click=''>
        <x-goback></x-goback>
    </div>
    <div class="px-20">
    <x-mary-modal id="modal17" >
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
            
            <x-mary-button label="Close" class="btn-accent" onclick="modal17.close()"  />
        </x-slot:actions>
    </x-mary-modal>

 
     <div class="text-right">
       
        <span>
            
            <x-mary-button icon="o-information-circle" label="Help" class="text-green-500" onclick="modal17.showModal()" spinner />
        </span>
       </div>
</div>
</div>
   

    <div class="grid grid-cols-12 w-full">
        <div class="header col-span-12 rounded-lg bord py-6 text-left">

            <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-xl"><span
                    class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Add</span>
                Referral </h1>


        </div>

        <div class="grid gap-6 gap-y-2 text-sm grid-cols-12 md:grid-cols-12 col-span-12  lg:pt-4">
            <div class="md:col-span-5">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Referral Id</span>
                    </div>
                    <input type="text" placeholder="referral id" class="input input-bordered input-accent "
                        wire:model='referral_id' x-ref="answer" />
                </label>
                @error('referral_id')
                    <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600" role="alert">
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
                    <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600" role="alert">
                        <span class="font-medium">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="md:col-span-5">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">History</span>
                    </div>

                    <x-mary-textarea label="patient past treatment history" class=" input-bordered border-accent "
                        wire:model="history" placeholder="" hint="Max 1000 chars other wise attach it" rows="1"
                        inline maxlength="1000" />
                </label>
                @error('history')
                    <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600" role="alert">
                        <span class="font-medium">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="md:col-span-5">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Findings</span>
                    </div>

                    <x-mary-textarea label="treatmen finding" class=" input-bordered border-accent "
                        wire:model="finding" placeholder="" hint="Max 1000 chars other wise attach it" rows="1"
                        inline maxlength="1000" />
                </label>
                @error('finding')
                    <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600" role="alert">
                        <span class="font-medium">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="md:col-span-5">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Treatment Given</span>
                    </div>

                    <x-mary-textarea label="treatment given" class=" input-bordered border-accent "
                        wire:model="treatment" placeholder="" hint="Max 1000 chars other wise attach it" rows="1"
                        inline maxlength="1000" />
                </label>
                @error('treatment')
                    <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600" role="alert">
                        <span class="font-medium">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="md:col-span-5">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Referral Reason</span>
                    </div>

                    <x-mary-textarea label="Referral Reason" class=" input-bordered border-accent " wire:model="reason"
                        placeholder="" hint="Max 100 chars other wise attach it" rows="1" inline
                        maxlength="100" />
                </label>
                @error('reason')
                    <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600" role="alert">
                        <span class="font-medium">{{ $message }}</span>
                    </div>
                @enderror
            </div>


            <div class="md:col-span-5">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Referring Doctor</span>
                    </div>

                    <select class="select select-accent w-full ">
                        <option disabled selected>Referring Doctor</option>
                        <option>One Piece</option>
                        <option>Naruto</option>

                    </select>
                </label>
                @error('reason')
                    <div class="p-2 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-600" role="alert">
                        <span class="font-medium">{{ $message }}</span>
                    </div>
                @enderror
            </div>
        </div>
        <div class="flex justify-end col-span-10">
            <button type="button" class="btn btn-md btn-outline btn-accent" wire:click="increaseStep">Next
                <div wire:loading>
                    @include('utils.spinner')
                </div>
            </button>
          
        </div>
    </div>




</div>
</div>
