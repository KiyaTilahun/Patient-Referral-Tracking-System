<div class="mx-auto grid grid-cols-12 gap-4  p-1">
    <x-mary-toast />

    <div class="header col-span-12 rounded-lg bord py-4">
        {{-- <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-5xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Center</span> Management   </h1> --}}
        <x-breadcrumb>
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center ms-1 text-sm font-medium text-gray-700  md:ms-2 dark:text-gray-400">
                    <svg class="w-3 h-3 text-gray-400 mx-1 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    Roles and Permission
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium  dark:text-white text-blue-600"> All</span>
                </div>
            </li>
        </x-breadcrumb>
        <x-page-heading :title="'Roles and  Permissions'" />

    </div>
    <div class="col-span-12 md:col-span-6">
        <p class="font-medium text-lg"> All Roles</p>

        @foreach ($roles as $role)
            <x-mary-list-item :item="$role">
                <x-slot:actions>

                    <x-mary-button icon="s-pencil-square" class="text-green-500"
                        wire:click="showrole({{ $role->id }})" spinner />

                </x-slot:actions>
            </x-mary-list-item>
        @endforeach
    </div>


    <div class="col-span-12 md:col-span-5">
        {{-- <livewire:role-permission.permission-edit> --}}

        <div class="md:col-span-4 max-h-80 overflow-y-scroll col-span-12 pt-6 md:pt-0">
            <p class="font-medium text-lg"> All Permissions</p>
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $perm)
                            <!-- row 1 -->

                            <tr>
                                <td>
                                    <x-checkmark>{{ $perm->name }}</x-checkmark>
                                </td>
                                <td><x-mary-button icon="c-pencil-square" class="text-green-500"
                                        wire:click="showperm({{ $perm->id }})" spinner />
                                </td>
                            </tr>

                            <!-- row 2 -->
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>


    <x-mary-modal wire:model="myModal1" class="backdrop-blur">

        <form wire:submit.prevent="updatepermission">
            <div class="flex items-center justify-between p-2 ">
                <span class=" btn-warning btn w-fit cursor-default">Edit
                    Permission</span>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    @click="$wire.myModal1 = false">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>

                </button>
            </div>

            <div class="mt-4">

                @if ($myModal1)
                    <x-mary-input placeholder="Permission" icon="o-shield-check" hint="use small letters"
                        wire:model='updatedpermission' />
                @endif
            </div>
            <div class="text-right"> <x-mary-button label="Update" class="btn btn-outline btn-primary" type="submit" />
            </div>
        </form>
    </x-mary-modal>


    <x-mary-modal wire:model="myModal2" class="backdrop-blur">
        <form wire:submit.prevent="updaterole">
            <div class="flex items-center justify-end p-2 ">

                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    @click="$wire.myModal2 = false">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>

                </button>
            </div>
            <div class="flex flex-col ">
                <span class=" cursor-default w-fit">Edit
                    Role</span>


                @if (true)
                    <div class="mt-4">
                        <x-mary-input placeholder="Your name" icon="o-shield-check" wire:model='updatedrole' autofocus/>
                    </div>
                    <div class="text-right mt-4"> <x-mary-button label="Update" class="btn btn-outline btn-primary" type="submit" />
                    </div>
                @endif
                <span
                    class=" mt-4 inline-flex items-center justify-center px-2 py-0.5 ms-3 text-l font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400  ">
                    All &nbsp;<span class="text-warning"> {{ $updatedrole }} </span> &nbsp; permissions </span>
                    <div class="">
                        @error('permissionsrole')
                        <div class="px-2 ms-3 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                            role="alert">
                            <span class="font-medium">{{ $message }}</span>
                        </div>
                    @enderror
                        <div class="grid h-[300px] overflow-y-scroll ">
                            @foreach ($permissions as $per)
                                <x-mary-checkbox label="{{ $per->name }}" wire:model="permissionsrole"
                                    class="checkbox-warning my-2" value="{{ $per->id }}" omit-error />
                            @endforeach
                        </div>
                    </div>
            </div>
        </form>

    </x-mary-modal>






</div>
