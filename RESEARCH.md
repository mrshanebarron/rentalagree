# RESEARCH.md — RentalAgree (Job #3026)

## Job Analysis
**Job**: Custom Car Rental Reservation & Digital Agreement System
**Client**: Car rental business in Curacao
**Budget**: $1,500
**Problem**: Paper forms for rental agreements. Wants digital T&C acknowledgement, pre-registration, signature capture, PDF download.
**End User**: Tourists and visitors renting cars in Curacao — international travelers, cruise passengers, locals.
**Industry**: Car rental / vehicle leasing (Caribbean tourism market)

## Competitor Research

### 1. TSD Rental (tsdweb.com)
- Fleet management + digital rental agreement platform for small/mid-size operators
- Contactless model: operator sends agreement via SMS/email before pickup
- Customer signs on their own device — phone, tablet, laptop
- Returning customer lookup shortens new agreement to under 60 seconds
- "Mobile Agent" mode for tablet-based counter check-in
- Signature at bottom constitutes T&C acceptance (no per-section acknowledgement)

### 2. RentCentric (rentcentric.com)
- Enterprise-grade car rental management SaaS
- Mobile Agent app: vehicle photos, driver's license barcode scan + DMV verification, digital signature, credit card
- Optional Topaz Signature Pad hardware integration
- Agreement pre-populated from booking data
- Counter-centered workflow with mobile extension

### 3. TopRentApp (toprentapp.com)
- Modern SMB-targeted car rental SaaS
- AI-powered document scanner reads passport/license, auto-populates customer fields
- Generates rental agreements in up to 9 languages
- Booking widget embeds on operator's website
- Color-coded availability calendar for fleet management
- Particularly relevant for tourist-destination operators (multilingual)

### 4. HQ Rental Software (hqrentalsoftware.com)
- Cloud-based car rental management with mobile app
- Contract auto-generated from booking data, fully customizable
- Multi-party signature support (multiple signers/witnesses)
- Legally binding e-signatures, remotely collectible
- Clean separation: back-office dashboard vs field mobile app

### 5. SignNow (signnow.com) — General e-signature with car rental templates
- Pre-built car rental agreement template
- Customer opens link in browser — no account required
- Reviews full document, initials each section, applies signature via draw/type/upload
- Audit trail: IP address, timestamp, device info for legal validity
- Most rigorous per-section T&C flow of any competitor reviewed

### Market Gap Identified
No competitor offers a true **customer-facing pre-registration portal** where the customer proactively fills info, uploads license, acknowledges T&Cs, and enters details before arriving. Best implementations (TSD, RentCentric) still require operator to initiate. This is the white space our demo occupies.

## Typography

### Selected Pairing: Cormorant Garamond + DM Sans + DM Serif Display

**Cormorant Garamond** (Display/Headings)
- 16th-century Claude Garamond letterforms
- High contrast, elegant, unmistakably legal/notarial weight
- Creates instant authority on landing page and document headers
- Source: fontsource CDN

**DM Sans** (Body/UI)
- Clean, geometric, excellent at small sizes
- Screen-optimized for forms, labels, body copy
- Contrast with serif heading creates clear hierarchy without pretension
- Source: fontsource CDN

**DM Serif Display** (Agreement section headings)
- Elegant at large sizes — works for section titles within the agreement flow
- Has legal weight without feeling archaic
- Premium fintech product feel
- Source: fontsource CDN

### Font Files Downloaded
All woff2 files in `public/fonts/`:
- `cormorant-garamond-latin-400.woff2`
- `cormorant-garamond-latin-600.woff2`
- `cormorant-garamond-latin-700.woff2`
- `dm-sans-latin-400.woff2`
- `dm-sans-latin-500.woff2`
- `dm-sans-latin-700.woff2`
- `dm-serif-display-latin-400.woff2`

## Color Palette

Derived from: Caribbean Sea (trust anchor), Willemstad architecture (warm accent), professional legal application (deep neutrals).

| Role | Name | Hex | Rationale |
|------|------|-----|-----------|
| Primary | Dutch Navy | `#1C3557` | Deep navy — authority, trust. Softened from Curacao flag navy for screen readability |
| Secondary | Handelskade Teal | `#00897B` | Turquoise water of Willemstad harbor. Active states, confirmations, progress |
| Accent | Terracotta Sun | `#C0623A` | Willemstad's painted facades — mango-orange warmth. Alerts, required fields |
| Surface | Parchment | `#F5F0E8` | Slight warmth reduces eye strain on long T&C reads. Signals "document" vs "app" |
| Text | Charcoal Ink | `#2D2D2D` | Softer than pure black, legally readable at 12pt equivalent |
| Light BG | Sand | `#FAFAF5` | Page background — warm, not clinical |
| Border | Warm Gray | `#D4CFC7` | Input borders, dividers |

## Photos

All downloaded to `public/images/` from Unsplash with `?w=1200&q=80`:

| File | Subject | Usage |
|------|---------|-------|
| `keys-handover.jpg` (121K) | Car keys being handed over | Hero section, feature image |
| `signing-contract.jpg` (82K) | Contract signing at desk | Agreement section imagery |
| `curacao-bridge.jpg` (140K) | Queen Juliana Bridge, Willemstad, Curacao | About section, local atmosphere |
| `curacao-sign.jpg` (241K) | Yellow Curacao signage | Local flavor, decorative |
| `digital-signing.jpg` (98K) | Woman signing on tablet | Digital signing context |
| `car-rental-couple.jpg` (254K) | Business/professional context | Registration section |
| `tropical-road.jpg` (522K) | Caribbean beach/ocean scene | Hero background |
| `car-keys.jpg` (285K) | Close-up car keys | Feature cards, icons |

## Package Audit

| Feature | Package | Status | Notes |
|---------|---------|--------|-------|
| Signature capture | mrshanebarron/signature-pad | USE | Canvas-based, Livewire compatible, touch + mouse |
| File upload (license/ID) | mrshanebarron/file-upload | USE | Drag-drop with preview, size validation |
| Progress indicator | mrshanebarron/progress | USE | Step progression bar display |
| PDF generation | barryvdh/laravel-dompdf | REQUIRE | Standard Laravel PDF package |
| Multi-step T&C wizard | n/a | PROJECT-SPECIFIC | Unique per-section acknowledgement flow |
| Fleet management CRUD | n/a | PROJECT-SPECIFIC | Vehicle inventory with status tracking |
| Pre-registration portal | n/a | PROJECT-SPECIFIC | Customer self-service before arrival |

## Industry Terminology
- **Rental agreement** (not "contract" — softer language for tourism)
- **Pre-registration** / **pre-check-in**
- **Confirmation code** (not "booking reference")
- **Daily rate** / **per diem**
- **Deposit** / **security deposit**
- **CDW** — Collision Damage Waiver (insurance type)
- **Full-to-full fuel policy** — return with same fuel level
- **Mileage** — odometer reading
- **Fleet** — the collection of rental vehicles
- **Turnaround** — time between rentals for cleaning/inspection
- **Walk-in** vs **pre-registered** customer
- **Initials** — short form acknowledgement per section (common in legal docs)

## Existing Demo Check
- `ls ~/Sites/demos/` — no existing car rental agreement demo
- `hiremycar` exists but is a P2P car rental marketplace (different concept — peer-to-peer listing, not rental agreement digitization)
- This is a new build with no prior work to build on
