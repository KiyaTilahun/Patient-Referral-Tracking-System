import { initFlowbite } from 'flowbite';
import './bootstrap';
import 'flowbite';


// document.addEventListener("livewire:navigating",()=>{
// initFlowbite();
// });

document.addEventListener("livewire:navigated",()=>{

    
    initFlowbite();
    });
