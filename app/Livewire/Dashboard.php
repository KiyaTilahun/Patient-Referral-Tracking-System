<?php

namespace App\Livewire;

use App\Models\Admin\Appointmentslot;
use App\Models\Admin\Hospital;
use App\Models\Admin\Region;
use App\Models\DayDepartment;
use App\Models\Referral\Referral;
use App\Models\User;
use App\Models\Users\Patient;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Dashboard extends Component
{

    public $tablenames = ['hospitals', 'users'];
    public $selectedtable;
    public $selectedcolumn;
    public $config1;
    public $myChart = [];
    public $myChart2 = [];
    public $centercount;
    public $referralcount;
    public $regioncount;
    public $patientcount;
    public $hospitalusers;
    public $inboundcount;
public $outboundcount;
public $user;


    public function mount()
    {
        $userid=auth()->user()->id;
$this->user=User::where('id',$userid)->first();

        
        $username=$this->user->name;
        Session::put('user', $username);
        if($this->user->hasRole('superadmin')){

            $this->referralcount = Referral::count(); 
        $this->centercount = Hospital::where('registered',1)->count();
        $this->patientcount = Patient::count();
        $hospitalsByRegion = Hospital::selectRaw('region_id, COUNT(*) as center_count')
            ->groupBy('region_id')
            ->get();

            $this->regioncount=count($hospitalsByRegion);
        $regions = [];
        $centerCounts = [];

        foreach ($hospitalsByRegion as $data) {
            $regions[] = $data->region->name;       // Names of regions
            $centerCounts[] = $data->center_count; // Number of centers in each region
        }

        $this->myChart = [
            'type' => 'bar',
            'data' => [
                'labels' => $regions,
                'datasets' => [
                    [
                        'label' => 'Number of Medical Centers by Region',
                        'data' => $centerCounts,
                    ]
                ]
            ]
        ];

        $hospitalsByType = Hospital::select('type_id', DB::raw('COUNT(*) as count_by_type_id'))
                           ->groupBy('type_id')
                           ->get();
                           
    $types = [];
    $typeCounts = [];

    foreach ($hospitalsByType as $data) {
        $types[] = $data->type->name; // Get each hospital type
        $typeCounts[] = $data->count_by_type_id; // Get the count of each type
    }

    $this->myChart2= [
        'type' => 'pie',
        'data' => [
            'labels' => $types, // The different types of hospitals
            'datasets' => [
                [
                    'label' => 'Count of Hospitals by Type',
                    'data' => $typeCounts, // The counts corresponding to each type
                ]
            ]
        ]
    ];
        }
        elseif ($this->user->hasRole('admin')){
            // dd("Admin");
 $this->hospitalusers = User::where('hospital_id',$this->user->hospital_id)->count(); 
        $this->patientcount = Patient::where('hospital_id',$this->user->id)->count();
        $this->outboundcount = Referral::where('referring_hospital_id',$this->user->hospital_id)->count();
        $this->inboundcount = Referral::where('receiving_hospital_id',$this->user->hospital_id)->count();

        $typeCounts[]=[$this->outboundcount,3];
        $types[]=["Out Bound Refrrals","Inobund Referrals"];
        // dd($typeCounts);
        $this->myChart2= [
            'type' => 'pie',
            'data' => [
                'labels' => $types, // The different types of hospitals
                'datasets' => [
                    [
                        'label' => 'Count of Hospitals by Type',
                        'data' => $typeCounts, // The counts corresponding to each type
                    ]
                ]
            ]
        ];

      
        }
        else{
            $this->outboundcount = Referral::where('referring_hospital_id',$this->user->hospital_id)->count();
        $this->inboundcount = Referral::where('receiving_hospital_id',$this->user->hospital_id)->count();
        }
    }
    
    public function switch()
{
    $type = $this->myChart['type'] == 'bar' ? 'pie' : 'bar';
    Arr::set($this->myChart, 'type', $type);
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





  

   
    public function render()
    {


        return view('livewire.dashboard');
    }
}
