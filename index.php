<?php include "header.php"; ?>

<!-- Hero Section with Banner Slider -->
        <section class="relative h-[70vh] md:h-[85vh] min-h-[480px] md:min-h-[600px] overflow-hidden">
            <div class="slider-wrapper">
                <div class="slides" id="banner-slides">
                    <!-- Slide 1 -->
                    <div class="slide">
                        <img src="assets/banner_slide_1_light.png" alt="Agricultural Research">
                        <div class="slide-overlay"></div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="slide">
                        <img src="assets/banner_slide_2_light.png" alt="Biotechnology">
                        <div class="slide-overlay"></div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="slide">
                        <img src="assets/banner_slide_3_light.png" alt="Sustainable Farming">
                        <div class="slide-overlay"></div>
                    </div>
                </div>
            </div>
            
            <div class="absolute inset-0 z-10 flex items-center">
                <div class="container mx-auto px-6 flex flex-col lg:flex-row items-center gap-10 lg:gap-16">
                    <div class="lg:w-6/12 text-white text-left">
                        <div class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[11px] sm:text-xs font-semibold mb-6 sm:mb-8 backdrop-blur-md uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            Open Access Journal
                        </div>
                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6 leading-tight font-['Outfit'] tracking-tight text-white drop-shadow-md">
                            Advancing Global<br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Agricultural Research</span>
                        </h1>
                        <p class="text-sm sm:text-base lg:text-lg text-slate-600 mb-8 sm:mb-10 max-w-xl mx-auto lg:mx-0 leading-relaxed font-light drop-shadow">
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
                          <div class="bg-white p-8 rounded-3xl border border-emerald-100/50 shadow-2xl text-slate-800 transform hover:rotate-y-2 transition-transform duration-500">
                              <h3 class="text-2xl font-bold mb-6 pb-4 border-b border-slate-100 text-emerald-950 font-['Outfit']">Journal Metrics</h3>
                              <div class="grid grid-cols-2 gap-4">
                                  <div class="bg-emerald-50/40 rounded-2xl p-4 border border-emerald-100/50 hover:bg-emerald-50/70 transition-colors">
                                      <i class="fas fa-calendar-alt text-emerald-600 text-2xl mb-2"></i>
                                      <div class="text-xs text-slate-500 uppercase tracking-wider font-semibold mb-1">Frequency</div>
                                      <div class="font-bold text-slate-800 text-base">Quarterly</div>
                                  </div>
                                  <div class="bg-emerald-50/40 rounded-2xl p-4 border border-emerald-100/50 hover:bg-emerald-50/70 transition-colors">
                                      <i class="fas fa-user-check text-emerald-600 text-2xl mb-2"></i>
                                      <div class="text-xs text-slate-500 uppercase tracking-wider font-semibold mb-1">Review</div>
                                      <div class="font-bold text-slate-800 text-base">Double-blind</div>
                                  </div>
                                  <div class="bg-emerald-50/40 rounded-2xl p-4 border border-emerald-100/50 hover:bg-emerald-50/70 transition-colors">
                                      <i class="fas fa-unlock-alt text-emerald-600 text-2xl mb-2"></i>
                                      <div class="text-xs text-slate-500 uppercase tracking-wider font-semibold mb-1">Access</div>
                                      <div class="font-bold text-slate-800 text-base">100% Open</div>
                                  </div>
                                  <div class="bg-emerald-50/40 rounded-2xl p-4 border border-emerald-100/50 hover:bg-emerald-50/70 transition-colors">
                                      <i class="fas fa-bolt text-emerald-600 text-2xl mb-2"></i>
                                      <div class="text-xs text-slate-500 uppercase tracking-wider font-semibold mb-1">Turnaround</div>
                                      <div class="font-bold text-slate-800 text-base">Rapid</div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
            
            <!-- Slider Controls -->
            <button onclick="prevSlide()" class="absolute left-6 top-1/2 -translate-y-1/2 z-20 bg-white/80 hover:bg-white text-emerald-900 shadow-lg border-none w-14 h-14 rounded-full hidden md:flex items-center justify-center backdrop-blur-md border border-white/10 transition-all hover:scale-110">
                <i class="fas fa-chevron-left text-xl"></i>
            </button>
            <button onclick="nextSlide()" class="absolute right-6 top-1/2 -translate-y-1/2 z-20 bg-white/80 hover:bg-white text-emerald-900 shadow-lg border-none w-14 h-14 rounded-full hidden md:flex items-center justify-center backdrop-blur-md border border-white/10 transition-all hover:scale-110">
                <i class="fas fa-chevron-right text-xl"></i>
            </button>
            
            <!-- Slider Indicators -->
            <div class="absolute bottom-6 md:bottom-10 left-1/2 -translate-x-1/2 z-20 flex gap-3">
                <button onclick="goToSlide(0)" class="w-12 h-1.5 rounded-full bg-emerald-500 transition-all indicator"></button>
                <button onclick="goToSlide(1)" class="w-12 h-1.5 rounded-full bg-emerald-900/20 hover:bg-emerald-900/40 transition-all indicator"></button>
                <button onclick="goToSlide(2)" class="w-12 h-1.5 rounded-full bg-emerald-900/20 hover:bg-emerald-900/40 transition-all indicator"></button>
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
                        ind.classList.remove('bg-emerald-900/20');
                        ind.classList.add('bg-emerald-500');
                    } else {
                        ind.classList.add('bg-emerald-900/20');
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

        <!-- Research Focus Areas (Image 1 Style - Arched Cards) -->
<section class="py-20 bg-[#f7f9f4]">
    <div class="container mx-auto px-6">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-[#556B2F] font-bold tracking-widest uppercase text-sm mb-3 block font-['Oswald']">Our Focus</span>
            <h2 class="text-4xl md:text-5xl font-bold text-[#1B4332] mb-6 font-['Oswald'] uppercase tracking-wide">Research Focus Areas</h2>
            <div class="w-24 h-2 bg-lime mx-auto mb-6"></div>
            <p class="text-slate-600 text-lg font-medium font-sans">Addressing contemporary challenges in modern agricultural systems through multidisciplinary research.</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
            <!-- Arched Card 1 -->
            <div class="bg-white arch-shape p-2 shadow-xl border-4 border-white hover:border-lime transition-all duration-300 group">
                <div class="w-full h-64 bg-slate-200 arch-shape overflow-hidden relative">
                    <img src="assets/banner_slide_1_light.png" alt="Agronomy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-forest to-transparent opacity-60"></div>
                </div>
                <div class="p-8 text-center relative z-10 -mt-10">
                    <div class="w-16 h-16 bg-lime text-forest rounded-full mx-auto flex items-center justify-center text-2xl font-bold border-4 border-white mb-4">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-forest mb-3 font-['Oswald'] uppercase tracking-wider">Agronomy</h3>
                    <p class="text-slate-600 font-medium text-sm font-sans">Crop production, soil management, and sustainable farming practices.</p>
                </div>
            </div>
            
            <!-- Arched Card 2 -->
            <div class="bg-white arch-shape p-2 shadow-xl border-4 border-white hover:border-lime transition-all duration-300 group mt-8 md:mt-0">
                <div class="w-full h-64 bg-slate-200 arch-shape overflow-hidden relative">
                    <img src="assets/banner_slide_2_light.png" alt="Biotechnology" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-forest to-transparent opacity-60"></div>
                </div>
                <div class="p-8 text-center relative z-10 -mt-10">
                    <div class="w-16 h-16 bg-lime text-forest rounded-full mx-auto flex items-center justify-center text-2xl font-bold border-4 border-white mb-4">
                        <i class="fas fa-dna"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-forest mb-3 font-['Oswald'] uppercase tracking-wider">Biotechnology</h3>
                    <p class="text-slate-600 font-medium text-sm font-sans">Genetic engineering, tissue culture, and molecular markers.</p>
                </div>
            </div>
            
            <!-- Arched Card 3 -->
            <div class="bg-white arch-shape p-2 shadow-xl border-4 border-white hover:border-lime transition-all duration-300 group mt-8 md:mt-0">
                <div class="w-full h-64 bg-slate-200 arch-shape overflow-hidden relative">
                    <img src="assets/banner_slide_3_light.png" alt="Horticulture" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-forest to-transparent opacity-60"></div>
                </div>
                <div class="p-8 text-center relative z-10 -mt-10">
                    <div class="w-16 h-16 bg-lime text-forest rounded-full mx-auto flex items-center justify-center text-2xl font-bold border-4 border-white mb-4">
                        <i class="fas fa-apple-alt"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-forest mb-3 font-['Oswald'] uppercase tracking-wider">Horticulture</h3>
                    <p class="text-slate-600 font-medium text-sm font-sans">Pomology, olericulture, floriculture, and post-harvest management.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- IJARI Highlight (Image 1/3 Style - Leaf Shapes & Diagonal) -->
<section class="py-24 bg-white relative overflow-hidden">
    <!-- Diagonal background block -->
    <div class="absolute top-0 right-0 w-1/2 h-full bg-[#4A3B2C] transform origin-top-left -skew-x-12 hidden lg:block"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="lg:w-1/2">
                <div class="relative w-full max-w-lg mx-auto">
                    <!-- Leaf shaped image container -->
                    <div class="bg-lime p-2 leaf-shape shadow-2xl">
                        <img src="assets/ijari_flyer.png" alt="IJARI Journal" class="w-full h-auto leaf-shape">
                    </div>
                    <!-- Decorative element -->
                    <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-forest leaf-shape-alt -z-10 hidden sm:block"></div>
                </div>
            </div>
            
            <div class="lg:w-1/2 text-left bg-white lg:bg-transparent p-8 lg:p-0 lg:pr-16 rounded-2xl lg:rounded-none shadow-xl lg:shadow-none">
                <span class="text-lime lg:text-[#D4E157] font-bold tracking-widest uppercase text-sm mb-3 block font-['Oswald'] bg-forest lg:bg-transparent inline-block px-4 py-1 lg:p-0 rounded-full">Double-Blind Peer Review</span>
                <h2 class="text-4xl md:text-5xl font-bold text-forest lg:text-white mb-6 font-['Oswald'] uppercase tracking-wider">IJARI Journal</h2>
                <div class="w-16 h-2 bg-lime mb-8"></div>
                <p class="text-slate-600 lg:text-white text-lg font-medium mb-8 font-sans leading-relaxed">
                    The International Journal of Agricultural Research and Innovation is a premier platform dedicated to advancing scientific knowledge across all domains of agriculture.
                </p>
                <ul class="space-y-4 mb-10 font-sans font-bold text-slate-700 lg:text-white">
                    <li class="flex items-center gap-4">
                        <div class="w-10 h-10 leaf-shape bg-lime text-forest flex items-center justify-center shrink-0"><i class="fas fa-check"></i></div> 
                        100% Open Access Publication
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-10 h-10 leaf-shape bg-white text-[#1B4332] flex items-center justify-center shrink-0"><i class="fas fa-search"></i></div> 
                        Rigorous Peer Review Process
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-10 h-10 leaf-shape bg-white text-[#1B4332] flex items-center justify-center shrink-0"><i class="fas fa-calendar-alt"></i></div> 
                        Published Quarterly
                    </li>
                </ul>
                <div class="flex flex-wrap gap-4 font-sans">
                    <a href="ijari-submit.php" class="bg-lime text-forest py-4 px-8 leaf-shape font-bold hover:bg-white lg:hover:bg-[#1B4332] lg:hover:text-white transition-all text-sm uppercase tracking-widest shadow-md">
                        Submit Manuscript
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Farm Science Today Highlight (Image 2 Style - Wavy Circles) -->
<section class="py-24 bg-[#1B4332] relative overflow-hidden">
    <!-- Wavy Top Divider -->
    <div class="absolute top-0 left-0 w-100 w-full overflow-hidden leading-none">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="width: calc(100% + 1.3px); height: 60px;">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#ffffff"></path>
        </svg>
    </div>

    <!-- Organic Background pattern -->
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 20% 50%, rgba(212, 225, 87, 0.4) 0%, transparent 50%), radial-gradient(circle at 80% 80%, rgba(212, 225, 87, 0.4) 0%, transparent 50%);"></div>
    
    <div class="container mx-auto px-6 relative z-10 pt-10">
        <div class="flex flex-col lg:flex-row-reverse items-center gap-16">
            <div class="lg:w-1/2">
                <div class="relative w-80 h-80 md:w-96 md:h-96 mx-auto circle-wavy bg-white p-2">
                    <img src="assets/farm_science_flyer.png" alt="Farm Science Today" class="w-full h-full rounded-full object-cover">
                </div>
            </div>
            
            <div class="lg:w-1/2 text-left text-white">
                <span class="text-lime font-bold tracking-widest uppercase text-sm mb-3 block font-['Oswald']">Monthly e-Magazine</span>
                <h2 class="text-4xl md:text-6xl font-bold text-white mb-6 font-['Oswald'] uppercase tracking-wider">Farm Science Today</h2>
                <div class="w-16 h-2 bg-lime mb-8"></div>
                <p class="text-slate-600 text-lg font-medium mb-8 text-white font-sans leading-relaxed">
                    Presenting complex scientific knowledge in a simple, highly accessible style for progressive farmers, students, and researchers.
                </p>
                <div class="grid sm:grid-cols-2 gap-6 mb-10 font-sans">
                    <div class="bg-[#2D6A4F] p-6 leaf-shape border-2 border-[#1B4332]">
                        <i class="fas fa-bolt text-3xl text-lime mb-4"></i>
                        <h4 class="font-bold text-white mb-2 uppercase tracking-wide">Fast Timeline</h4>
                        <p class="text-sm text-slate-600">Rapid 7-day publication timeline.</p>
                    </div>
                    <div class="bg-[#2D6A4F] p-6 leaf-shape border-2 border-[#1B4332]">
                        <i class="fas fa-rupee-sign text-3xl text-lime mb-4"></i>
                        <h4 class="font-bold text-white mb-2 uppercase tracking-wide">Nominal Fee</h4>
                        <p class="text-sm text-slate-600">Accessible ₹200 processing fee.</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-4 font-sans">
                    <a href="emagazine-submit.php" class="bg-lime text-forest py-4 px-8 leaf-shape font-bold hover:bg-white transition-all text-sm uppercase tracking-widest shadow-md">
                        Submit Article
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Impact Statistics Section (Image 3 Style) -->
<section class="py-20 bg-[#4A3B2C] relative overflow-hidden border-t-8 border-[#D4E157]">
    <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(45deg, #1B4332 0, #1B4332 2px, transparent 2px, transparent 8px);"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4 font-['Oswald'] uppercase tracking-wider">Our Impact in Numbers</h2>
            <div class="w-24 h-2 bg-[#D4E157] mx-auto"></div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="bg-[#2D2319] p-8 rounded-tr-3xl rounded-bl-3xl border-2 border-[#D4E157] transform hover:-translate-y-2 transition-transform shadow-xl">
                <div class="text-5xl md:text-6xl font-bold text-[#D4E157] mb-2 font-['Oswald']">50+</div>
                <div class="text-white font-medium text-lg uppercase tracking-wide">Publications</div>
            </div>
            <div class="bg-[#2D2319] p-8 rounded-tr-3xl rounded-bl-3xl border-2 border-[#D4E157] transform hover:-translate-y-2 transition-transform shadow-xl">
                <div class="text-5xl md:text-6xl font-bold text-[#D4E157] mb-2 font-['Oswald']">20+</div>
                <div class="text-white font-medium text-lg uppercase tracking-wide">Global Reviewers</div>
            </div>
            <div class="bg-[#2D2319] p-8 rounded-tr-3xl rounded-bl-3xl border-2 border-[#D4E157] transform hover:-translate-y-2 transition-transform shadow-xl">
                <div class="text-5xl md:text-6xl font-bold text-[#D4E157] mb-2 font-['Oswald']">15+</div>
                <div class="text-white font-medium text-lg uppercase tracking-wide">Disciplines</div>
            </div>
            <div class="bg-[#2D2319] p-8 rounded-tr-3xl rounded-bl-3xl border-2 border-[#D4E157] transform hover:-translate-y-2 transition-transform shadow-xl">
                <div class="text-5xl md:text-6xl font-bold text-[#D4E157] mb-2 font-['Oswald']">100%</div>
                <div class="text-white font-medium text-lg uppercase tracking-wide">Open Access</div>
            </div>
        </div>
    </div>
</section>

<!-- Call for Papers (Image 2 Style) -->
<section class="py-24 bg-[#1B4332] relative overflow-hidden text-center">
    <!-- Wavy Top Divider -->
    <div class="absolute top-0 left-0 w-full overflow-hidden leading-none transform rotate-180">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-16">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#4A3B2C"></path>
        </svg>
    </div>
    <div class="container mx-auto px-6 relative z-10 pt-8">
        <h2 class="text-5xl md:text-6xl font-bold text-white mb-6 font-['Oswald'] uppercase tracking-widest drop-shadow-lg">Call For Papers</h2>
        <p class="text-xl text-slate-600 max-w-2xl mx-auto mb-10 font-medium text-white">Submit your original research and review articles for our upcoming issue. Experience rapid peer-review and global visibility.</p>
        <a href="ijari-submit.php" class="inline-flex items-center gap-3 bg-[#D4E157] text-[#1B4332] font-bold text-lg px-10 py-5 rounded-tl-3xl rounded-br-3xl hover:bg-white transition-all shadow-[0_8px_0_#9fb32c] hover:-translate-y-1 active:translate-y-2 active:shadow-none uppercase tracking-widest">
            <i class="fas fa-file-upload text-xl"></i> Submit Manuscript Now
        </a>
    </div>
</section>


<!-- Grid Layout (Infographic Style 1) -->
<section class="py-20 bg-white relative">
    <div class="container mx-auto px-6">
        <div class="inline-block bg-[#556B2F] text-white px-8 py-3 rounded-r-full font-bold text-xl uppercase tracking-widest mb-16 shadow-lg -ml-6 border-l-8 border-[#D4E157]">
            Growing Challenges
        </div>
        <div class="grid md:grid-cols-3 gap-10">
            <!-- Item 1 -->
            <div class="group">
                <div class="overflow-hidden rounded-tr-[3rem] rounded-bl-[3rem] mb-6 shadow-lg border-4 border-[#f7f9f4]">
                    <img src="assets/pop_growth.png" class="w-full h-56 object-cover transform group-hover:scale-110 transition-transform duration-500" alt="Population Growth">
                </div>
                <h3 class="text-xl font-bold text-[#1B4332] mb-3">Population Growth</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Increasing populations demand more from our agricultural systems, requiring innovative solutions for sustainable output.</p>
            </div>
            <!-- Item 2 -->
            <div class="group">
                <div class="overflow-hidden rounded-tr-[3rem] rounded-bl-[3rem] mb-6 shadow-lg border-4 border-[#f7f9f4]">
                    <img src="assets/climate_change.png" class="w-full h-56 object-cover transform group-hover:scale-110 transition-transform duration-500" alt="Climate Change">
                </div>
                <h3 class="text-xl font-bold text-[#1B4332] mb-3">Climate Change</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Unpredictable weather patterns and extreme conditions pose significant risks to global food security.</p>
            </div>
            <!-- Item 3 -->
            <div class="group">
                <div class="overflow-hidden rounded-tr-[3rem] rounded-bl-[3rem] mb-6 shadow-lg border-4 border-[#f7f9f4]">
                    <img src="assets/resource_scarcity.png" class="w-full h-56 object-cover transform group-hover:scale-110 transition-transform duration-500" alt="Resource Scarcity">
                </div>
                <h3 class="text-xl font-bold text-[#1B4332] mb-3">Resource Scarcity</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Depleting freshwater and arable land forces us to rethink resource management in modern farming.</p>
            </div>
        </div>
    </div>
</section>



<?php if (false): ?>
<!-- Asymmetric Layout (Infographic Style 2) -->
<section class="py-20 bg-[#f7f9f4] relative overflow-hidden">
    <div class="container mx-auto px-6 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <!-- Left side with solid green block and arched image -->
            <div class="lg:w-1/2 relative w-full flex justify-center py-10">
                <!-- Green background block -->
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-[85%] h-[110%] bg-[#556B2F] -z-10 rounded-r-[4rem] shadow-xl"></div>
                <!-- Arched Image -->
                <img src="assets/precision_ag.png" class="w-4/5 md:w-3/4 h-[500px] object-cover rounded-tr-[6rem] rounded-bl-[6rem] shadow-2xl border-8 border-white" alt="Precision Agriculture">
            </div>
            
            <!-- Right side with floating cards -->
            <div class="lg:w-1/2 w-full">
                <h2 class="text-4xl md:text-5xl font-bold text-[#1B4332] mb-12 font-['Oswald'] uppercase tracking-wider">Precision Agriculture</h2>
                <div class="flex flex-col gap-6">
                    <div class="bg-[#556B2F] text-white p-6 rounded-tr-[2rem] rounded-bl-[2rem] shadow-xl border-l-8 border-[#D4E157] transform transition-transform hover:-translate-y-1">
                        <h3 class="text-xl font-bold text-[#D4E157] mb-2 uppercase tracking-wide">Data Driven Decisions</h3>
                        <p class="text-sm text-slate-100">Utilizing advanced sensors, drones, and AI to monitor crop health and optimize yield with pinpoint accuracy.</p>
                    </div>
                    <div class="bg-[#556B2F] text-white p-6 rounded-tr-[2rem] rounded-bl-[2rem] shadow-xl border-l-8 border-[#D4E157] transform transition-transform hover:-translate-y-1 ml-0 md:ml-8">
                        <h3 class="text-xl font-bold text-[#D4E157] mb-2 uppercase tracking-wide">Resource Efficiency</h3>
                        <p class="text-sm text-slate-100">Targeted application of water, fertilizers, and pesticides minimizing waste and maximizing environmental sustainability.</p>
                    </div>
                    <div class="bg-[#556B2F] text-white p-6 rounded-tr-[2rem] rounded-bl-[2rem] shadow-xl border-l-8 border-[#D4E157] transform transition-transform hover:-translate-y-1">
                        <h3 class="text-xl font-bold text-[#D4E157] mb-2 uppercase tracking-wide">Targeted Interventions</h3>
                        <p class="text-sm text-slate-100">Addressing localized issues within a field rather than treating the entire area uniformly, reducing chemical usage.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- Vertical Farming Layout (Grid Style) -->
<section class="py-20 bg-white relative border-t-4 border-[#f7f9f4]">
    <div class="container mx-auto px-6">
        <div class="inline-block bg-[#556B2F] text-white px-8 py-3 rounded-r-full font-bold text-xl uppercase tracking-widest mb-16 shadow-lg -ml-6 border-l-8 border-[#D4E157]">
            Vertical Farming
        </div>
        <div class="grid md:grid-cols-3 gap-10">
            <!-- Item 1 -->
            <div class="group">
                <div class="overflow-hidden rounded-tr-[3rem] rounded-bl-[3rem] mb-6 shadow-lg border-4 border-[#f7f9f4]">
                    <img src="assets/vertical_space_1783953653078.png" class="w-full h-56 object-cover transform group-hover:scale-110 transition-transform duration-500" alt="Space Optimization">
                </div>
                <h3 class="text-xl font-bold text-[#1B4332] mb-3">Space Optimization</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Maximizing yield per square foot by stacking crops vertically in controlled environments.</p>
            </div>
            <!-- Item 2 -->
            <div class="group">
                <div class="overflow-hidden rounded-tr-[3rem] rounded-bl-[3rem] mb-6 shadow-lg border-4 border-[#f7f9f4]">
                    <img src="assets/vertical_controlled_1783953664961.png" class="w-full h-56 object-cover transform group-hover:scale-110 transition-transform duration-500" alt="Controlled Environment">
                </div>
                <h3 class="text-xl font-bold text-[#1B4332] mb-3">Controlled Environment</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Perfectly regulating light, humidity, and temperature for optimal year-round agricultural production.</p>
            </div>
            <!-- Item 3 -->
            <div class="group">
                <div class="overflow-hidden rounded-tr-[3rem] rounded-bl-[3rem] mb-6 shadow-lg border-4 border-[#f7f9f4]">
                    <img src="assets/vertical_urban_1783953677630.png" class="w-full h-56 object-cover transform group-hover:scale-110 transition-transform duration-500" alt="Urban Agriculture">
                </div>
                <h3 class="text-xl font-bold text-[#1B4332] mb-3">Urban Agriculture</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Bringing fresh, sustainable produce directly to bustling city centers, reducing transportation emissions.</p>
            </div>
        </div>
    </div>
</section>


<?php if (false): ?>
<!-- Regenerative Agriculture Layout (Asymmetric Style) -->
<section class="py-20 bg-[#f7f9f4] relative overflow-hidden">
    <div class="container mx-auto px-6 relative z-10">
        <div class="flex flex-col lg:flex-row-reverse items-center gap-16">
            <!-- Right side with solid green block and arched image -->
            <div class="lg:w-1/2 relative w-full flex justify-center py-10">
                <!-- Green background block (reversed) -->
                <div class="absolute right-0 top-1/2 -translate-y-1/2 w-[85%] h-[110%] bg-[#1B4332] -z-10 rounded-l-[4rem] shadow-xl"></div>
                <!-- Arched Image -->
                <img src="assets/regen_ag_1783953701249.png" class="w-4/5 md:w-3/4 h-[500px] object-cover rounded-tl-[6rem] rounded-br-[6rem] shadow-2xl border-8 border-white" alt="Regenerative Agriculture">
            </div>
            
            <!-- Left side with floating cards -->
            <div class="lg:w-1/2 w-full">
                <h2 class="text-4xl md:text-5xl font-bold text-[#1B4332] mb-12 font-['Oswald'] uppercase tracking-wider">Regenerative Agriculture</h2>
                <div class="flex flex-col gap-6">
                    <div class="bg-white p-6 rounded-tl-[2rem] rounded-br-[2rem] shadow-xl border-r-8 border-[#556B2F] transform transition-transform hover:-translate-y-1">
                        <h3 class="text-xl font-bold text-[#556B2F] mb-2 uppercase tracking-wide">Soil Health</h3>
                        <p class="text-sm text-slate-600">Restoring organic matter and microbial activity through reduced tillage and diverse cover cropping.</p>
                    </div>
                    <div class="bg-white p-6 rounded-tl-[2rem] rounded-br-[2rem] shadow-xl border-r-8 border-[#556B2F] transform transition-transform hover:-translate-y-1 mr-0 md:mr-8">
                        <h3 class="text-xl font-bold text-[#556B2F] mb-2 uppercase tracking-wide">Biodiversity</h3>
                        <p class="text-sm text-slate-600">Encouraging a rich ecosystem of flora, fauna, and insects to naturally manage pests and promote plant resilience.</p>
                    </div>
                    <div class="bg-white p-6 rounded-tl-[2rem] rounded-br-[2rem] shadow-xl border-r-8 border-[#556B2F] transform transition-transform hover:-translate-y-1">
                        <h3 class="text-xl font-bold text-[#556B2F] mb-2 uppercase tracking-wide">Carbon Sequestration</h3>
                        <p class="text-sm text-slate-600">Actively drawing down atmospheric CO2 and storing it in the ground, combating global climate change.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>






<!-- Publication Covers Section (1 Row, 2 Columns) -->
<section class="py-20 bg-[#f7f9f4] border-t border-gray-200">
    <div class="container mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-stretch">
            <!-- Magazine Cover Card -->
            <div class="bg-white shadow-[0_30px_60px_rgba(0,0,0,0.15)] relative overflow-hidden flex flex-col sm:flex-row h-[750px] border border-gray-100 rounded-3xl">
                <!-- Left Content -->
                <div class="w-full sm:w-[45%] p-8 sm:p-12 relative z-10 flex flex-col justify-between h-full bg-white">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#7CB342] rounded-tl-[1.2rem] rounded-br-[1.2rem] flex items-center justify-center text-white shrink-0 shadow-md">
                            <i class="fas fa-leaf text-xl"></i>
                        </div>
                        <span class="text-xs sm:text-sm font-bold text-[#1B4332] tracking-wider whitespace-nowrap">ISSN: XXXX-XXXX</span>
                    </div>
                    
                    <div class="my-auto">
                        <h4 class="text-2xl text-gray-500 font-light tracking-tight mb-1">e-monthly magazine</h4>
                        <h2 class="text-4xl sm:text-5xl font-bold text-[#1B4332] font-['Outfit'] leading-[1.15]">Farm Science<br>Today</h2>
                    </div>
                    
                    <div class="opacity-10 text-left">
                        <i class="fas fa-seedling text-8xl text-[#556B2F]"></i>
                    </div>
                </div>
                
                <!-- Right Content (Curved Green Background) -->
                <div class="w-full sm:w-[55%] bg-[#6a9923] p-8 sm:p-12 relative z-10 flex flex-col justify-between h-full rounded-l-[4rem] sm:rounded-l-[10rem] text-white pl-12 sm:pl-14 shadow-[-15px_0_30px_rgba(0,0,0,0.1)]">
                    <div class="my-auto pt-10">
                        <h3 class="text-2xl font-light mb-6 border-b border-white/30 pb-2 inline-block">Subjects Covered</h3>
                        <ul class="text-base font-bold leading-snug flex items-start gap-3">
                            <div class="mt-1 shrink-0 bg-white w-8 h-8 rounded-full flex items-center justify-center text-[#6a9923] shadow-md">
                                <i class="fas fa-check text-sm"></i>
                            </div>
                            <li class="tracking-wide">Agriculture,<br>Horticulture,<br>Forestry, Fisheries,<br>Biotech, Social<br>Sciences, Engineering</li>
                        </ul>
                    </div>
                    
                    <div class="mt-auto flex flex-col gap-1 relative z-30">
                        <span class="text-sm font-semibold opacity-80">More Info:</span>
                        <a href="https://www.ijari.in" target="_blank" class="flex items-center gap-2 text-[13px] font-bold hover:text-[#D4E157] transition-colors"><i class="fas fa-globe text-xl opacity-75"></i> www.ijari.in</a>
                    </div>
                </div>
                
                <!-- Circular Images overlapping the curved boundary -->
                <div class="absolute top-12 right-12 w-28 h-28 rounded-full border-4 border-white overflow-hidden shadow-2xl z-20 hidden sm:block group">
                    <img src="assets/vertical_urban_1783953677630.png" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Subject">
                </div>
                <div class="absolute bottom-12 right-12 w-32 h-32 rounded-full border-4 border-white overflow-hidden shadow-2xl z-20 hidden sm:block group">
                    <img src="assets/regen_ag_1783953701249.png" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Subject">
                </div>
            </div>

            <!-- Journal Cover Card -->
            <div class="bg-white shadow-[0_30px_60px_rgba(0,0,0,0.15)] relative flex flex-col p-8 sm:p-12 h-[750px] border border-gray-100 rounded-3xl justify-between">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <span class="text-xl font-bold text-gray-800">ISSN: XXXX-XXXX</span>
                    <span class="text-xl font-bold text-gray-800">2026</span>
                </div>
                
                <!-- Title -->
                <div class="text-center my-auto px-4">
                    <h2 class="text-xl sm:text-[1.75rem] font-extrabold text-[#556B2F] leading-[1.3] tracking-wide uppercase font-['Oswald']">
                        International Journal of<br>Agricultural Research and Innovation
                    </h2>
                </div>
                
                <!-- Publisher -->
                <div class="mb-6 pl-4 border-l-4 border-[#556B2F]">
                    <span class="text-xs font-bold text-gray-500 tracking-widest uppercase">Published By: IJARI Research Foundation</span>
                </div>
                
                <!-- Geometric Layout -->
                <div class="relative w-full h-[400px] flex group mt-auto">
                    <!-- Left Side Images (Diagonal Cuts) -->
                    <div class="w-[55%] h-full flex flex-col gap-3 relative z-10">
                        <div class="w-full h-1/2 overflow-hidden shadow-md" style="clip-path: polygon(0 0, 100% 0, 80% 100%, 0% 100%);">
                            <img src="assets/pop_growth.png" class="w-full h-full object-cover transform scale-[1.15] group-hover:scale-110 transition-transform duration-700" alt="Agri">
                        </div>
                        <div class="w-full h-1/2 overflow-hidden shadow-md" style="clip-path: polygon(0 0, 80% 0, 100% 100%, 0% 100%);">
                            <img src="assets/climate_change.png" class="w-full h-full object-cover transform scale-[1.15] group-hover:scale-110 transition-transform duration-700" alt="Agri 2">
                        </div>
                    </div>
                    
                    <!-- Right Side Green Blocks -->
                    <div class="w-[55%] absolute right-0 top-0 h-full flex flex-col justify-between -z-0 pl-2">
                        <div class="w-full h-[45%] bg-[#556B2F]" style="clip-path: polygon(20% 0, 100% 0, 100% 100%, 0% 100%);"></div>
                        <div class="w-full h-[52%] relative overflow-hidden" style="clip-path: polygon(0 0, 100% 0, 100% 100%, 20% 100%);">
                            <img src="assets/vertical_space_1783953653078.png" class="w-full h-full object-cover" alt="Agri 3">
                            <div class="absolute inset-0 bg-green-900/40 mix-blend-multiply"></div>
                            <div class="absolute inset-0 bg-[#556B2F] mix-blend-color"></div>
                        </div>
                    </div>
                    
                    <!-- Horizontal Green Bar Overlapping -->
                    <div class="absolute top-[48%] -translate-y-1/2 w-full h-12 bg-[#4A3B2C] z-20 flex justify-between items-center px-6 text-white text-xs sm:text-sm font-bold tracking-widest shadow-xl border-y border-[#D4E157]/30">
                        <a href="https://www.ijari.in" target="_blank" class="hover:text-[#D4E157] transition-colors">WWW.IJARI.IN</a>
                        <a href="tel:+919729848196" class="hover:text-[#D4E157] transition-colors">+919729848196</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Editorial Members Showcase (Image 1 Style) -->
<section class="py-20 bg-[#f7f9f4]">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-end mb-12">
            <div>
                <span class="text-[#556B2F] font-bold tracking-widest uppercase text-sm mb-3 block font-['Oswald']">Our Experts</span>
                <h2 class="text-4xl md:text-5xl font-bold text-[#1B4332] font-['Oswald'] uppercase tracking-wide">Key Editorial Members</h2>
            </div>
            <a href="ijari-editorial-board.php" class="hidden md:inline-flex items-center gap-2 text-[#1B4332] font-bold hover:text-[#556B2F] transition-colors border-b-2 border-[#D4E157] pb-1 uppercase tracking-wider">
                View Full Board <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-tr-[3rem] rounded-bl-[3rem] shadow-xl border-2 border-transparent hover:border-[#D4E157] transition-all text-center group">
                <div class="w-32 h-32 mx-auto rounded-tl-[2rem] rounded-br-[2rem] bg-emerald-100 flex items-center justify-center text-4xl text-emerald-600 mb-6 border-4 border-white shadow-md group-hover:scale-105 transition-transform overflow-hidden">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3 class="text-xl font-bold text-[#1B4332] mb-1 font-['Oswald'] uppercase">Dr. Praveen Kumar</h3>
                <p class="text-[#556B2F] text-sm font-bold mb-3 uppercase tracking-wide">Editor in Chief</p>
                <p class="text-slate-500 text-sm">Dr. Rajendra Prasad Central Agricultural University</p>
            </div>
            <div class="bg-white p-6 rounded-tr-[3rem] rounded-bl-[3rem] shadow-xl border-2 border-transparent hover:border-[#D4E157] transition-all text-center group">
                <div class="w-32 h-32 mx-auto rounded-tl-[2rem] rounded-br-[2rem] bg-emerald-100 flex items-center justify-center text-4xl text-emerald-600 mb-6 border-4 border-white shadow-md group-hover:scale-105 transition-transform overflow-hidden">
                    <i class="fas fa-user"></i>
                </div>
                <h3 class="text-xl font-bold text-[#1B4332] mb-1 font-['Oswald'] uppercase">Dr. Abhishek Raj</h3>
                <p class="text-[#556B2F] text-sm font-bold mb-3 uppercase tracking-wide">Executive Member</p>
                <p class="text-slate-500 text-sm">Dr. Rajendra Prasad Central Agricultural University</p>
            </div>
            <div class="bg-white p-6 rounded-tr-[3rem] rounded-bl-[3rem] shadow-xl border-2 border-transparent hover:border-[#D4E157] transition-all text-center group">
                <div class="w-32 h-32 mx-auto rounded-tl-[2rem] rounded-br-[2rem] bg-emerald-100 flex items-center justify-center text-4xl text-emerald-600 mb-6 border-4 border-white shadow-md group-hover:scale-105 transition-transform overflow-hidden">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h3 class="text-xl font-bold text-[#1B4332] mb-1 font-['Oswald'] uppercase">Dr. Hemant Kumar</h3>
                <p class="text-[#556B2F] text-sm font-bold mb-3 uppercase tracking-wide">Advisory Member</p>
                <p class="text-slate-500 text-sm">Dr. Rajendra Prasad Central Agricultural University</p>
            </div>
        </div>
    </div>
</section>
        
<?php include "footer.php"; ?>