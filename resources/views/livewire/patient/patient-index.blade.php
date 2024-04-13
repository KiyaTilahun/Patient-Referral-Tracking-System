<div  x-data="{
	link: '{{$copiedref}}',
	copy () {
	  $clipboard(this.link)
	}
  }" x-init="$refs.answer.focus()">

        
  <x-mary-modal wire:model="savedmodal" class="backdrop-blur">
    <x-mary-alert title="Patient Has been saved" icon="o-check" class="alert-success"/>
    
    <div class="w-full py-8 px-14">
        <div class="relative text-center flex justify-center">
            <div class="label">
                <span class="label-text">Referral ID</span>

            </div>
            <input id="npm-install-copy-button" type="text" class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$copiedref}}" disabled readonly>
            <button data-copy-to-clipboard-target="npm-install-copy-button"  class="absolute end-2 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 inline-flex items-center justify-center" x-on:click="copy">
                <span id="default-icon">
                    <svg class="w-3.5 h-3.5"  xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                    </svg>
                </span>
                
             
               
            </button>
            <div id="tooltip-copy-npm-install-copy-button" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                <span id="default-tooltip-message">Copy to clipboard</span>
                <span id="success-tooltip-message" class="hidden">Copied!</span>
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </div>
    </div>
    
    <div class="flex justify-end gap-4">
        <x-mary-button label="OK" @click="$wire.savedmodal = false" class="btn btn-" />
    <x-mary-button label="To Referral" class="btn btn-warning" link="/referral/add"/>
    </div>

</x-mary-modal>
 

    
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
            
            <x-mary-button label="Close" class="btn-success" onclick="modal17.close()"  />
        </x-slot:actions>
    </x-mary-modal>

 
     <div class="text-right">
       
        <span>
            <x-mary-button icon="c-arrow-top-right-on-square" label="Patient already registered" class="border-warning" wire:click='openreferral' spinner />
            <x-mary-button icon="o-information-circle" label="Help" class="text-green-500" onclick="modal17.showModal()" spinner />
        </span>
       </div>

    <form wire:submit.prevent="register">
        <x-breadcrumb> <li class="inline-flex items-center">
            <a href="{{route('dashboard')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
              <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
              </svg>
              Home
            </a>
          </li>
          <li>
            <div class="flex items-center ms-1 text-sm font-medium text-gray-700  md:ms-2 dark:text-gray-400">
              <svg class="w-3 h-3 text-gray-400 mx-1 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
              </svg>
              Patient Management
            </div>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <svg class="w-3 h-3 text-gray-400 mx-1 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
              </svg>
              <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400"> Register Patients</span>
            </div>
          </li></x-breadcrumb>
         
    <div class="grid gap-6 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
        <div class="text-gray-600 flex md:h-72 items-center">
            {{-- <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Register Patient</span>    </h1> --}}
            <x-page-heading :title="'Register Patient'" />
          
        </div>
       
            <div class="lg:col-span-2 lg:pt-14">
                <div class="grid gap-6 gap-y-2 text-sm grid-cols-12 md:grid-cols-12">
                    <div class="md:col-span-6 col-span-12">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Patient Name</span>

                            </div>
                            <input type="text" placeholder="name" class="input input-bordered input-success  w-full @error('name') border-error @enderror "
                                wire:model.live='name' x-ref="answer" />

                        </label>
                        @error('name')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="md:col-span-6 col-span-12">
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

                  


                    <div class="md:col-span-6 col-span-12">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Phone Number</span>

                            </div>
                            <label class="input  input-success flex items-center @error('phone') input-error @enderror ">
                                +251
                                <input type="text" pattern="[0-9]{9}" maxlength=9 minlength="9"
                                    class="grow outline-none border-none active:border-none focus:border-none  " placeholder="Phone Number"
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

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Center Email</span>

                            </div>
                            <input type="email" placeholder="email"
                                class="input input-bordered input-success w-full max-w-xs" wire:model='email' />

                        </label>
                        @error('email')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>


                    <div class="md:col-span-6 col-span-12 pt-4">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Date of Birth</span>

                            </div>
                       
                            <x-mary-datepicker  wire:model="dob" class="input input-bordered input-success" icon="o-calendar"  :config="$config1" />

                        </label>
                        {{-- @error('dob')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror --}}
                    </div>

                    {{-- <div class="md:col-span-4">
                        <label class="form-control w-full ">
                            <div class="label">
                                <span class="label-text">Treatment</span>

                            </div>
                          
                                <x-mary-select  class="input input-bordered input-success focus:border-success border-success " icon-right="c-tag" :options="$departments" wire:model="treatment" />

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
                            <textarea class="textarea textarea-success" placeholder="medical history" ></textarea>

                                

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
                    <button type="submit" class="btn btn-outline btn-success">Submit <div wire:loading>  @include('utils.spinner')</div></button>
                </div>
            </div>
      
    </div>
</form>


</div>

