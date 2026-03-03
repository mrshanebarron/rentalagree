# SPEC.md — RentalAgree

## Job Summary
**Job #3026** — Custom Car Rental Reservation & Digital Agreement System
**Client**: Car rental business in Curacao (Caribbean island)
**Budget**: $1,500
**Problem**: Currently using paper forms. Wants to digitize the rental agreement process.
**End User**: Car rental customers arriving in Curacao — tourists, visitors, locals renting vehicles.
**Business Name**: CuraRent (demo name)
**Stack**: Laravel 12, Blade, Livewire, Alpine.js, Tailwind CSS, MySQL

## Core Features

### 1. Pre-Registration Portal (Public-Facing)
**Route**: `/register` (guest accessible)
**Purpose**: Customers fill out their info BEFORE arriving at the rental counter.

**Fields**:
- Full name
- Email
- Phone number (with country code)
- Date of birth
- Driver's license number
- Driver's license country of issue
- Driver's license expiry date
- Driver's license photo upload (front + back)
- Passport/ID photo upload
- Emergency contact name + phone
- Rental pickup date (date picker)
- Rental return date (date picker)
- Vehicle preference (Economy, Compact, SUV, Luxury — dropdown)
- Hotel/accommodation name (text)
- Flight arrival number (optional text)

**Behavior**:
- On submit, creates a `Registration` record with status `pending`
- Sends confirmation email (simulated — just flash message in demo)
- Generates a unique 6-character alphanumeric confirmation code (e.g., `CUR-A7K2`)
- Customer sees confirmation page with their code: "Show this code when you arrive"

### 2. Staff Lookup Dashboard (Authenticated)
**Route**: `/dashboard` (requires login)
**Purpose**: When customer arrives, staff enters the confirmation code or searches by name/email to pull up the record.

**Features**:
- Search bar: search by confirmation code, name, email, or phone
- Registration list with filters: status (pending, in_progress, completed, expired)
- Click a registration to view full details
- "Start Agreement" button on a registration → creates an `Agreement` linked to this registration and redirects to the agreement flow
- Stats cards at top: Today's Registrations, Pending Agreements, Completed Today, Active Rentals

### 3. Digital Agreement Flow (Multi-Step T&C Acknowledgement)
**Route**: `/agreements/{agreement}/sign` (accessible via signed URL — no login required for customer)
**Purpose**: Step-by-step presentation of terms and conditions. Each section must be individually acknowledged before proceeding.

**Sections** (each is a "step" in the wizard):

1. **Vehicle Information** — displays the assigned vehicle (make, model, year, plate, color, mileage). Staff selects vehicle from fleet before starting this flow. Customer reviews and confirms.

2. **Rental Period & Rates** — displays pickup date, return date, daily rate, total cost, deposit amount, insurance option. Customer reviews and confirms.

3. **General Rules** — rules of the road in Curacao (drive on the right, speed limits, no off-road usage, fuel policy: return full). Customer must scroll to bottom, then check "I have read and understand the General Rules" checkbox + initial (type initials in a small text field).

4. **Damage & Liability** — pre-existing damage noted (with photo thumbnails if any), customer's liability for new damage, insurance coverage details, deductible amount. Customer initials.

5. **Fuel & Mileage Policy** — full-to-full fuel policy, unlimited mileage (or per-km charge if applicable), refueling charge if returned empty. Customer initials.

6. **Prohibited Uses** — no subletting, no use for racing/towing, no driving under influence, geographic restrictions (island only). Customer initials.

7. **Additional Drivers** — option to add additional authorized drivers (name + license number fields). If no additional drivers, customer checks "I will be the sole driver" and initials.

8. **Final Signature** — summary of all sections with checkmarks showing which were acknowledged. Full signature pad (Canvas). Customer draws their signature. "Sign & Complete" button.

**Behavior**:
- Cannot skip sections — must go in order
- Each section shows a progress bar at top (Step 3 of 8)
- "Previous" and "Next" buttons (Next disabled until section is acknowledged)
- All initials and the final signature are stored
- On completion, agreement status changes to `signed`
- Redirect to confirmation page

