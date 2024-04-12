<?php

namespace App\Livewire;

use App\Models\Admin\Appointmentslot;
use App\Models\Admin\Hospital;
use App\Models\Admin\Region;
use App\Models\DayDepartment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class Dashboard extends Component
{

    public $tablenames = ['hospitals', 'users'];
    public $selectedtable;
    public $selectedcolumn;
    public $config1;
    public $appday;
    public $columns = [];
    public $columnvalues = [];
    public function mount()
    {
        $currentDate = Carbon::now();
        $endDate = $currentDate->copy()->addDays(60);

        $availableDays = DayDepartment::where('department_hospital_id', 3)
            ->where('hospital_id', 1)
            ->pluck('day_id')
            ->toArray();

        $upcomingDates = [];

        while ($currentDate <= $endDate) {
            if (in_array($currentDate->dayOfWeekIso, $availableDays)) {
                $upcomingDates[] = $currentDate->format('Y/m/d');
            }


            $currentDate->addDay();
        }
        // dd($upcomingDates);

        $slots = AppointmentSlot::where('slotused', DB::raw('slotalotted'))
            ->where('availability', 'available')
            ->where('department_id', 3)
            ->where('hospital_id', 1)
            ->pluck('date')
            ->unique()
            ->toArray();
        // dd($slots);
        $upcomingDates = array_diff($upcomingDates, $slots);
        // dd($upcomingDates);


    //     $slots = Appointmentslot::where('slotused', '=', DB::raw('slotalotted'))
    //     ->where('availability', '=', 'available')
    //     ->get();
       
    //    $daysArray = [];
    //    foreach ($slots as $slot) {
    //     $date = $slot->date;
    //     if (!in_array($date, $daysArray)) {
    //         $daysArray[] = $date;
    //     }
    //    }
    //    for ($i = 0; $i < 5; $i++) {
       
    //     $nextSunday = Carbon::now()->addWeeks($i)->next(Carbon::SUNDAY)->format('Y/m/d');
       
    //     $daysArray[] = $nextSunday;
    //    }

    //    dd($daysArray);
        $this->config1 = $this->getConfig1($upcomingDates);
        $this->tablenames;
    }

        // calendar configuration
        public function getConfig1($daysArray)
        {
            return [
                'dateFormat' => 'Y/m/d',
                'enableTime' => false,
                'enable' => $daysArray,
                'minDate' => "today",
                'maxDate' => Carbon::now()->addDays(30)->format('Y/m/d'),
                'theme' => 'material_dark'
            ];
        }
    




    public function updatedSelectedTable($table_name)
    {

        // if($table_name=='hospitals'){


        // }
        $columns = Schema::getColumnListing($table_name);
        $filteredColumns = array_filter($columns, function ($column) {
            return !in_array($column, ['created_at', 'updated_at', 'remember_token', 'id', 'phone', 'country', 'filename', 'email', 'password', 'email_verified_at']);
        });
        $this->columns = $filteredColumns;
        if ($table_name == 'users') {
            $this->columns[] = 'type';
        }
    }

    public function updatedSelectedColumn($col_name)
    {

        if ($col_name == 'region_id') {
            $this->columnvalues = Region::all();
        } else {

            if ($this->selectedtable == 'hospitals') {


                $this->columnvalues = Hospital::distinct()->pluck($col_name);
                // dd($this->columnvalues);
            }
        }
        // $columns = Schema::getColumnListing($table_name);
        // $filteredColumns = array_filter($columns, function ($column) {
        //     return !in_array($column, ['created_at', 'updated_at']);
        // });
        // $this->columns=$filteredColumns;

    }
    public function render()
    {


        return view('livewire.dashboard');
    }
}
