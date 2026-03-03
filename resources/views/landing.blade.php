<x-layouts.public title="Welcome">
    <!-- Hero: Split layout -->
    <section class="relative">
        <div class="flex flex-col lg:flex-row min-h-[600px]">
            <!-- Left: Image with overlay -->
            <div class="relative lg:w-3/5 min-h-[400px] lg:min-h-[600px]">
                <img src="/images/tropical-road.jpg" alt="Driving in Curacao" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-navy/70"></div>
                <div class="relative z-10 flex flex-col justify-center h-full px-8 sm:px-12 lg:px-16 py-16">
                    <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                        Your Island<br>Adventure<br>Starts Here
                    </h1>
                    <p class="text-white/80 text-lg max-w-md mb-8 leading-relaxed">
                        Skip the paperwork at the counter. Pre-register online and drive away in minutes when you arrive in Curacao.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/register" class="inline-flex items-center justify-center gap-2 bg-teal hover:bg-teal-light text-white px-8 py-3.5 rounded-lg font-medium transition-colors text-lg shadow-lg shadow-teal/25">
                            <i data-lucide="clipboard-check" class="w-5 h-5"></i>
                            Pre-Register Now
                        </a>
                        <a href="/login" class="inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 text-white px-6 py-3.5 rounded-lg font-medium transition-colors border border-white/20">
                            <i data-lucide="log-in" class="w-5 h-5"></i>
                            Staff Portal
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right: How it Works -->
            <div class="lg:w-2/5 bg-parchment flex flex-col justify-center px-8 sm:px-12 lg:px-14 py-16">
                <h2 class="font-display text-2xl font-bold text-navy mb-2">How It Works</h2>
                <p class="text-charcoal/60 text-sm mb-10">Three simple steps to your rental</p>

                <div class="space-y-8">
                    <div class="flex gap-5">
                        <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center flex-shrink-0 shadow-md">
                            <span class="text-white font-display text-xl font-bold">1</span>
                        </div>
                        <div>
                            <h3 class="font-serif-display text-lg text-navy mb-1">Register Online</h3>
                            <p class="text-charcoal/70 text-sm leading-relaxed">Fill in your details and upload your documents from anywhere before your trip.</p>
                        </div>
                    </div>

                    <div class="flex gap-5">
                        <div class="w-12 h-12 rounded-full bg-teal flex items-center justify-center flex-shrink-0 shadow-md">
                            <span class="text-white font-display text-xl font-bold">2</span>
                        </div>
                        <div>
                            <h3 class="font-serif-display text-lg text-navy mb-1">Arrive & Sign</h3>
                            <p class="text-charcoal/70 text-sm leading-relaxed">Show your confirmation code at the counter. Review and sign your agreement digitally.</p>
                        </div>
                    </div>

                    <div class="flex gap-5">
                        <div class="w-12 h-12 rounded-full bg-terracotta flex items-center justify-center flex-shrink-0 shadow-md">
                            <span class="text-white font-display text-xl font-bold">3</span>
                        </div>
                        <div>
                            <h3 class="font-serif-display text-lg text-navy mb-1">Drive Away</h3>
                            <p class="text-charcoal/70 text-sm leading-relaxed">Pick up your keys and start exploring Curacao. Your signed agreement is always available digitally.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="font-display text-3xl sm:text-4xl font-bold text-navy mb-3">Why Pre-Register with CuraRent?</h2>
                <p class="text-charcoal/60 max-w-2xl mx-auto">No more filling out paper forms at the counter. Our digital process saves you time and gets you on the road faster.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-sand rounded-xl p-8 border border-warm-gray/50 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-teal/10 rounded-xl flex items-center justify-center mb-5">
                        <i data-lucide="clock" class="w-6 h-6 text-teal"></i>
                    </div>
                    <h3 class="font-serif-display text-xl text-navy mb-2">Save Time</h3>
                    <p class="text-charcoal/70 text-sm leading-relaxed">Complete your paperwork before you arrive. Walk in, show your code, and drive away in minutes instead of spending 30 minutes at the counter.</p>
                </div>

                <div class="bg-sand rounded-xl p-8 border border-warm-gray/50 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-navy/10 rounded-xl flex items-center justify-center mb-5">
                        <i data-lucide="shield-check" class="w-6 h-6 text-navy"></i>
                    </div>
                    <h3 class="font-serif-display text-xl text-navy mb-2">Secure & Digital</h3>
                    <p class="text-charcoal/70 text-sm leading-relaxed">Your agreement is signed digitally and stored securely. Download your PDF copy anytime — no lost papers, no carbon copies.</p>
                </div>

                <div class="bg-sand rounded-xl p-8 border border-warm-gray/50 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-terracotta/10 rounded-xl flex items-center justify-center mb-5">
                        <i data-lucide="file-text" class="w-6 h-6 text-terracotta"></i>
                    </div>
                    <h3 class="font-serif-display text-xl text-navy mb-2">Clear Terms</h3>
                    <p class="text-charcoal/70 text-sm leading-relaxed">Every section of your rental agreement is presented clearly. Review fuel policy, insurance, and liability before you sign — no fine print surprises.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Photo + CTA Section -->
    <section class="relative py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2">
                    <div class="relative">
                        <img src="/images/curacao-bridge.jpg" alt="Queen Emma Bridge, Willemstad" class="rounded-2xl shadow-2xl w-full object-cover aspect-[4/3]">
                        <div class="absolute -bottom-4 -right-4 bg-white rounded-xl shadow-lg p-4 hidden sm:block">
                            <div class="flex items-center gap-3">
                                <img src="/images/car-keys.jpg" alt="Car keys" class="w-16 h-16 rounded-lg object-cover">
                                <div>
                                    <p class="font-medium text-navy text-sm">Ready when you are</p>
                                    <p class="text-xs text-charcoal/50">Airport pickup available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <h2 class="font-display text-3xl sm:text-4xl font-bold text-navy mb-4">Explore Curacao<br>Your Way</h2>
                    <p class="text-charcoal/70 leading-relaxed mb-6">From the colorful streets of Willemstad to the hidden beaches of Westpunt, having your own car is the best way to discover everything this island has to offer. Our fleet ranges from fuel-efficient economy cars to rugged SUVs ready for any adventure.</p>
                    <div class="flex flex-wrap gap-4 mb-8">
                        <div class="flex items-center gap-2 text-sm text-charcoal/70">
                            <i data-lucide="check-circle" class="w-4 h-4 text-teal"></i>
                            Collision Damage Waiver available
                        </div>
                        <div class="flex items-center gap-2 text-sm text-charcoal/70">
                            <i data-lucide="check-circle" class="w-4 h-4 text-teal"></i>
                            Unlimited mileage
                        </div>
                        <div class="flex items-center gap-2 text-sm text-charcoal/70">
                            <i data-lucide="check-circle" class="w-4 h-4 text-teal"></i>
                            24/7 roadside assistance
                        </div>
                        <div class="flex items-center gap-2 text-sm text-charcoal/70">
                            <i data-lucide="check-circle" class="w-4 h-4 text-teal"></i>
                            Airport delivery & pickup
                        </div>
                    </div>
                    <a href="/register" class="inline-flex items-center gap-2 bg-terracotta hover:bg-terracotta-dark text-white px-8 py-3.5 rounded-lg font-medium transition-colors shadow-lg shadow-terracotta/25">
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                        Pre-Register Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="grid grid-cols-2 gap-4">
                    <img src="/images/keys-handover.jpg" alt="Handing over car keys" class="rounded-xl shadow-lg w-full aspect-square object-cover">
                    <img src="/images/digital-signing.jpg" alt="Digital document signing" class="rounded-xl shadow-lg w-full aspect-square object-cover mt-8">
                    <img src="/images/car-rental-couple.jpg" alt="Couple at rental counter" class="rounded-xl shadow-lg w-full aspect-square object-cover -mt-4">
                    <img src="/images/curacao-sign.jpg" alt="Welcome to Curacao" class="rounded-xl shadow-lg w-full aspect-square object-cover mt-4">
                </div>
                <div class="lg:pl-8">
                    <h2 class="font-display text-3xl sm:text-4xl font-bold text-navy mb-4">Trusted by Travelers<br>Since 2018</h2>
                    <p class="text-charcoal/70 leading-relaxed mb-6">CuraRent has served thousands of visitors to Curacao with reliable vehicles and straightforward agreements. Our digital-first approach means less time at the counter and more time enjoying the island.</p>
                    <div class="grid grid-cols-3 gap-6 mb-8">
                        <div class="text-center">
                            <p class="font-display text-3xl font-bold text-teal">2,400+</p>
                            <p class="text-xs text-charcoal/50 mt-1">Rentals Completed</p>
                        </div>
                        <div class="text-center">
                            <p class="font-display text-3xl font-bold text-teal">8</p>
                            <p class="text-xs text-charcoal/50 mt-1">Fleet Vehicles</p>
                        </div>
                        <div class="text-center">
                            <p class="font-display text-3xl font-bold text-teal">4.8</p>
                            <p class="text-xs text-charcoal/50 mt-1">Average Rating</p>
                        </div>
                    </div>
                    <a href="/register" class="inline-flex items-center gap-2 bg-navy hover:bg-navy-light text-white px-8 py-3.5 rounded-lg font-medium transition-colors">
                        <i data-lucide="clipboard-check" class="w-5 h-5"></i>
                        Start Your Reservation
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>
