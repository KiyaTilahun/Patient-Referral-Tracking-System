<div>
    <div class="fixed right-4 ">
        <button type="button" class="md:inline-flex gap-7 pt-5 hidden" wire:click='logout'>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-login-2" width="20"
                height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00ca92" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                <path d="M3 12h13l-3 -3" />
                <path d="M13 15l3 -3" />
            </svg>
            <span class="text-[#00ca92]"> Login Instead</span></button>

        <!-- this hidden checkbox controls the state -->

    </div>
    <form wire:submit.prevent="register">

        <!-- component -->
        <div class="min-h-screen p-16 flex  justify-center">
            <div class="{{ !($currentStep == 4) ? ' pt-20' : 'pt-0' }} container max-w-screen-lg mx-auto relative">
                @if (!($currentStep == 4))


                    <div class="absolute top-[-10px] left-1/2  flex flex-col items-center">
                        <div>
                            Step
                        </div>
                        <div
                            class="w-8  h-8 rounded-full bg-[#00ca92] text-white text-center flex justify-center items-center">
                            <div> {{ $currentStep }}</div>

                        </div>

                        @if ($currentStep == 1)
                            <!-- Code to execute if condition1 is true -->
                            <p class="">Health Center Information.</p>
                        @elseif($currentStep == 2)
                            <!-- Code to execute if condition2 is true -->
                            <p>Liaison Office Information.</p>
                        @elseif($currentStep == 3)
                            <!-- Code to execute if condition2 is true -->
                            <p>Check Your Entry</p>
                            <!-- Code to execute if neither condition1 nor condition2 is true -->
                        @endif



                    </div>
                @endif
                <div>


                    @if ($currentStep == 1)


                        <div class=" rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                                <div class="text-gray-600">
                                    <p class="font-medium text-lg">Health Center Details</p>
                                    <p>

                                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Follow this
                                        instuction while registering requirements</h2>
                                    <ul
                                        class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">

                                        <x-checkmark>Enter the full name of the health center (use single quotes if
                                            needed)
                                        </x-checkmark>
                                        <x-checkmark>Enter a valid working number for approval purpose</x-checkmark>
                                        <x-checkmark>Enter a valid working number for approval purpose</x-checkmark>
                                        <x-checkmark>Choose the center respective Region ...zones will be automatically
                                            available</x-checkmark>
                                        <x-checkmark>Enter a real woreda number if there is no one kebele number can be
                                            used </x-checkmark>
                                            <x-checkmark  class="text-warning inline">Attach all the necessary credentials of your center in format </x-checkmark>




                                    </ul>

                                    </p>
                                </div>

                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                        <div class="md:col-span-2">
                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Center Name</span>

                                                </div>
                                                <input type="text" placeholder="name"
                                                    class="input input-bordered w-full max-w-xs" wire:model='name' />

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
                                                    <span class="label-text">Phone Number</span>

                                                </div>
                                                <label class="input input-bordered flex items-center ">
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
                                                    class="input input-bordered w-full max-w-xs" wire:model='email' />

                                            </label>
                                            @error('email')
                                                <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                                    role="alert">
                                                    <span class="font-medium">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="md:col-span-3">
                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Region</span>

                                                </div>
                                                <select class="select select-bordered" wire:model.live='selectedregion'>
                                                    <option selected>Choose Region</option>
                                                    @foreach ($regions as $region)
                                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                    @endforeach
                                                </select>
                                            </label>
                                            @error('selectedregion')
                                                <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                                    role="alert">
                                                    <span class="font-medium">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>




                                        <div class="md:col-span-2">
                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Choose Zone</span>

                                                </div>
                                                <select
                                                    class="select select-bordered {{ !is_null($zones) ? ' select-accent' : 'select-bordered' }} "
                                                    wire:model="zone">
                                                    @if (!is_null($zones))
                                                        @if (count($zones) == 0)
                                                            <option value="">No zone</option>
                                                        @else
                                                            @foreach ($zones as $zone)
                                                                <option value="{{ $zone->name }}">{{ $zone->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </select>
                                            </label>
                                            @error('zone')
                                                <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                                    role="alert">
                                                    <span class="font-medium">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="md:col-span-1">
                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Woreda </span>

                                                </div>
                                                <input type="number" placeholder="Type here"
                                                    class="input input-bordered w-full max-w-xs" min="1"
                                                    max="20" wire:model='woreda' />

                                            </label>
                                            @error('woreda')
                                                <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                                    role="alert">
                                                    <span class="font-medium">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="md:col-span-2">
                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Health Center Type</span>

                                                </div>
                                                <select class="select select-bordered" wire:model="type">
                                                    <option class="diabled" value="">choose health center type
                                                    </option>
                                                    @foreach ($types as $Zone)
                                                        <option value="{{ $Zone->id }}">{{ $Zone->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </label>
                                            @error('type')
                                                <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                                    role="alert">
                                                    <span class="font-medium">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="md:col-span-5 w-full">
                                            <label class="form-control w-full ">
                                                <div class="label">
                                                    <span class="label-text">Attach All the necessary Files as one pdf
                                                        file
                                                        <span class="badge badge-accent badge-outline">Max 2mb</span>
                                                    </span>


                                                </div>
                                                <input type="file" class="file-input file-input-bordered w-full "
                                                    accept=".pdf" wire:model="file" />

                                            </label>
                                            @error('file')
                                                <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                                    role="alert">
                                                    <span class="font-medium">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- <div wire:ignore class="md:col-span-5 w-full">
                                            <label class="form-control w-full ">
                                                <div class="label">
                                                    <span class="label-text">Available Departments</span>

                                                </div>
                                                <select wire:model="departmentlist" multiple id="testdropdown"
                                                    class="select select-bordered dark:border-gray-600">
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}">{{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </label>
                                        </div> --}}


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif





                    @if ($currentStep == 2)
                        <div class=" rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                                <div class="text-gray-600">
                                    <p class="font-medium text-lg">Liaison Office Details</p>
                                    <p>
                                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Follow this
                                        instuction while registering requirements</h2>
                                    <ul
                                        class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">

                                        <x-checkmark>Enter the health center Liaison Officer Full Name
                                        </x-checkmark>
                                        <x-checkmark>Enter a valid and working Liaison Office Phone Number
                                        </x-checkmark>


                                        </p>
                                </div>

                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                        <div class="md:col-span-2">
                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Liaison Officer</span>

                                                </div>
                                                <input type="text" placeholder="name"
                                                    class="input input-bordered w-full max-w-xs"
                                                    wire:model='liaison_officer' />

                                            </label>
                                            @error('liaison_officer')
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
                                                <label class="input input-bordered flex items-center ">
                                                    +251
                                                    <input type="text" pattern="[0-9]{9}" maxlength=9
                                                        minlength="9" class="grow outline-none"
                                                        placeholder="Phone Number" wire:model='phone_number' />
                                                </label>

                                            </label>
                                            @error('phone_number')
                                                <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                                    role="alert">
                                                    <span class="font-medium">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @endif




                @if ($currentStep == 3)
                    <div class=" rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                            <div class="text-gray-600">
                                <p class="font-medium text-lg">Health Center Details</p>
                                <p></p>
                            </div>

                            <div class="lg:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-2">
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Center Name</span>

                                            </div>
                                            <input type="text" placeholder="name" disabled
                                                class="input input-bordered w-full max-w-xs" wire:model='name' />

                                        </label>

                                    </div>
                                    <div class="md:col-span-3">
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Phone Number</span>

                                            </div>
                                            <label class="input input-bordered flex items-center ">
                                                +251
                                                <input type="text" pattern="[0-9]{9}" maxlength=9 minlength="9"
                                                    class="grow outline-none" placeholder="Phone Number"
                                                    wire:model='phone' disabled />
                                            </label>

                                        </label>

                                    </div>

                                    <div class="md:col-span-2">
                                        <label class="form-control w-full ">
                                            <div class="label">
                                                <span class="label-text">Center Email</span>

                                            </div>
                                            <input type="email" placeholder="email"
                                                class="input input-bordered w-full max-w-xs" wire:model='email'
                                                disabled />

                                        </label>

                                    </div>


                                    <div class="md:col-span-3">
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Region</span>

                                            </div>
                                            <select class="select select-bordered" wire:model.live='selectedregion'
                                                disabled>
                                                <option selected>Choose Region</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                @endforeach
                                            </select>
                                        </label>

                                    </div>




                                    <div class="md:col-span-2">
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Choose Zone</span>

                                            </div>
                                            <select class="select select-accent" wire:model.live='zone' disabled>
                                                @if (count($zones) == 0)
                                                    <option value="">No zone</option>
                                                @else
                                                    @foreach ($zones as $zone)
                                                        <option value="{{ $zone->id }}">{{ $zone->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>

                                    </div>
                                    <div class="md:col-span-1">
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Woreda </span>

                                            </div>
                                            <input type="number" placeholder="Type here"
                                                class="input input-accent w-full max-w-xs" min="1"
                                                wire:model='woreda' disabled />

                                        </label>

                                    </div>

                                    <div class="md:col-span-2">
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Health Center Type</span>

                                            </div>
                                            <select class="select select-accent" wire:model="type" disabled>
                                                <option class="diabled" value="">choose health center type
                                                </option>
                                                @foreach ($types as $Zone)
                                                    <option value="{{ $Zone->id }}">{{ $Zone->name }}</option>
                                                @endforeach

                                            </select>
                                        </label>

                                    </div>
                                    <div class="md:col-span-5 w-full">
                                        <label class="form-control w-full ">
                                            <div class="label">
                                                <span class="label-text">Attach All the necessary Files as one pdf file
                                                    <span class="badge badge-accent badge-outline">Max 2mb</span>
                                                </span>


                                            </div>
                                            <input type="file" class="file-input file-input-accent w-full "
                                                accept=".pdf" wire:model="file" disabled />

                                        </label>

                                    </div>
{{-- 
                                    <div wire:ignore class="md:col-span-5 w-full">
                                        <label class="form-control w-full ">
                                            <div class="label">
                                                <span class="label-text">Available Departments</span>

                                            </div>
                                            <select wire:model="departmentlist" multiple id="testdropdown"
                                                class="select select-accent dark:border-gray-600" disabled>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </label>
                                    </div> --}}


                                </div>
                            </div>
                        </div>

                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3 mt-14">
                            <div class="text-gray-600">
                                <p class="font-medium text-lg">Liaison Office Details</p>
                                <p></p>
                            </div>

                            <div class="lg:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-2">
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Liaison Officer</span>

                                            </div>
                                            <input type="text" placeholder="name"
                                                class="input input-bordered w-full max-w-xs"
                                                wire:model='liaison_officer' disabled />

                                        </label>

                                    </div>
                                    <div class="md:col-span-3">
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Phone Number</span>

                                            </div>
                                            <label class="input input-bordered flex items-center ">
                                                +251
                                                <input type="text" pattern="[0-9]{9}" maxlength=9 minlength="9"
                                                    class="grow outline-none" placeholder="Phone Number"
                                                    wire:model='phone_number' disabled />
                                            </label>

                                        </label>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                @endif
                @if ($currentStep == 4)
                    <div class=" rounded shadow-lg p-4 px-4 md:p-8 mb-6">

                        <div class="hero min-h-screen">
                            <div class="hero-content text-center">
                                <div class="">
                                    <div class="flex justify-center"> <svg xmlns="http://www.w3.org/2000/svg"
                                            width="200px" height="200px" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M8.81802 12.3107L10.9393 14.432L15.182 10.1893M21.75 12C21.75 17.3848 17.3848 21.75 12 21.75C6.61522 21.75 2.25 17.3848 2.25 12C2.25 6.61522 6.61522 2.25 12 2.25C17.3848 2.25 21.75 6.61522 21.75 12Z"
                                                stroke="#00ca92" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg></div>
                                    <h1 class="text-5xl font-bold">You Succeffully Registered</h1>

                                    <p class="py-6">You will be approved until
                                        {{ now()->addDays(10)->format('Y-m-d') }} ,Check your health center's username
                                        and password will be sent via <a href="mailto:{{ $registeredEmail }}"
                                            class="link link-success">{{ $registeredEmail }}</a> </p>
                                    <button type="button" class="btn btn-accent" wire:click='logout'>Get
                                        Started</button>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                <div class="flex justify-between">
                    @if ($currentStep == 1 || $currentStep == 3)
                        <div></div>
                    @endif

                    @if ($currentStep == 2)
                        <button type="button" class="btn btn-active" wire:click="decreaseStep()">Back</button>
                    @endif

                    @if ($currentStep == 1 || $currentStep == 2)
                        <button type="button" class="btn btn-md btn-success" wire:click="increaseStep">Next
                            <div wire:loading>
                                @include('utils.spinner')
                            </div>
                        </button>
                    @endif
                    @if ($currentStep == 3)
                        <button type="submit" class="btn btn-md btn-accent">Submit</button>
                    @endif
                </div>

            </div>
        </div>


    </form>
    @script
        <script>
            $(document).ready(function() {
                $('#testdropdown').select2();
                $('#testdropdown').on('change', function() {
                    let data = $(this).val();
                    console.log(data);
                    // $wire.set('companies', data, false);
                    // $wire.companies = data;
                    @this.companies = data;
                });
            });
        </script>
    @endscript

</div>
