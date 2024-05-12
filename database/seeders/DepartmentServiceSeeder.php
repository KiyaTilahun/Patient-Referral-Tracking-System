<?php

namespace Database\Seeders;

use App\Models\Admin\Department;
use App\Models\Admin\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


        $department_services = [
            'Internal Medicine' => [
                'General Checkups',
                'Chronic Disease Management',
                'Infectious Disease Care',
                'Respiratory Care',
                'Cardiovascular Assessments',
            ],
            'General Surgery' => [
                'Appendectomy',
                'Cholecystectomy',
                'Hernia Repair',
                'Thyroid Surgery',
                'Biopsy',
            ],
            'Pediatrics' => [
                'Well-child Checkups',
                'Vaccinations',
                'Developmental Assessments',
                'Common Illness Treatment',
                'School Physicals',
            ],
            'Neonatology' => [
                'Newborn Care',
                'Premature Baby Care',
                'Neonatal Intensive Care',
                'Newborn Screening',
                'Neonatal Jaundice Treatment',
            ],
            'Gynecology' => [
                'Pap Smears',
                'Pelvic Exams',
                'Contraceptive Counseling',
                'Menopause Management',
                'Breast Exams',
            ],
            'Obstetrics' => [
                'Prenatal Care',
                'Laboratory Testing',
                'Gestational Diabetes Screening',
                'Amniocentesis',
                'Cesarean Sections',
            ],
            'Orthopedics' => [
                'Bone Density Scans',
                'Joint Replacement Surgery',
                'Arthroscopy',
                'Fracture Care',
                'Spinal Surgery',
            ],
            'Intensive Care Unit (ICU)' => [
                'Cardiac Monitoring',
                'Blood Gases Analysis',
                'Hemodynamics Monitoring',
                'Intravenous Therapy',
                'Hemodialysis',
            ],
            'Ophthalmology' => [
                'Eye Exams',
                'Vision Correction',
                'Cataract Surgery',
                'Glaucoma Treatment',
                'Retina Exams',
            ],
            'Dentistry' => [
                'Dental Exams',
                'Teeth Cleaning',
                'Cavity Fillings',
                'Root Canals',
                'Tooth Extractions',
            ],
            'Otorhinolaryngology (ENT)' => [
                'Ear Examinations',
                'Hearing Tests',
                'Sinus Endoscopy',
                'Tonsillectomy',
                'Adenoidectomy',
            ],
            'Psychiatry' => [
                'Psychiatric Evaluations',
                'Medication Management',
                'Psychotherapy',
                'Mood Disorder Assessment',
                'Personality Disorder Testing',
            ],
            'Plastic Surgery' => [
                'Rhinoplasty',
                'Breast Augmentation',
                'Liposuction',
                'Tummy Tucks',
                'Facelifts',
            ],
            'Burn Unit' => [
                'Reconstructive Surgery',
                'Scar Revision',
                'Burn Reconstruction',
                'Skin Grafting',
                'Burn Wound Care',
            ],
            'Urology' => [
                'Prostate Examinations',
                'Kidney Function Testing',
                'Bladder Scans',
                'Ureteroscopy',
                'Lithotripsy',
            ],
            'Physiotherapy' => [
                'Physical Therapy Assessments',
                'Muscle Strength Testing',
                'Joint Mobility Evaluation',
                'Gait Analysis',
                'Post-Operative Rehabilitation',
            ],
            'Dermatology' => [
                'Skin Exams',
                'Biopsies',
                'Laser Skin Treatment',
                'Mole Removal',
                'Acne Treatment',
            ],
            'Neurology' => [
                'Neurological Exams',
                'EEG (Electroencephalogram)',
                'EMG (Electromyography)',
                'Nerve Conduction Studies',
                'MRI Scans',
            ],
            'Cardiology' => [
                'Echocardiogram',
                'Electrocardiogram (ECG/EKG)',
                'Holter Monitor',
                'Cardiac Catheterization',
                'Pacemaker Implantation',
            ],
            'Gastroenterology' => [
                'Upper Endoscopy',
                'Colonoscopy',
                'Liver Biopsy',
                'ERCP (Endoscopic Retrograde Cholangiopancreatography)',
                'Capsule Endoscopy',
            ],
            'Endocrinology' => [
                'Thyroid Function Tests',
                'Diabetes Management',
                'Adrenal Function Tests',
                'Pituitary Function Tests',
                'Osteoporosis Screening',
            ],
            'Pulmonology' => [
                'Pulmonary Function Testing',
                'Bronchoscopy',
                'Sleep Studies',
                'Thoracentesis',
                'Ventilator Management',
            ],
        ];

        foreach ($department_services as $departmentName => $services) {
            $department = Department::create(['name' => $departmentName]);
            foreach ($services as $serviceName) {
                $service = Service::firstOrCreate(['name' => $serviceName]);
                $department->services()->attach($service);
            }
        }
    }
}
