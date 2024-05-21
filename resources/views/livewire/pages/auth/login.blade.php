<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $j=$this->validate();
        // dd($j);
        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
   
}; ?>


<div >

 
        
    <div class="toast toast-top  toast-start">
        
        {{-- <div class="alert alert-success bg-[#00ca92]"> --}}
        <div class="alert alert-success bg-warning">

          <a href="{{route('registerhealth')}}" wire:navigate>Register Your Health Centre <x-mary-icon name="s-home" class=" " /> </a>
        </div>
      </div>

      <div class="toast toast-top  toast-end">
        
        {{-- <div class="alert alert-success bg-[#00ca92]"> --}}
            <x-mary-button icon="o-information-circle" label="About" class="text-warning" onclick="modal17.showModal()" spinner />
      </div>


      <x-mary-modal id="modal17" class="backdrop-blur-sm" >
        <p>

            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Welcome To Patient Referral Tracking System </h2>
            <h3 class="mb-2 text-warning text-xs"> Are you new to the system,dont worry we have got you covered</h3>
            <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">


                <x-checkmark>PRTS is a referral tracking system for health centers connecting health centers depatments with their schedules</x-checkmark>
                <span>Not intersted yet, <a href="{{route('registerhealth')}}" wire:navigate class="text-warning">Register</a> your center now and see all the things that the system gives you  </span>





            </ul>

            </p>
     
        <x-slot:actions>
            {{-- Notice `onclick` is HTML --}}
            
            <x-mary-button label="Close" class="btn-warning" onclick="modal17.close()"  />
        </x-slot:actions>
    </x-mary-modal>

   
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="grid grid-cols-12 gap-4 relative">
        {{-- <div class="md:flex hidden absolute  inset-0  justify-center  text-warning z-50  "><div class="font-semibold w-fit text-xl btn btn-success ">Login into Your Account</div></div> --}}
        {{-- <div class="col-span-6 hidden sm:flex items-center justify-center " style="background-image:url('{{ asset('images/loginlogo.jpg') }}');background-size: cover;" > --}}
            <div class="col-span-6 hidden sm:flex items-center justify-center relative  "  ><img src="{{ asset('images/mylogo.png') }}" class="backdrop-blur-lg w-full " alt="Example Image from Storage">    <figcaption class="absolute px-4 text-lg text-white bottom-2 ">
                <div class="font-semibold w-fit text-xl text-warning">Login into Your Account</div>
            </figcaption></div>
        <div class="col-span-12 sm:col-span-6 h-full flex items-center px-4 py-4 md:pt-8 z-[9999]  ">
        <form wire:submit="login" class="w-full " >
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" value="{{ old('username') }}" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
    
                <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full "
                                type="password"
                                name="password"
                                required autocomplete="current-password"  value="{{ old('current-password') }}"/>
    
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>
    
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>
    
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
    
                <x-primary-button class="ms-3 btn-accent ">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
    </div>
 

    
</div>
