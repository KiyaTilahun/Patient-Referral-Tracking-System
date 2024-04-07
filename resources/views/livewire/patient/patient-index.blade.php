<div x-data x-init="$refs.answer.focus()">

        
    
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
       
        <span>
            <x-mary-button icon="c-arrow-top-right-on-square" label="Patient already registered" class="border-warning" wire:click='openreferral' spinner />
            <x-mary-button icon="o-information-circle" label="Help" class="text-green-500" onclick="modal17.showModal()" spinner />
        </span>
       </div>

    <form wire:submit.prevent="register">
    <div class="grid gap-6 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
        <div class="text-gray-600 flex md:h-72 items-center">
            <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Register Patient</span>    </h1>
          
        </div>
       
            <div class="lg:col-span-2 lg:pt-14">
                <div class="grid gap-6 gap-y-2 text-sm grid-cols-12 md:grid-cols-12">
                    <div class="md:col-span-6">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Patient Name</span>

                            </div>
                            <input type="text" placeholder="name" class="input input-bordered input-accent  w-full "
                                wire:model='name' x-ref="answer" />

                        </label>
                        @error('name')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="md:col-span-6">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Gender</span>

                            </div>
                            @foreach ($genders as $genderchoose)
                                
                           
                            <div class="flex items-center mb-4">
                                <input id="default-radio-1" type="radio"  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" value={{ $genderchoose['value'] }} wire:model='gender'>
                                <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $genderchoose['label'] }}</label>
                            </div>
                            @endforeach
                        </label>
                        @error('gender')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                  


                    <div class="md:col-span-6">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Phone Number</span>

                            </div>
                            <label class="input  input-accent flex items-center ">
                                +251
                                <input type="text" pattern="[0-9]{9}" maxlength=9 minlength="9"
                                    class="grow outline-none border-none active:border-none focus:border-none" placeholder="Phone Number"
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

                    <div class="md:col-span-6">
                        <label class="form-control w-full max-w-xs">
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


                    <div class="md:col-span-6 pt-4">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Date of Birth</span>

                            </div>
                       
                            <x-mary-datepicker  wire:model="dob" class="input input-bordered input-accent" icon="o-calendar"  :config="$config1" />

                        </label>
                        @error('email')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    {{-- <div class="md:col-span-4">
                        <label class="form-control w-full ">
                            <div class="label">
                                <span class="label-text">Treatment</span>

                            </div>
                          
                                <x-mary-select  class="input input-bordered input-accent focus:border-accent border-accent " icon-right="c-tag" :options="$departments" wire:model="treatment" />

                        </label>
                        @error('cardnumber')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                  
                    <div class="md:col-span-5">
                        <label class="form-control w-full ">
                            <div class="label">
                                <span class="label-text">Medical Note</span>

                            </div>
                            <textarea class="textarea textarea-accent" placeholder="medical history" ></textarea>

                                

                        </label>
                        @error('medical')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div> --}}

              

                </div>
                <div class="flex justify-end pt-8 pr-20">
                    <button type="submit" class="btn btn-outline btn-accent">Submit <div wire:loading>  @include('utils.spinner')</div></button>
                </div>
            </div>
      
    </div>
</form>


</div>

