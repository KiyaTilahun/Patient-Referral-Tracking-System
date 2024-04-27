<?php

namespace App\Livewire\Hospital\Outbound;

use App\Models\Referral\Referral;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class OutboundDate extends Component
{
    use WithPagination;
    public $date;
    public $hospitalid;
    public array $sortBy = ['column' => 'referral_date', 'direction' => 'asc'];
    public $search;
    public $route;
    public $referral;
    public $chooseddate;

    public bool $myModal3 = false;

    public function mount($date)
    {
        $this->date = $date;
        $this->route = url()->previous();
    }

    public function goBack()
    {
        return redirect($this->route);
    }

    public function show($id)
    {
        // dd($id);

        $this->referral = Referral::where('id', $id)->with('patient')->first();

        $this->myModal3 = true;
    }

    public function openpdf($fileName)
    {


        $filePath = "Centers/{$fileName['file_path']}"; // Adjust the path based on your storage setup
        // dd($filePath);
        if (!Storage::disk('public')->exists($filePath)) {

            abort(404, 'File not found');
        }


        return Storage::download('public/' . $filePath);
    }
    public function render()
    {
        $this->hospitalid = auth()->user()->hospital->id;
        // dd($this->hospitalid);
        $centers = Referral::where('referral_date', $this->date)->when($this->search, function ($query) {
            $query->where('card_number', 'LIKE', '%' . $this->search . '%');
        })->withAggregate('receivingHospital', 'name')->withAggregate('statustype', 'name')->withAggregate('referrtype', 'name')->withAggregate('patient', 'name')->orderBy(...array_values($this->sortBy))->paginate(5);


        $headers = [
            ['key' => 'card_number', 'label' => 'Referral Id'],
            ['key' => 'receiving_hospital_name', 'label' => 'Referral To'],
            ['key' => 'patient_name', 'label' => 'Patient Name'],
            ['key' => 'referrtype_name', 'label' => 'Type'],
            ['key' => 'statustype_name', 'label' => 'Status'],       # <-- nested attributes

        ];



        return view('livewire.hospital.outbound.outbound-date', [
            'centers' => $centers, 'headers' => $headers,
            'sortBy' => $this->sortBy
        ]);
    }
}
