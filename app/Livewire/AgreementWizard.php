<?php

namespace App\Livewire;

use App\Models\Agreement;
use Livewire\Component;

class AgreementWizard extends Component
{
    public Agreement $agreement;
    public int $currentStep = 1;

    // Step 3 - General Rules
    public bool $rulesRead = false;
    public string $section3Initials = '';

    // Step 4 - Damage & Liability
    public string $section4Initials = '';

    // Step 5 - Fuel & Mileage
    public string $section5Initials = '';

    // Step 6 - Prohibited Uses
    public string $section6Initials = '';

    // Step 7 - Additional Drivers
    public array $additionalDrivers = [];
    public bool $soleDriver = false;
    public string $section7Initials = '';
    public string $newDriverName = '';
    public string $newDriverLicense = '';

    // Step 8 - Signature
    public ?string $signature = null;

    public function mount(Agreement $agreement)
    {
        $this->agreement = $agreement;
        $this->currentStep = $agreement->current_step;

        // Load existing data
        $this->section3Initials = $agreement->section_3_initials ?? '';
        $this->section4Initials = $agreement->section_4_initials ?? '';
        $this->section5Initials = $agreement->section_5_initials ?? '';
        $this->section6Initials = $agreement->section_6_initials ?? '';
        $this->section7Initials = $agreement->section_7_initials ?? '';
        $this->additionalDrivers = $agreement->additional_drivers ?? [];
        $this->soleDriver = $agreement->sole_driver;
        $this->signature = $agreement->signature;

        // Mark rules as read if already confirmed
        $this->rulesRead = $agreement->section_3_confirmed;
    }

    public function confirmSection1()
    {
        $this->agreement->update([
            'section_1_confirmed' => true,
            'current_step' => 2,
        ]);
        $this->currentStep = 2;
    }

    public function confirmSection2()
    {
        $this->agreement->update([
            'section_2_confirmed' => true,
            'current_step' => 3,
        ]);
        $this->currentStep = 3;
    }

    public function confirmSection3()
    {
        $this->validate([
            'section3Initials' => 'required|string|min:1|max:10',
        ], [
            'section3Initials.required' => 'Please enter your initials.',
        ]);

        if (!$this->rulesRead) {
            $this->addError('rulesRead', 'Please confirm you have read the general rules.');
            return;
        }

        $this->agreement->update([
            'section_3_confirmed' => true,
            'section_3_initials' => $this->section3Initials,
            'current_step' => 4,
        ]);
        $this->currentStep = 4;
    }

    public function confirmSection4()
    {
        $this->validate([
            'section4Initials' => 'required|string|min:1|max:10',
        ], [
            'section4Initials.required' => 'Please enter your initials.',
        ]);

        $this->agreement->update([
            'section_4_confirmed' => true,
            'section_4_initials' => $this->section4Initials,
            'current_step' => 5,
        ]);
        $this->currentStep = 5;
    }

    public function confirmSection5()
    {
        $this->validate([
            'section5Initials' => 'required|string|min:1|max:10',
        ], [
            'section5Initials.required' => 'Please enter your initials.',
        ]);

        $this->agreement->update([
            'section_5_confirmed' => true,
            'section_5_initials' => $this->section5Initials,
            'current_step' => 6,
        ]);
        $this->currentStep = 6;
    }

    public function confirmSection6()
    {
        $this->validate([
            'section6Initials' => 'required|string|min:1|max:10',
        ], [
            'section6Initials.required' => 'Please enter your initials.',
        ]);

        $this->agreement->update([
            'section_6_confirmed' => true,
            'section_6_initials' => $this->section6Initials,
            'current_step' => 7,
        ]);
        $this->currentStep = 7;
    }

    public function addDriver()
    {
        $this->validate([
            'newDriverName' => 'required|string|max:255',
            'newDriverLicense' => 'required|string|max:100',
        ]);

        $this->additionalDrivers[] = [
            'name' => $this->newDriverName,
            'license_number' => $this->newDriverLicense,
        ];

        $this->newDriverName = '';
        $this->newDriverLicense = '';
    }

    public function removeDriver(int $index)
    {
        unset($this->additionalDrivers[$index]);
        $this->additionalDrivers = array_values($this->additionalDrivers);
    }

    public function confirmSection7()
    {
        $this->validate([
            'section7Initials' => 'required|string|min:1|max:10',
        ], [
            'section7Initials.required' => 'Please enter your initials.',
        ]);

        if (!$this->soleDriver && empty($this->additionalDrivers)) {
            $this->addError('drivers', 'Please add additional drivers or confirm you will be the sole driver.');
            return;
        }

        $this->agreement->update([
            'section_7_confirmed' => true,
            'section_7_initials' => $this->section7Initials,
            'additional_drivers' => $this->additionalDrivers,
            'sole_driver' => $this->soleDriver,
            'current_step' => 8,
        ]);
        $this->currentStep = 8;
    }

    public function signAgreement()
    {
        if (empty($this->signature)) {
            $this->addError('signature', 'Please provide your signature.');
            return;
        }

        $this->agreement->update([
            'signature' => $this->signature,
            'signed_at' => now(),
            'status' => 'signed',
            'current_step' => 8,
        ]);

        // Update registration status
        $this->agreement->registration->update(['status' => 'completed']);

        return redirect()->route('agreements.complete', $this->agreement);
    }

    public function goToStep(int $step)
    {
        // Can only go back to previously completed steps
        if ($step < $this->currentStep) {
            $this->currentStep = $step;
        }
    }

    public function render()
    {
        $this->agreement->load(['registration', 'vehicle', 'damageRecords']);

        return view('livewire.agreement-wizard');
    }
}