### 4. PDF Download
**Route**: `/agreements/{agreement}/pdf` (authenticated)
**Purpose**: Generate a professional PDF of the completed agreement.

**Contents**:
- Business header with CuraRent logo and contact info
- Customer information (from registration)
- Vehicle information
- Rental period and rates
- Each T&C section text with the customer's initials next to each
- Pre-existing damage photos (if any)
- Additional drivers listed
- Signature image at bottom
- Date and time of signing
- Unique agreement number

**Implementation**: Use `barryvdh/laravel-dompdf`

### 5. Fleet Management (Admin)
**Route**: `/dashboard/fleet` (authenticated)
**Purpose**: Manage the vehicle fleet.

**Fields per vehicle**:
- Make, Model, Year
- License plate
- Color
- VIN (optional)
- Category (Economy, Compact, SUV, Luxury)
- Daily rate
- Status (available, rented, maintenance)
- Current mileage
- Photo (file upload)

**Features**:
- List all vehicles with status badges
- Filter by status, category
- Add/edit/delete vehicles
- Vehicle detail page shows rental history

### 6. Agreement History
**Route**: `/dashboard/agreements` (authenticated)
**Purpose**: View all agreements with search and filters.

**Features**:
- Searchable list of all agreements
- Filter by status (draft, in_progress, signed, expired)
- Click to view full agreement details
- Download PDF button on each
- Shows customer name, vehicle, dates, status, signed date

## Data Model

### users
- id, name, email, password, role (admin/staff), timestamps

### registrations
- id, confirmation_code (unique, e.g. CUR-A7K2)
- full_name, email, phone, date_of_birth
- license_number, license_country, license_expiry
- license_front_photo (file path), license_back_photo (file path)
- passport_photo (file path)
- emergency_contact_name, emergency_contact_phone
- pickup_date, return_date
- vehicle_preference (enum: economy, compact, suv, luxury)
- hotel_name, flight_number (nullable)
- status (enum: pending, in_progress, completed, expired)
- timestamps

### vehicles
- id, make, model, year, license_plate, color, vin (nullable)
- category (enum: economy, compact, suv, luxury)
- daily_rate (decimal)
- status (enum: available, rented, maintenance)
- current_mileage (integer)
- photo (file path, nullable)
- timestamps

### agreements
- id, registration_id (FK), vehicle_id (FK), user_id (FK — staff who created)
- agreement_number (unique, e.g. AGR-2026-0001)
- pickup_date, return_date
- daily_rate, total_cost, deposit_amount
- insurance_option (enum: basic, premium, none)
- insurance_cost (decimal)
- current_step (integer, 1-8)
- section_1_confirmed (boolean), section_2_confirmed...section_7_confirmed
- section_3_initials, section_4_initials, section_5_initials, section_6_initials, section_7_initials (text)
- additional_drivers (JSON — array of {name, license_number})
- sole_driver (boolean)
- signature (text — base64 data URL from canvas)
- signed_at (datetime, nullable)
- status (enum: draft, in_progress, signed, expired)
- timestamps

### damage_records
- id, vehicle_id (FK), agreement_id (FK, nullable)
- description, location_on_vehicle
- photo (file path)
- recorded_at, recorded_by (FK to users)
- timestamps

## Pages & Routes

### Public
| Route | Page | Description |
|-------|------|-------------|
| `/` | Landing page | Hero with CuraRent branding, "Pre-Register Now" CTA, how it works steps |
| `/register` | Pre-registration form | Multi-field form, creates registration |
| `/register/confirmation/{code}` | Confirmation | Shows confirmation code, instructions |
| `/agreements/{agreement}/sign` | Agreement signing flow | 8-step wizard (uses signed URL for access) |
| `/agreements/{agreement}/complete` | Completion page | "Agreement signed!" with summary |

