<?php

namespace Database\Seeders;

use App\Models\Admin\Department;
use App\Models\Admin\DepartmentService;
use App\Models\Admin\Hospital;
use App\Models\Admin\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $all_services = [
            'General Checkups',
            'Chronic Disease Management',
            'Infectious Disease Care',
            'Respiratory Care',
            'Cardiovascular Assessments',
            'Endocrine Tests',
            'Hematology Tests',
            'Clinical Chemistry',
            'Lipid Profile',
            'Blood Pressure Monitoring',
            'Appendectomy',
            'Cholecystectomy',
            'Hernia Repair',
            'Thyroid Surgery',
            'Biopsy',
            'Colonoscopy',
            'Laparoscopic Surgery',
            'Breast Surgery',
            'Gastrointestinal Surgery',
            'Preoperative Laboratory Testing',
            'Well-child Checkups',
            'Vaccinations',
            'Developmental Assessments',
            'Common Illness Treatment',
            'School Physicals',
            'Respiratory Function Tests',
            'Hemoglobin Levels',
            'Urinalysis',
            'Allergy Testing',
            'Lead Screening',
            'Newborn Care',
            'Premature Baby Care',
            'Neonatal Intensive Care',
            'Newborn Screening',
            'Neonatal Jaundice Treatment',
            'Ventilation Support',
            'Heart Rate Monitoring',
            'Metabolic Screening',
            'Hearing Screening',
            'Pap Smears',
            'Pelvic Exams',
            'Contraceptive Counseling',
            'Menopause Management',
            'Breast Exams',
            'Hormone Testing',
            'Ultrasound Scans',
            'Endometrial Biopsy',
            'Cervical Biopsy',
            'Mammograms',
            'Prenatal Care',
            'Laboratory Testing',
            'Gestational Diabetes Screening',
            'Amniocentesis',
            'Cesarean Sections',
            'Labor and Delivery',
            'Postnatal Care',
            'Fetal Heart Rate Monitoring',
            'Bone Density Scans',
            'Joint Replacement Surgery',
            'Arthroscopy',
            'Fracture Care',
            'Spinal Surgery',
            'Sports Medicine',
            'Orthopedic Laboratory Testing',
            'Cartilage Regeneration',
            'Musculoskeletal Ultrasound',
            'Bone Marrow Aspiration',
            'Cardiac Monitoring',
            'Blood Gases Analysis',
            'Hemodynamics Monitoring',
            'Intravenous Therapy',
            'Hemodialysis',
            'Electrolyte Analysis',
            'Sedation Management',
            'Infection Control',
            'Eye Exams',
            'Vision Correction',
            'Cataract Surgery',
            'Glaucoma Treatment',
            'Retina Exams',
            'Corneal Topography',
            'OCT Scans',
            'Laser Eye Surgery',
            'Contact Lens Fittings',
            'Color Vision Testing',
            'Dental Exams',
            'Teeth Cleaning',
            'Cavity Fillings',
            'Root Canals',
            'Tooth Extractions',
            'Dental X-rays',
            'Orthodontics',
            'Periodontal Care',
            'Dental Implants',
            'Oral Cancer Screening',
            'Ear Examinations',
            'Hearing Tests',
            'Sinus Endoscopy',
            'Tonsillectomy',
            'Adenoidectomy',
            'Septoplasty',
            'Rhinoplasty',
            'Laryngoscopy',
            'Throat Cultures',
            'Sleep Apnea Testing',
            'Psychiatric Evaluations',
            'Medication Management',
            'Psychotherapy',
            'Mood Disorder Assessment',
            'Personality Disorder Testing',
            'Neuropsychological Tests',
            'Substance Abuse Screening',
            'Cognitive Behavioral Therapy',
            'Electroconvulsive Therapy',
            'Family Therapy',
            'Rhinoplasty',
            'Breast Augmentation',
            'Liposuction',
            'Tummy Tucks',
            'Facelifts',
            'Reconstructive Surgery',
            'Scar Revision',
            'Burn Reconstruction',
            'Skin Grafting',
            'Botox Injections',
            'Burn Wound Care',
            'Skin Grafting',
            'Wound Debridement',
            'Pain Management',
            'Nutrition Support',
            'Burn Rehabilitation',
            'Hyperbaric Oxygen Therapy',
            'Plastic Surgery Consultations',
            'Burn Scar Management',
            'Urinalysis',
            'Prostate Examinations',
            'Kidney Function Testing',
            'Bladder Scans',
            'Ureteroscopy',
            'Lithotripsy',
            'Vasectomy',
            'Erectile Dysfunction Treatment',
            'Urinary Incontinence Treatment',
            'Prostate Biopsy',
            'Physical Therapy Assessments',
            'Muscle Strength Testing',
            'Joint Mobility Evaluation',
            'Gait Analysis',
            'Post-Operative Rehabilitation',
            'Sports Injury Treatment',
            'Electrotherapy',
            'Hydrotherapy',
            'Manual Therapy',
            'Orthotic Fitting',
            'Skin Exams',
            'Biopsies',
            'Laser Skin Treatment',
            'Mole Removal',
            'Acne Treatment',
            'Psoriasis Therapy',
            'Eczema Care',
            'Hair Loss Treatment',
            'Allergy Testing',
            'Skin Cancer Screening',
            'Neurological Exams',
            'EEG (Electroencephalogram)',
            'EMG (Electromyography)',
            'Nerve Conduction Studies',
            'MRI Scans',
            'CT Scans',
            'Lumbar Puncture',
            'Doppler Ultrasound',
            'Cognitive Function Testing',
            'Headache Management',
            'VIP Services',
            'Private Rooms',
            'Specialized Care',
            'Exclusive Amenities',
            'Concierge Services',
            'Personalized Meal Plans',
            'Dedicated Nursing Staff',
            'Private Consultations',
            'Priority Scheduling',
            'Personal Assistants'
        ];
        

    foreach ($all_services as $serviceName) {
        Service::create(['name' => $serviceName]); 
    }

    // DepartmentService
//     $services = Service::all(); 
        
//     // Get all departments
//     $departments = Department::all();
//     foreach ($departments as $department) {
//         // Get 4 random services from the collection
//         $randomServices = $services->random(4);
// // dd($randomServices);
//         // Attach these services to the department
//         $department->services()->attach($randomServices);
//     }


// hospital service
    // $hospitals = Hospital::all();
    //     $departmentServices = DepartmentService::all();
 
    //     foreach ($hospitals as $hospital) {
    //         $hospitalDepartments = $hospital->departments;
    //         if ($hospitalDepartments->isEmpty()) {
    //             continue;
    //         }
    //         $randomDepartment = $hospitalDepartments->random(1)->first();
    //         $filteredDepartmentServices = $departmentServices->where('department_id', $randomDepartment->id);

    //         if ($filteredDepartmentServices->isEmpty()) {

    //             continue;
    //         }
    //         $randomDepartmentServices = $filteredDepartmentServices->random(1)->first();
           
    //         $hospital->departmentServices()->attach($randomDepartmentServices ,[
    //             'department_id' => $randomDepartment->id]);

    //     }

    }
}
