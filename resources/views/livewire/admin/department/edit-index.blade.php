<div>
    @if (!is_null($editable))

        <form wire:submit="adddays">
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Department name</span>

                </div>
                <input type="text" placeholder="{{ $editable['name'] }}" class="input input-bordered w-full max-w-xs"
                    disabled />
            </label>

            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Daily Referral Slot Available</span>

                </div>
                <input type="number" placeholder="{{ $slot }}" class="input input-bordered w-full max-w-xs"
                    wire:model='slot' min="0" value="{{$slot}} " />

            </label>

            <div class="header col-span-12 rounded-lg bord py-8">
                <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-xl"><span
                        class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Days</span>
                    Available </h1>


            </div>
            <div class="grid grid-cols-3 gap-5">
                @foreach ($days as $day)
                    <x-mary-checkbox label="{{ $day->name }}" wire:model="depdays" class="checkbox-warning"
                        value="{{ $day->id }}" omit-error />
                @endforeach
            </div>
            @error('depdays')
                <div class="p-2 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600" role="alert">
                    <span class="font-medium">{{ $message }}</span>
                </div>
            @enderror
            <div class="pt-4"> <x-mary-button label="Submit Update" class="btn-accent" type="submit"
                    spinner="save" /></div>
        </form>
    @else
        <label class="form-control w-full max-w-xs">
            <div class="label">
                <span class="label-text">Department name</span>

            </div>
            <input type="text" placeholder="Department Name" class="input input-bordered w-full max-w-xs" disabled />
        </label>

        <label class="form-control w-full max-w-xs">
            <div class="label">
                <span class="label-text">Daily Referral Slot Available</span>

            </div>
            <input type="text" placeholder="Availble slots" class="input input-bordered w-full max-w-xs"
                min="0" value="0" disabled />

        </label>
        <div class="header col-span-12 rounded-lg bord py-8">
            <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-xl"><span
                    class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Days</span>
                Available </h1>


        </div>
        <div class="grid grid-cols-3 gap-5">
            @foreach ($days as $day)
                <x-mary-checkbox label="{{ $day->name }}" wire:model="depdays" disabled />
            @endforeach
        </div>
    @endif
</div>
