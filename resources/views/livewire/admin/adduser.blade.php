<div>
    <x-mary-toast />
    <div class="pt-4 py-10"> <x-breadcrumb> <li class="inline-flex items-center">
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
          User Management
        </div>
      </li>
      <li aria-current="page">
        <div class="flex items-center">
          <svg class="w-3 h-3 text-gray-400 mx-1 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
          <span class="ms-1 text-sm font-medium dark:text-white text-blue-600 md:ms-2">Add User</span>
        </div>
      </li></x-breadcrumb>
      <x-page-heading :title="'Add User'" /></div>
    <form wire:submit.prevent="register">
       
    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3 ">
        <div class="text-gray-600">
            <p class="font-medium text-lg"> Add User</p>
            <p>

            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Follow this
                instuction while registering requirements</h2>
            <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">


                <x-checkmark>Choose the roles accordingly departments will be shown </x-checkmark>
                <x-checkmark>Enter a real woreda number if there is no one kebele number can be
                    used </x-checkmark>





            </ul>

            </p>
        </div>
       
            <div class="lg:col-span-2">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                    <div class="md:col-span-3">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">First Name</span>

                            </div>
                            <input type="text" placeholder="First Name" class="input input-bordered w-full max-w-xs"
                                wire:model='firstname' />

                        </label>
                        @error('firstname')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Last Name</span>

                            </div>
                            <input type="text" placeholder="Last Name" class="input input-bordered w-full max-w-xs"
                                wire:model='lastname' />

                        </label>
                        @error('lastname')
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
                                    class="grow outline-none" placeholder="Phone Number" wire:model='phone' />
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
                                <span class="label-text">User Email</span>

                            </div>
                            <input type="email" placeholder="email" class="input input-bordered w-full max-w-xs"
                                wire:model='email' />

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
                                <span class="label-text">Role</span>

                            </div>
                            <select class="select select-bordered" wire:model.live='role'>
                                <option selected>Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </label>
                        @error('role')
                            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>



                    @if ($isdoctor)
                        <div class="md:col-span-2">
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Choose Departments</span>

                                </div>
                                <select
                                    class="select select-bordered {{ !is_null($hospital->departments) ? ' select-accent' : 'select-bordered' }} "
                                    wire:model="dep">
                                    @if (!is_null($hospital->departments))
                                        @if (count($hospital->departments) == 0)
                                            <option value="">No Department</option>
                                        @else
                                        <option value="{{null}}">Departments</option>
                                            @foreach ($hospital->departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    @endif
                                </select>
                            </label>
                            @error('dep')
                                <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                    role="alert">
                                    <span class="font-medium">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>



                    @endif

                </div>
                <div class="flex justify-end pt-8 pr-20">
                    <button type="submit" class="btn btn-md btn-accent">Submit <div wire:loading>  @include('utils.spinner')</div></button>
                </div>
            </div>
      
    </div>
</form>
</div>
