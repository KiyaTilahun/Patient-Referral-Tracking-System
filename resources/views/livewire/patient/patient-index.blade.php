<div>
    <x-mary-modal id="modal17" >
        <p>

            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Follow this
                instuction while registering requirements</h2>
            <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">


                <x-checkmark>Enter all the patient data</x-checkmark>
                <x-checkmark>After you enter patient data and submit the form you can appoint referrals </x-checkmark>





            </ul>

            </p>
     
        <x-slot:actions>
            {{-- Notice `onclick` is HTML --}}
            
            <x-mary-button label="Close" class="btn-accent" onclick="modal17.close()"  />
        </x-slot:actions>
    </x-mary-modal>

 
     <div class="text-right">
       
        
        <x-mary-button icon="o-information-circle" label="Help" class="text-green-500" onclick="modal17.showModal()" spinner /></div>

    <form wire:submit.prevent="register">
    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
        <div class="text-gray-600 flex md:h-72 items-center">
            <p class="font-medium text-lg"> Patient Registration</p>
          
        </div>
       
            <div class="lg:col-span-2">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                    <div class="md:col-span-2">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Patient Name</span>

                            </div>
                            <input type="text" placeholder="name" class="input input-bordered input-accent  w-full max-w-xs"
                                wire:model='name' />

                        </label>
                        @error('name')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="md:col-span-3">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Gender</span>

                            </div>
                            <div class="form-control">
                                <label class="label cursor-pointer">
                                  <span class="label-text">Red pill</span> 
                                  <input type="radio" wire:model="selectedgender" class="radio checked:bg-red-500" checked />
                                </label>
                              </div>
                              <div class="form-control">
                                <label class="label cursor-pointer">
                                  <span class="label-text">Blue pill</span> 
                                  <input type="radio" wire:model="selectedgender" class="radio checked:bg-blue-500"  />
                                </label>
                              </div>

                        </label>
                        @error('selectedgender')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="form-control w-full ">
                            <div class="label">
                                <span class="label-text">Card Number</span>

                            </div>
                            <input type="text" placeholder="Card NO." class="input input-bordered input-accent  w-full max-w-xs"
                                wire:model='cardnumber' />

                        </label>
                        @error('cardnumber')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="form-control w-full ">
                            <div class="label">
                                <span class="label-text">Treatment</span>

                            </div>
                            <input type="text" placeholder="Card NO." class="input input-bordered input-accent w-full max-w-xs"
                                wire:model='cardnumber' />
                                {{-- <x-select label="Right icon" icon-right="o-user" :options="$users" wire:model="selectedUser" /> --}}

                        </label>
                        @error('cardnumber')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                  
                    <div class="md:col-span-2">
                        <label class="form-control w-full ">
                            <div class="label">
                                <span class="label-text">Medical History</span>

                            </div>
                            <textarea class="textarea textarea-accent" placeholder="medical history" ></textarea>

                                {{-- <x-select label="Right icon" icon-right="o-user" :options="$users" wire:model="selectedUser" /> --}}

                        </label>
                        @error('medical')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>


                    <div class="md:col-span-3">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Phone Number</span>

                            </div>
                            <label class="input input-bordered input-accent flex items-center ">
                                +251
                                <input type="text" pattern="[0-9]{9}" maxlength=9 minlength="9"
                                    class="grow outline-none" placeholder="Phone Number"
                                    wire:model='phone' />
                            </label>

                        </label>
                        @error('phone')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="form-control w-full ">
                            <div class="label">
                                <span class="label-text">Center Email</span>

                            </div>
                            <input type="email" placeholder="email"
                                class="input input-bordered input-accent w-full max-w-xs" wire:model='email' />

                        </label>
                        @error('email')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

              

                </div>
                <div class="flex justify-end pt-8 pr-20">
                    <button type="submit" class="btn btn-outline btn-accent">Submit <div wire:loading>  @include('utils.spinner')</div></button>
                </div>
            </div>
      
    </div>
</form>
</div>

