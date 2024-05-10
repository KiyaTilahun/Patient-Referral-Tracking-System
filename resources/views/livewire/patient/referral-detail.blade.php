@php
    use Carbon\Carbon;

    
    $currentDate = Carbon::now()->format('Y-m-d');
    $referralDate = Carbon::parse($referral->referral_date)->format('Y-m-d');
   
@endphp
{{-- <div class="bg-white shadow dark:bg-gray-700 min-h-screen w-full  p-0 m-0"> --}}



   
 
<div class="md:bg-white md:shadow md:dark:bg-gray-700 min-h-screen w-full  p-0 m-0">
    @if($patient!=null)
        
    <x-mary-toast />
    <div class="p-4 md:p-5">
        <div class="flex justify-between w-full mb-6 "> <x-mary-button label="Go Back" wire:click="goBack"
                icon="o-arrow-left" />
            <span class="flex gap-4 flex-col md:flex-row">
                <select class="select select-primary " wire:model.live='selectedday'>
                    <option selected class="text-sm pt-0 mt-0">Choose Referral Date </option>
                    @foreach ($alldays as $day)
                        <option>{{ $day }}</option>
                    @endforeach
                </select>
                <x-mary-button label="{{ $referral->referral_date }}" icon="o-calendar"
                    class="btn-warning cursor-default" />

            </span>
        </div>
        <p class="text-lg font-normal text-gray-500 dark:text-gray-400 flex gap-4"><span>Referral Detail</span> </p>

        
            <div class="flex justify-end w-full gap-4">
              
                @if($hospitalid==$referral->referring_hospital_id)
                <x-mary-button label="Use Referral" class="btn btn-error" wire:click='tonewreferral()' icon="s-pencil-square"/>
             @endif
                @if (($currentDate < $referralDate) && ($referral->referrtype_id!=3)&& !($hospitalid==$referral->referring_hospital_id))
               
                <x-mary-button label="Change Appointment" class="btn btn-error" wire:click='changeAppointmentModal()' />
                @endif
                <a href="{{ route('generate.referralreport', ['id' => $referral->card_number,'date'=>$date]) }}" target="_blank">
                    <x-mary-button label="PRINT" icon="o-printer" class=" cursor-default" />
                </a>

            </div>
            <table class="table-auto table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col" colspan="3"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Referral Id</th>
                    <td class="dark:text-warning ">{{ $referral->card_number }}</td>
                    <th scope="row">Full Name</th>
                    <td class="dark:text-warning ">{{ $referral->patient->name }}</td>
                </tr>
                <tr>

                    <th scope="row">Gender</th>
                    <td class="dark:text-warning ">{{ $patient->gender->name }}</td>
                    <th scope="row">Blood Type</th>
                    <td class="dark:text-warning ">{{ $patient->bloodtype->name }}</td>

                </tr>
                <tr>
                    <th scope="row">Referred By</th>
                    <td class="dark:text-warning ">{{ $referral->referringHospital->name }}</td>
                    <th scope="row">Referred To</th>
                    <td class="dark:text-warning ">{{ $referral->receivingHospital->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Appointment Day:</th>
                    <td class="dark:text-warning ">{{ $referral->referral_date }}</td>
                    <th scope="row">Department:</th>
                    @if ($referral->referrtype_id != 3)
                        <td class="dark:text-warning ">{{ $referral->department->name }}</td>
                    @else
                        <td class="dark:text-warning ">-</td>
                    @endif
                </tr>

                <tr>
                    <th scope="row">History:</th>
                    <td colspan="3" class="dark:text-warning"><span
                            class="small text-xs">{{ $referral->history }}</span></td>
                </tr>

                <tr>
                    <th scope="row">Findings:</th>
                    <td colspan="3" class="dark:text-warning"><span
                            class="small text-xs">{{ $referral->findings }}</span></td>
                </tr>
                <tr>
                    <th scope="row">Treatment:</th>
                    <td colspan="3" class="dark:text-warning"><span
                            class="small text-xs">{{ $referral->treatment }}</span></td>
                </tr>
                <tr>
                    <th scope="row">Type:</th>
                    <td class="dark:text-warning">{{ $referral->referrtype->name }}</td>

                    <th scope="row">File:</th>
                    <td class="dark:text-warning">
                        @if (!is_null($referral->file_path))
                            <x-mary-button label="File is attached" class="btn-md" icon="o-link" tooltip="file"
                                wire:click="openpdf({{ $referral }})" type="button" />
                        @else
                            <x-mary-button label="No file" icon="o-link" tooltip="" />
                        @endif
                    </td>


                <tr>


                    <th scope="row">Referral Status</th>
                    <td class="dark:text-warning ">
                        <div class="form-control w-52">
                            <label class="cursor-default ">



                                @if ($referral->receivingHospital->id === $hospitalid)

                                    @foreach ($status as $key => $value)
                                        <button type="button"
                                            class="btn  {{ $key === $referral->statustype_id ? 'text-warning' : 'btn btn-outline btn-warning border border-sky-500' }}"
                                            wire:click="changeStatus({{ $key }})"
                                            @if ($key === $referral->statustype_id) disabled @endif>
                                            {{ Str::of($value)->headline() }}
                                        </button>
                                    @endforeach

                                    <input type="checkbox" class="toggle toggle-accent border-red-300"
                                        @if ($referral->statustype->name === 'completed') checked @endif />
                                @else
                                    <input type="checkbox" class="toggle toggle-accent"
                                        @if ($referral->statustype->name === 'completed') checked @endif disabled />
                                @endif

                                <span
                                    class="label-text {{ $referral->statustype->name !== 'completed' ? 'text-error' : '' }}
                        }}">{{ $referral->statustype->name }}</span>
                            </label>
                        </div>
                    </td>

                </tr>

                <tr>
                    <td>





                      
                        <x-mary-modal wire:model="appointmentmodal" class="backdrop-blur">
                            <form wire:submit="appointmentupdate">
                           
                            <div  class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white"> Edit Appointment</div>
                            @if ($config1 !== null)
                                <div> <x-mary-datepicker wire:model="updateddate" class="input input-bordered input-success" icon="o-calendar" :config="$config1" />    
                                </div>
                            @endif
                           
                            

                            <span class="flex flex-end gap-4 w-full mt-4">
                               <x-mary-button label="Cancel" @click="$wire.appointmentmodal = false" />
                                <x-mary-button type="submit" label="Confirm Change" class="btn-primary" spinner="appointmentupdate"/>
                            </span>
                        

                        </form>
                        </x-mary-modal>
                    

                       
                    </td>
                </tr>




            </tbody>

        </table>
    </div>

    @endif
</div>

