<?php include 'header.php'; ?>

        <!-- Hero Section with Banner Slider -->
        <section class="relative h-[70vh] md:h-[85vh] min-h-[480px] md:min-h-[600px] overflow-hidden">
            <div class="slider-wrapper">
                <div class="slides" id="banner-slides">
                    <!-- Slide 1 -->
                    <div class="slide">
                        <img src="assets/banner_slide_1.png" alt="Agricultural Research">
                        <div class="slide-overlay"></div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="slide">
                        <img src="assets/banner_slide_2.png" alt="Biotechnology">
                        <div class="slide-overlay"></div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="slide">
                        <img src="assets/banner_slide_3.png" alt="Sustainable Farming">
                        <div class="slide-overlay"></div>
                    </div>
                </div>
            </div>
            
            <div class="absolute inset-0 z-10 flex items-center">
                <div class="container mx-auto px-6 flex flex-col lg:flex-row items-center gap-10 lg:gap-16">
                    <div class="lg:w-7/12 text-white text-center lg:text-left">
                        <div class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[11px] sm:text-xs font-semibold mb-6 sm:mb-8 backdrop-blur-md uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            Open Access Journal
                        </div>
                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6 leading-tight font-['Outfit'] tracking-tight text-white drop-shadow-md">
                            Advancing Global<br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Agricultural Research</span>
                        </h1>
                        <p class="text-sm sm:text-base lg:text-lg text-slate-300 mb-8 sm:mb-10 max-w-xl mx-auto lg:mx-0 leading-relaxed font-light drop-shadow">
                            Publishing high-quality, peer-reviewed research across agronomy, biotechnology, horticulture, and allied sciences for a sustainable future.
                        </p>
                        <div class="grid grid-cols-2 gap-3 max-w-sm mx-auto lg:flex lg:flex-row lg:justify-start lg:max-w-none">
                            <a href="ijari-submit.php" class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-400 hover:to-teal-400 py-3 px-4 rounded-xl font-semibold transition-all shadow-[0_8px_20px_rgba(16,185,129,0.25)] flex items-center justify-center gap-1.5 text-xs sm:text-sm md:text-base">
                                Submit Manuscript <i class="fas fa-arrow-right text-[10px]"></i>
                            </a>
                            <a href="ijari-about.php" class="bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 text-white py-3 px-4 rounded-xl font-semibold transition-all flex items-center justify-center gap-1.5 text-xs sm:text-sm md:text-base">
                                Discover More
                            </a>
                        </div>
                    </div>
                    
                    <!-- Stats Card -->
                    <div class="lg:w-5/12 w-full max-w-md mx-auto hidden lg:block perspective-1000">
                        <div class="bg-white/5 backdrop-blur-xl p-10 rounded-3xl border border-white/10 shadow-2xl text-white transform hover:rotate-y-2 transition-transform duration-500">
                            <h3 class="text-2xl font-bold mb-8 pb-4 border-b border-white/10 font-['Outfit']">Journal Metrics</h3>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="bg-white/5 rounded-2xl p-4 border border-white/5 hover:bg-white/10 transition-colors">
                                    <i class="fas fa-calendar-alt text-emerald-400 text-2xl mb-2"></i>
                                    <div class="text-sm text-slate-400 uppercase tracking-wider font-semibold mb-1">Frequency</div>
                                    <div class="font-bold text-lg">Quarterly</div>
                                </div>
                                <div class="bg-white/5 rounded-2xl p-4 border border-white/5 hover:bg-white/10 transition-colors">
                                    <i class="fas fa-user-check text-emerald-400 text-2xl mb-2"></i>
                                    <div class="text-sm text-slate-400 uppercase tracking-wider font-semibold mb-1">Review</div>
                                    <div class="font-bold text-lg">Double-blind</div>
                                </div>
                                <div class="bg-white/5 rounded-2xl p-4 border border-white/5 hover:bg-white/10 transition-colors">
                                    <i class="fas fa-unlock-alt text-emerald-400 text-2xl mb-2"></i>
                                    <div class="text-sm text-slate-400 uppercase tracking-wider font-semibold mb-1">Access</div>
                                    <div class="font-bold text-lg">100% Open</div>
                                </div>
                                <div class="bg-white/5 rounded-2xl p-4 border border-white/5 hover:bg-white/10 transition-colors">
                                    <i class="fas fa-bolt text-emerald-400 text-2xl mb-2"></i>
                                    <div class="text-sm text-slate-400 uppercase tracking-wider font-semibold mb-1">Turnaround</div>
                                    <div class="font-bold text-lg">Rapid</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slider Controls -->
            <button onclick="prevSlide()" class="absolute left-6 top-1/2 -translate-y-1/2 z-20 bg-white/10 hover:bg-white/20 text-white w-14 h-14 rounded-full hidden md:flex items-center justify-center backdrop-blur-md border border-white/10 transition-all hover:scale-110">
                <i class="fas fa-chevron-left text-xl"></i>
            </button>
            <button onclick="nextSlide()" class="absolute right-6 top-1/2 -translate-y-1/2 z-20 bg-white/10 hover:bg-white/20 text-white w-14 h-14 rounded-full hidden md:flex items-center justify-center backdrop-blur-md border border-white/10 transition-all hover:scale-110">
                <i class="fas fa-chevron-right text-xl"></i>
            </button>
            
            <!-- Slider Indicators -->
            <div class="absolute bottom-6 md:bottom-10 left-1/2 -translate-x-1/2 z-20 flex gap-3">
                <button onclick="goToSlide(0)" class="w-12 h-1.5 rounded-full bg-emerald-500 transition-all indicator"></button>
                <button onclick="goToSlide(1)" class="w-12 h-1.5 rounded-full bg-white/30 hover:bg-white/50 transition-all indicator"></button>
                <button onclick="goToSlide(2)" class="w-12 h-1.5 rounded-full bg-white/30 hover:bg-white/50 transition-all indicator"></button>
            </div>
        </section>
        
        <script>
            let currentSlide = 0;
            const slides = document.getElementById('banner-slides');
            const indicators = document.querySelectorAll('.indicator');
            const totalSlides = 3;
            
            function updateSlide() {
                slides.style.transform = 'translateX(-' + (currentSlide * 100) + '%)';
                indicators.forEach((ind, index) => {
                    if(index === currentSlide) {
                        ind.classList.remove('bg-white/30');
                        ind.classList.add('bg-emerald-500');
                    } else {
                        ind.classList.add('bg-white/30');
                        ind.classList.remove('bg-emerald-500');
                    }
                });
            }
            
            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateSlide();
            }
            
            function prevSlide() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                updateSlide();
            }
            
            function goToSlide(index) {
                currentSlide = index;
                updateSlide();
            }
            
            // Auto-advance every 6 seconds
            setInterval(nextSlide, 6000);
        </script>

        <!-- Features Section -->
        <section class="py-16 md:py-12 md:py-16 bg-white relative">
            <div class="container mx-auto px-6">
                <div class="text-center max-w-3xl mx-auto mb-12 md:mb-20">
                    <span class="text-emerald-600 font-bold tracking-wider uppercase text-sm mb-3 block">Why Publish With Us</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 md:mb-6 font-['Outfit']">Bridging Research & Application</h2>
                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed">Providing a premier global platform for innovative solutions addressing contemporary challenges in modern agricultural systems.</p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-6 lg:gap-10">
                    <!-- Feature 1 -->
                    <div class="group bg-slate-50 rounded-3xl p-6 sm:p-10 border border-slate-100 hover:border-emerald-100 hover:shadow-2xl hover:shadow-emerald-900/5 transition-all duration-300 hover:-translate-y-2">
                        <div class="w-16 h-16 bg-white shadow-sm border border-slate-100 text-emerald-500 rounded-2xl flex items-center justify-center text-2xl mb-6 md:mb-8 group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4 font-['Outfit']">Multidisciplinary</h3>
                        <p class="text-slate-600 mb-8 leading-relaxed text-sm sm:text-base">Covering Agronomy, Horticulture, Plant Pathology, Biotechnology, Animal Husbandry, and more to reflect modern interconnected agriculture.</p>
                        <a href="ijari-about.php" class="text-emerald-600 font-semibold hover:text-emerald-700 flex items-center gap-2 group-hover:gap-3 transition-all text-sm">Learn more <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <!-- Feature 2 -->
                    <div class="group bg-slate-50 rounded-3xl p-6 sm:p-10 border border-slate-100 hover:border-emerald-100 hover:shadow-2xl hover:shadow-emerald-900/5 transition-all duration-300 hover:-translate-y-2">
                        <div class="w-16 h-16 bg-white shadow-sm border border-slate-100 text-emerald-500 rounded-2xl flex items-center justify-center text-2xl mb-6 md:mb-8 group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4 font-['Outfit']">Rigorous Review</h3>
                        <p class="text-slate-600 mb-8 leading-relaxed text-sm sm:text-base">Every submission undergoes strict double-blind peer-review by subject-matter experts, ensuring scientifically sound and credible publications.</p>
                        <a href="ijari-peer-review.php" class="text-emerald-600 font-semibold hover:text-emerald-700 flex items-center gap-2 group-hover:gap-3 transition-all text-sm">Review process <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <!-- Feature 3 -->
                    <div class="group bg-slate-50 rounded-3xl p-6 sm:p-10 border border-slate-100 hover:border-emerald-100 hover:shadow-2xl hover:shadow-emerald-900/5 transition-all duration-300 hover:-translate-y-2">
                        <div class="w-16 h-16 bg-white shadow-sm border border-slate-100 text-emerald-500 rounded-2xl flex items-center justify-center text-2xl mb-6 md:mb-8 group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4 font-['Outfit']">Open Access</h3>
                        <p class="text-slate-600 mb-8 leading-relaxed text-sm sm:text-base">Freely accessible to readers worldwide immediately upon publication, maximizing visibility, citation potential, and real-world impact.</p>
                        <a href="ijari-about.php" class="text-emerald-600 font-semibold hover:text-emerald-700 flex items-center gap-2 group-hover:gap-3 transition-all text-sm">Access policy <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Farm Science Today Highlight -->
        <section class="py-16 md:py-12 md:py-16 bg-slate-50 border-t border-slate-200">
            <div class="container mx-auto px-6">
                <div class="bg-white rounded-3xl md:rounded-[2.5rem] p-6 sm:p-10 md:p-16 shadow-xl shadow-slate-200/50 border border-slate-100 flex flex-col lg:flex-row items-center gap-10 lg:gap-16 relative overflow-hidden">
                    
                    <!-- Decorative blob -->
                    <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>
                    
                    <div class="lg:w-1/2 relative z-10 text-left">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold tracking-widest uppercase mb-6">
                            <i class="fas fa-star text-emerald-500"></i> Monthly e-Magazine
                        </div>
                        <h2 class="text-3xl md:text-5xl font-bold text-slate-900 mb-4 md:mb-6 font-['Outfit'] leading-tight">Farm Science Today</h2>
                        <p class="text-slate-600 mb-8 text-base sm:text-lg leading-relaxed font-light">Presenting complex scientific knowledge in a simple, highly accessible style for progressive farmers, students, and researchers. Read insightful articles and success stories.</p>
                        <ul class="space-y-4 mb-10 text-slate-700">
                            <li class="flex items-center gap-3 sm:gap-4 bg-slate-50 p-3 rounded-xl border border-slate-100 text-sm sm:text-base"><div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0"><i class="fas fa-check"></i></div> Easy-to-understand technical content</li>
                            <li class="flex items-center gap-3 sm:gap-4 bg-slate-50 p-3 rounded-xl border border-slate-100 text-sm sm:text-base"><div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0"><i class="fas fa-bolt"></i></div> Fast 7-day publication timeline</li>
                            <li class="flex items-center gap-3 sm:gap-4 bg-slate-50 p-3 rounded-xl border border-slate-100 text-sm sm:text-base"><div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0"><i class="fas fa-rupee-sign"></i></div> Nominal ₹200 processing fee</li>
                        </ul>
                        <div class="flex flex-wrap gap-3 sm:gap-4">
                            <a href="emagazine-about.php" class="bg-slate-100 hover:bg-slate-200 text-slate-800 px-6 sm:px-8 py-3.5 sm:py-4 rounded-xl font-semibold transition-colors text-sm sm:text-base">Learn More</a>
                            <a href="emagazine-submit.php" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 sm:px-8 py-3.5 sm:py-4 rounded-xl font-semibold transition-colors shadow-lg shadow-emerald-600/20 text-sm sm:text-base">Submit Article</a>
                        </div>
                    </div>
                    <div class="lg:w-1/2 flex justify-center relative z-10 w-full mt-10 lg:mt-0">
                        <div class="relative w-full max-w-[280px] sm:max-w-sm aspect-[3/4] bg-slate-800 rounded-3xl shadow-2xl transform lg:rotate-3 hover:rotate-0 transition-all duration-500 flex items-center justify-center overflow-hidden border-4 sm:border-8 border-white group">
                            <img src="assets/banner_slide_3.png" alt="Farm Science" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent"></div>
                            <div class="relative z-10 text-center mt-auto mb-12 p-6 text-white w-full">
                                <div class="w-16 h-1 bg-emerald-500 mx-auto mb-6 rounded-full"></div>
                                <h3 class="font-bold text-2xl sm:text-3xl uppercase tracking-widest mb-2 font-['Outfit']">Farm Science</h3>
                                <p class="text-base sm:text-lg font-light uppercase tracking-[0.3em] text-emerald-300">Today</p>
                                <p class="text-xs text-slate-300 mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500 transform translate-y-4 group-hover:translate-y-0">Monthly e-Magazine Edition</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
<?php include 'footer.php'; ?>