### Authenticated (Staff/Admin)
| Route | Page | Description |
|-------|------|-------------|
| `/login` | Login | Pre-filled credentials |
| `/dashboard` | Dashboard | Stats, search, recent registrations |
| `/dashboard/registrations` | Registration list | All registrations with filters |
| `/dashboard/registrations/{id}` | Registration detail | Full info, "Start Agreement" button |
| `/dashboard/agreements` | Agreement list | All agreements with filters |
| `/dashboard/agreements/{id}` | Agreement detail | Full agreement view, PDF download |
| `/dashboard/agreements/{id}/pdf` | PDF download | Generates and downloads PDF |
| `/dashboard/fleet` | Fleet list | All vehicles |
| `/dashboard/fleet/create` | Add vehicle | Vehicle form |
| `/dashboard/fleet/{id}` | Vehicle detail | Info + rental history |
| `/dashboard/fleet/{id}/edit` | Edit vehicle | Edit form |

## Design

### Typography
- **Display/Headings**: Cormorant Garamond (serif) — legal weight, authority
- **Body/UI**: DM Sans — clean, geometric, excellent readability
- **Agreement Section Headings**: DM Serif Display — elegant at large sizes, legal weight without being archaic

**Font files** (already downloaded to `public/fonts/`):
- `cormorant-garamond-latin-400.woff2`
- `cormorant-garamond-latin-600.woff2`
- `cormorant-garamond-latin-700.woff2`
- `dm-sans-latin-400.woff2`
- `dm-sans-latin-500.woff2`
- `dm-sans-latin-700.woff2`
- `dm-serif-display-latin-400.woff2`

**Self-host all fonts via @font-face. NO Google Fonts CDN. NO external font requests.**

### Color Palette
| Role | Name | Hex | Usage |
|------|------|-----|-------|
| Primary | Dutch Navy | `#1C3557` | Headers, nav, primary buttons, document frames |
| Secondary | Handelskade Teal | `#00897B` | Active states, progress indicators, "signed" confirmations |
| Accent | Terracotta Sun | `#C0623A` | Alerts, required fields, urgency indicators |
| Surface | Parchment | `#F5F0E8` | Agreement background, document feel |
| Text | Charcoal Ink | `#2D2D2D` | Body copy, form labels |
| Light BG | Sand | `#FAFAF5` | Page background |
| Border | Warm Gray | `#D4CFC7` | Input borders, dividers |

### Photos (already downloaded to `public/images/`)
- `keys-handover.jpg` — hero background or feature image
- `signing-contract.jpg` — agreement section imagery
- `curacao-bridge.jpg` — Curacao atmosphere, about section
- `curacao-sign.jpg` — local flavor
- `digital-signing.jpg` — digital document signing
- `car-rental-couple.jpg` — business/professional context
- `tropical-road.jpg` — Caribbean driving, hero or section bg
- `car-keys.jpg` — close-up car keys

### Layout & Visual Style
- **Landing page**: Split hero — left side has headline + CTA over a darkened `tropical-road.jpg`, right side shows the 3-step "How It Works" (Register → Arrive → Drive)
- **Agreement flow**: Parchment (`#F5F0E8`) background to feel like a document. Each section in a white card with subtle shadow. Progress bar at top in Teal.
- **Dashboard**: Clean, professional. Dutch Navy sidebar. White content area. Teal accent on stats cards.
- **Baroque touches**: Cormorant Garamond headings create instant authority. The parchment background on the agreement flow makes it feel like a real legal document, not a web form. Subtle depth via layered cards with different shadow intensities.

## Seed Data

### Users
| Name | Email | Password | Role |
|------|-------|----------|------|
| Maria van der Berg | admin@curarent.com | RentalAgree!Demo2026 | admin |
| Carlos Rosario | carlos@curarent.com | RentalAgree!Demo2026 | staff |

