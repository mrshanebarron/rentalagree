<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #2D2D2D; line-height: 1.5; margin: 0; padding: 20px; }
        .header { text-align: center; border-bottom: 3px solid #1C3557; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { color: #1C3557; font-size: 24px; margin: 0 0 5px 0; }
        .header p { color: #666; font-size: 10px; margin: 2px 0; }
        .agreement-number { color: #1C3557; font-size: 14px; font-weight: bold; }
        .section { margin-bottom: 15px; page-break-inside: avoid; }
        .section-title { background: #1C3557; color: white; padding: 6px 12px; font-size: 12px; font-weight: bold; margin-bottom: 8px; }
        .info-grid { width: 100%; border-collapse: collapse; }
        .info-grid td { padding: 4px 8px; font-size: 10px; vertical-align: top; }
        .info-grid .label { color: #666; width: 35%; }
        .info-grid .value { font-weight: bold; }
        .terms-section { background: #f8f6f0; padding: 10px; margin-bottom: 8px; border: 1px solid #D4CFC7; font-size: 9px; }
        .terms-section h4 { color: #1C3557; margin: 0 0 5px 0; font-size: 11px; }
        .initials-box { display: inline-block; border: 1px solid #1C3557; padding: 2px 8px; font-family: monospace; font-size: 12px; font-weight: bold; color: #1C3557; margin-left: 10px; }
        .signature-block { margin-top: 20px; border-top: 2px solid #1C3557; padding-top: 15px; }
        .signature-img { max-height: 60px; border: 1px solid #D4CFC7; }
        .cost-table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        .cost-table td { padding: 3px 8px; font-size: 10px; }
        .cost-table .total td { border-top: 2px solid #1C3557; font-weight: bold; font-size: 12px; color: #1C3557; }
        .footer { position: fixed; bottom: 0; left: 0; right: 0; text-align: center; font-size: 8px; color: #999; border-top: 1px solid #D4CFC7; padding: 8px 20px; }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>CuraRent</h1>
        <p>Digital Car Rental Agreement</p>
        <p>Kaya Damasco 12, Willemstad, Curacao | +599 9 461 2345 | info@curarent.com</p>
        <p style="margin-top: 10px;"><span class="agreement-number">{{ $agreement->agreement_number }}</span></p>
    </div>

    <!-- Customer Information -->
    <div class="section">
        <div class="section-title">Customer Information</div>
        <table class="info-grid">
            <tr>
                <td class="label">Full Name</td>
                <td class="value">{{ $agreement->registration->full_name }}</td>
                <td class="label">Email</td>
                <td class="value">{{ $agreement->registration->email }}</td>
            </tr>
            <tr>
                <td class="label">Phone</td>
                <td class="value">{{ $agreement->registration->phone }}</td>
                <td class="label">Date of Birth</td>
                <td class="value">{{ $agreement->registration->date_of_birth->format('M d, Y') }}</td>
            </tr>
            <tr>
                <td class="label">License Number</td>
                <td class="value">{{ $agreement->registration->license_number }}</td>
                <td class="label">License Country</td>
                <td class="value">{{ $agreement->registration->license_country }}</td>
            </tr>
            <tr>
                <td class="label">Emergency Contact</td>
                <td class="value">{{ $agreement->registration->emergency_contact_name }}</td>
                <td class="label">Emergency Phone</td>
                <td class="value">{{ $agreement->registration->emergency_contact_phone }}</td>
            </tr>
        </table>
    </div>

    <!-- Vehicle Information -->
    <div class="section">
        <div class="section-title">Vehicle Information</div>
        <table class="info-grid">
            <tr>
                <td class="label">Vehicle</td>
                <td class="value">{{ $agreement->vehicle->full_name }}</td>
                <td class="label">License Plate</td>
                <td class="value">{{ $agreement->vehicle->license_plate }}</td>
            </tr>
            <tr>
                <td class="label">Color</td>
                <td class="value">{{ $agreement->vehicle->color }}</td>
                <td class="label">Category</td>
                <td class="value" style="text-transform: capitalize;">{{ $agreement->vehicle->category }}</td>
            </tr>
            <tr>
                <td class="label">Odometer at Pickup</td>
                <td class="value">{{ number_format($agreement->vehicle->current_mileage) }} km</td>
                <td class="label">VIN</td>
                <td class="value">{{ $agreement->vehicle->vin ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <!-- Rental Period & Rates -->
    <div class="section">
        <div class="section-title">Rental Period & Rates</div>
        <table class="info-grid">
            <tr>
                <td class="label">Pickup Date</td>
                <td class="value">{{ $agreement->pickup_date->format('l, M d, Y') }}</td>
                <td class="label">Return Date</td>
                <td class="value">{{ $agreement->return_date->format('l, M d, Y') }}</td>
            </tr>
        </table>
        <table class="cost-table">
            <tr>
                <td>Daily Rate</td>
                <td style="text-align: right;">${{ number_format($agreement->daily_rate, 2) }} x {{ $agreement->rental_days }} days</td>
                <td style="text-align: right; width: 100px;">${{ number_format($agreement->total_cost, 2) }}</td>
            </tr>
            <tr>
                <td>Insurance ({{ ucfirst($agreement->insurance_option) }} CDW)</td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;">${{ number_format($agreement->insurance_cost, 2) }}</td>
            </tr>
            <tr>
                <td>Security Deposit (refundable)</td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;">${{ number_format($agreement->deposit_amount, 2) }}</td>
            </tr>
            <tr class="total">
                <td>Total Due</td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;">${{ number_format($agreement->total_cost + $agreement->insurance_cost, 2) }}</td>
            </tr>
        </table>
    </div>

    <!-- Terms & Conditions Acknowledgements -->
    <div class="section">
        <div class="section-title">Terms & Conditions Acknowledgements</div>

        <div class="terms-section">
            <h4>General Rules <span class="initials-box">{{ $agreement->section_3_initials }}</span></h4>
            <p>The renter has read and agreed to the general rules including traffic laws, fuel policy (full-to-full), no off-road use, and reporting obligations for breakdowns and accidents.</p>
        </div>

        <div class="terms-section">
            <h4>Damage & Liability <span class="initials-box">{{ $agreement->section_4_initials }}</span></h4>
            <p>The renter acknowledges pre-existing damage records (if any) and understands liability terms under the selected {{ ucfirst($agreement->insurance_option) }} CDW insurance option.</p>
        </div>

        <div class="terms-section">
            <h4>Fuel & Mileage Policy <span class="initials-box">{{ $agreement->section_5_initials }}</span></h4>
            <p>Full-to-full fuel policy with $15 service fee for non-compliance. Unlimited mileage included. Odometer reading: {{ number_format($agreement->vehicle->current_mileage) }} km.</p>
        </div>

        <div class="terms-section">
            <h4>Prohibited Uses <span class="initials-box">{{ $agreement->section_6_initials }}</span></h4>
            <p>No subletting, racing, towing, DUI, off-road use, or commercial use. Vehicle restricted to Curacao island. Violations void all insurance coverage.</p>
        </div>

        <div class="terms-section">
            <h4>Additional Drivers <span class="initials-box">{{ $agreement->section_7_initials }}</span></h4>
            @if($agreement->sole_driver)
                <p>The renter confirms they will be the sole driver of the vehicle.</p>
            @elseif($agreement->additional_drivers && count($agreement->additional_drivers))
                <p>Additional authorized drivers:</p>
                @foreach($agreement->additional_drivers as $driver)
                    <p style="margin-left: 15px;">- {{ $driver['name'] }} (License: {{ $driver['license_number'] }})</p>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Signature -->
    <div class="signature-block">
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%;">
                    <p style="font-size: 10px; color: #666; margin-bottom: 5px;">Customer Signature:</p>
                    @if($agreement->signature)
                        <img src="{{ $agreement->signature }}" class="signature-img" alt="Signature">
                    @endif
                    <p style="font-weight: bold; margin-top: 5px;">{{ $agreement->registration->full_name }}</p>
                </td>
                <td style="width: 50%; text-align: right;">
                    <p style="font-size: 10px; color: #666; margin-bottom: 5px;">Date & Time of Signing:</p>
                    <p style="font-weight: bold;">{{ $agreement->signed_at ? $agreement->signed_at->format('M d, Y \a\t g:i A') : 'Not yet signed' }}</p>
                    <p style="font-size: 10px; color: #666; margin-top: 10px;">Processed by:</p>
                    <p style="font-weight: bold;">{{ $agreement->user->name }}</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>CuraRent &mdash; Kaya Damasco 12, Willemstad, Curacao &mdash; +599 9 461 2345 &mdash; info@curarent.com</p>
        <p>Agreement {{ $agreement->agreement_number }} &mdash; Generated {{ now()->format('M d, Y g:i A') }}</p>
    </div>
</body>
</html>
