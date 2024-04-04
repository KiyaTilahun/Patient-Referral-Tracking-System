<div>
    <form wire:submit.prevent="register">
    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
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
                    <div class="md:col-span-2">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">User Name</span>

                            </div>
                            <input type="text" placeholder="name" class="input input-bordered w-full max-w-xs"
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
