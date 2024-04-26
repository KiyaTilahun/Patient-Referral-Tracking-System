<div wire:poll class="w-full">

    <x-mary-header title="Centers" subtitle="Search centers">
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-magnifying-glass" class="border-green-500 focus:border-green-500"
                wire:model.live='search' placeholder="Search..." />
        </x-slot:middle>




    </x-mary-header>

    <x-mary-table :headers="$headers" :rows="$centers" :sort-by="$sortBy" with-pagination>

        @scope('cell_status', $center)
            <x-mary-badge :value="$center->status == 1 ? 'Active' : 'Inactive'"
                class="{{ $center->status ? 'btn-outline btn-success btn-disabled' : 'btn-outline btn-warning btn-disabled' }}" />
        @endscope
        @scope('actions', $center)
            <x-mary-button icon="c-pencil-square" class="text-green-500 btn-sm" wire:click="show({{ $center->id }})"
                spinner />
        @endscope
    </x-mary-table>
</div>