### Vehicles (8 vehicles)
1. Toyota Yaris 2024 — Economy — $35/day — ABC-123 — White — Available
2. Hyundai Accent 2023 — Economy — $32/day — ABC-456 — Silver — Available
3. Kia Sportage 2024 — Compact — $55/day — DEF-789 — Blue — Available
4. Nissan Kicks 2023 — Compact — $50/day — DEF-012 — Red — Rented
5. Toyota RAV4 2024 — SUV — $75/day — GHI-345 — Black — Available
6. Jeep Wrangler 2023 — SUV — $85/day — GHI-678 — Orange — Maintenance
7. BMW 3 Series 2024 — Luxury — $120/day — JKL-901 — White — Available
8. Mercedes C-Class 2023 — Luxury — $130/day — JKL-234 — Black — Available

### Registrations (5 pre-registered customers)
1. **Sarah Johnson** (USA) — Arriving tomorrow, Economy preference, Marriott Beach Resort, flight AA1847 — status: pending — code: CUR-S7J2
2. **Hans Mueller** (Germany) — Arriving today, SUV preference, Sunscape Curacao — status: pending — code: CUR-H4M8
3. **Ana Pereira** (Brazil) — Arrived yesterday, Compact, Lions Dive Beach Resort — status: in_progress — code: CUR-A2P5
4. **James Williams** (UK) — Completed last week, Luxury, Renaissance Wind Creek — status: completed — code: CUR-J9W1
5. **Yuki Tanaka** (Japan) — Pre-registered 3 weeks ago, never showed — status: expired — code: CUR-Y6T3

### Agreements (2 existing)
1. Ana Pereira — Kia Sportage — In Progress (step 4 of 8) — AGR-2026-0003
2. James Williams — BMW 3 Series — Signed — AGR-2026-0001 — has signature data, all sections completed

## Demo Credentials
**Pre-filled on login page** using Alpine.js click-to-fill buttons.

| Name | Email | Password | Role |
|------|-------|----------|------|
| Maria van der Berg | admin@curarent.com | RentalAgree!Demo2026 | Admin |
| Carlos Rosario | carlos@curarent.com | RentalAgree!Demo2026 | Staff |

## Plugin Manifest
| Feature | Package | Status | Notes |
|---------|---------|--------|-------|
| Signature capture | mrshanebarron/signature-pad | USE | Canvas-based, Livewire compatible |
| File upload (license/ID) | mrshanebarron/file-upload | USE | Drag-drop with validation |
| Progress indicator | mrshanebarron/progress | USE | Step progression display |
| PDF generation | barryvdh/laravel-dompdf | REQUIRE | composer require barryvdh/laravel-dompdf |
| Multi-step wizard | n/a | PROJECT-SPECIFIC | T&C section flow unique to this app |
| Fleet management | n/a | PROJECT-SPECIFIC | Vehicle CRUD with status tracking |
| Pre-registration | n/a | PROJECT-SPECIFIC | Customer self-service form |

## Technical Notes
- **Tailwind**: Pre-compile with Vite, NOT CDN. `npm install && npm run build`.
- **Fonts**: Self-hosted woff2 in `public/fonts/`. @font-face declarations in CSS. NO Google Fonts CDN.
- **Photos**: Already in `public/images/`. Use them in templates.
- **Signature pad**: Install `mrshanebarron/signature-pad` via composer. Use Livewire component.
- **File uploads**: Install `mrshanebarron/file-upload` via composer. Storage link required: `php artisan storage:link`.
- **PDF**: Install `barryvdh/laravel-dompdf`. Create a Blade view for the PDF layout.
- **Agreement signing URL**: Use Laravel's signed URL feature (`URL::signedRoute()`) so customers can access without login.
- **MySQL locally**: This project needs MySQL even locally (for ENUM columns and JSON). Create database `rentalagree` in local MySQL.
- **Icons**: Lucide icons — one consistent set throughout.
- **Alpine.js**: For interactive elements (mobile menu, click-to-fill credentials, form validation).
- **GSAP**: Not required for this project — the legal document feel benefits from stillness, not animation.
