<div>
    <x-mary-toast />
    {{-- <div class="flex justify-start my-4"> <x-mary-button label="Go Back" wire:click="goBack" icon="o-arrow-left" /></div> --}}
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
                Department Management
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <svg class="w-3 h-3 text-gray-400 mx-1 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="ms-1 text-sm font-medium  dark:text-white text-blue-600">Update Departments</span>
            </div>
        </li>
    </x-breadcrumb>
    <x-page-heading :title="'Update Departments'" />
    <div class="grid grid-cols-12">
        <div class="header col-span-12 rounded-lg bord py-8">
            {{-- <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Add</span> Department   </h1> --}}

        </div>

        <div class="md:col-span-7 col-span-12 w-full">

            <form wire:submit="adddep">
                <label wire:ignore class="form-control w-full ">
                    <div class="label">
                        <span class="label-text">Available Departments</span>

                    </div>

                    @php

                    @endphp


                    <x-mary-choices wire:model.live="departmentlist" :options="$newdep" key="$department->id" />

                </label>
                {{-- @error('departmentlist')
            <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                role="alert">
                <span class="font-medium">{{ $message }}</span>
            </div>
        @enderror --}}
                <div class="pt-4"> <x-mary-button label="Update Departments" class="btn-accent "
                        badge="{{ $numberchoosed }}" badge-classes="badge-warning" type="submit" spinner="save" />
                </div>
            </form>
        </div>

        <div class="col-span-1"></div>
        <div class="md:col-span-4 max-h-80 overflow-y-scroll col-span-12 pt-6 md:pt-0">
            <p class="font-medium text-lg"> Available Departments</p>
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Departments</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deps as $department)
                            <!-- row 1 -->
                            @if ($hospital->departments->contains($department->id))
                                <tr>
                                    <td>
                                        <x-checkmark>{{ $department->name }}</x-checkmark>
                                    </td>
                                    <td><x-mary-button icon="o-trash" class="text-red-500"
                                            wire:click.live="detachdep({{ $department->id }})"
                                            wire:key="{{ $department->id }}" spinner wire:confirm='are you sure?' />
                                    </td>
                                </tr>
                            @endif
                            <!-- row 2 -->
                        @endforeach
                    </tbody>

                </table>

            </div>





        </div>

    </div>



    <script>
        window.addEventListener('swal_remdep', function(e) {
            Swal.fire({
                icon: "warning",
                title: 'Are you sure to remove Department? ',
                showCancelButton: true,
                text: "Will be saved if you choose OK!",
                confirmButtonColor: "#d33",
                cancelButtonColor: "#00ca92",
                confirmButtonText: "Yes, Delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.dispatch('goremove');
                    Swal.fire({
                        title: "Deleted!",
                        text: "Centered  has been activated.",
                        icon: "warning"
                    });
                }


            });
        });
    </script>
</div>
