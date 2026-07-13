<?php include 'header.php'; ?>

        
    <div class="relative bg-emerald-900 text-white py-12 md:py-16 overflow-hidden border-b border-emerald-800 text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="assets/banner_slide_2.png" alt="Editorial Board" class="w-full h-full object-cover object-center opacity-25 scale-105 filter blur-[1px]">
            <div class="absolute inset-0 bg-emerald-900/85"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900 via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="index.php" class="hover:text-white transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                    <li><span class="mx-1 text-slate-500">/</span></li>
                    <li aria-current="page" class="text-white">IJARI > Editorial Board</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-white drop-shadow-md">Editorial Board</h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto font-light leading-relaxed drop-shadow">Meet the experts guiding the scientific integrity of IJARI.</p>
        </div>
    </div>
    
        
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-6xl">
            <!-- Editor in Chief -->
            <div class="mb-16">
                <div class="flex items-center gap-4 mb-8">
                    <h2 class="text-3xl font-bold text-slate-900 font-['Outfit']">Editor in Chief</h2>
                    <div class="h-px bg-slate-200 flex-grow"></div>
                </div>
                
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 flex flex-col sm:flex-row items-center sm:items-start gap-8 max-w-2xl">
                    <div class="w-24 h-24 rounded-full bg-emerald-100 border-4 border-white shadow-lg flex items-center justify-center text-emerald-600 text-3xl shrink-0">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="text-center sm:text-left">
                        <h3 class="font-bold text-2xl text-slate-900 mb-1 font-['Outfit']">Dr. Praveen Kumar</h3>
                        <p class="text-emerald-600 font-medium mb-3 tracking-wide text-sm uppercase">Assistant Professor (Extension Education)</p>
                        <p class="text-slate-500 mb-4 flex items-start sm:justify-start justify-center gap-2">
                            <i class="fas fa-university text-slate-400 mt-1"></i>
                            <span class="max-w-[300px]">Dr. Rajendra Prasad Central Agricultural University Pusa Samastipur</span>
                        </p>
                        <a href="mailto:praveen22@rpcau.ac.in" class="inline-flex items-center gap-2 bg-[#f7f9f4] hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors border border-slate-200">
                            <i class="fas fa-envelope text-emerald-500"></i> praveen22@rpcau.ac.in
                        </a>
                    </div>
                </div>
            </div>

            <!-- Executive Members -->
            <div class="mb-16">
                <div class="flex items-center gap-4 mb-8">
                    <h2 class="text-3xl font-bold text-slate-900 font-['Outfit']">Executive Members</h2>
                    <div class="h-px bg-slate-200 flex-grow"></div>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Member Card -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-emerald-100 transition-all group">
                        <div class="w-14 h-14 rounded-xl bg-[#f7f9f4] group-hover:bg-emerald-50 text-slate-400 group-hover:text-emerald-500 flex items-center justify-center text-xl mb-4 transition-colors">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-1 font-['Outfit']">Dr. Abhishek Raj</h3>
                        <p class="text-emerald-600 text-sm font-medium mb-3">Asst. Prof. (Forest Products)</p>
                        <p class="text-slate-500 text-sm leading-relaxed">Dr. Rajendra Prasad Central Agricultural University, Pusa, Samastipur</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-emerald-100 transition-all group">
                        <div class="w-14 h-14 rounded-xl bg-[#f7f9f4] group-hover:bg-emerald-50 text-slate-400 group-hover:text-emerald-500 flex items-center justify-center text-xl mb-4 transition-colors">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-1 font-['Outfit']">Dr. Rajan Kumar</h3>
                        <p class="text-emerald-600 text-sm font-medium mb-3">Assoc. Professor (Agronomy)</p>
                        <p class="text-slate-500 text-sm leading-relaxed">Dr. Rajendra Prasad Central Agricultural University, Pusa, Samastipur</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-emerald-100 transition-all group">
                        <div class="w-14 h-14 rounded-xl bg-[#f7f9f4] group-hover:bg-emerald-50 text-slate-400 group-hover:text-emerald-500 flex items-center justify-center text-xl mb-4 transition-colors">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-1 font-['Outfit']">Dr. Siddhant Padhi</h3>
                        <p class="text-emerald-600 text-sm font-medium mb-3">Scientist (Plant Genetic Resource)</p>
                        <p class="text-slate-500 text-sm leading-relaxed">National Bureau of Plant Genetic Resource, New Delhi</p>
                    </div>
                </div>
            </div>
            
            <!-- Advisory Members -->
            <div class="mb-16">
                <div class="flex items-center gap-4 mb-8">
                    <h2 class="text-3xl font-bold text-slate-900 font-['Outfit']">Advisory Members</h2>
                    <div class="h-px bg-slate-200 flex-grow"></div>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-emerald-100 transition-all group">
                        <div class="w-14 h-14 rounded-xl bg-[#f7f9f4] group-hover:bg-emerald-50 text-slate-400 group-hover:text-emerald-500 flex items-center justify-center text-xl mb-4 transition-colors">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-1 font-['Outfit']">Dr. Hemant Kumar</h3>
                        <p class="text-emerald-600 text-sm font-medium mb-3">Associate Professor (Forestry)</p>
                        <p class="text-slate-500 text-sm leading-relaxed">Dr. Rajendra Prasad Central Agricultural University, Pusa, Samastipur</p>
                    </div>
                </div>
            </div>

            <!-- Members -->
            <div>
                <div class="flex items-center gap-4 mb-8">
                    <h2 class="text-3xl font-bold text-slate-900 font-['Outfit']">Members</h2>
                    <div class="h-px bg-slate-200 flex-grow"></div>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-emerald-100 transition-all group">
                        <div class="w-14 h-14 rounded-xl bg-[#f7f9f4] group-hover:bg-emerald-50 text-slate-400 group-hover:text-emerald-500 flex items-center justify-center text-xl mb-4 transition-colors">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-1 font-['Outfit']">Dr. Theja Anguli</h3>
                        <p class="text-emerald-600 text-sm font-medium mb-3">Scientist (Horticulture)</p>
                        <p class="text-slate-500 text-sm leading-relaxed">ICAR-RC for NEHR, Umiam</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-emerald-100 transition-all group">
                        <div class="w-14 h-14 rounded-xl bg-[#f7f9f4] group-hover:bg-emerald-50 text-slate-400 group-hover:text-emerald-500 flex items-center justify-center text-xl mb-4 transition-colors">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-1 font-['Outfit']">Dr. Sanjay Kumar</h3>
                        <p class="text-emerald-600 text-sm font-medium mb-3">Assistant Professor (Entomology)</p>
                        <p class="text-slate-500 text-sm leading-relaxed">Dr. Rajendra Prasad Central Agricultural University, Pusa, Samastipur</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-emerald-100 transition-all group">
                        <div class="w-14 h-14 rounded-xl bg-[#f7f9f4] group-hover:bg-emerald-50 text-slate-400 group-hover:text-emerald-500 flex items-center justify-center text-xl mb-4 transition-colors">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-1 font-['Outfit']">Dr. Krishna D.K.</h3>
                        <p class="text-emerald-600 text-sm font-medium mb-3">Assistant Professor (Extension Education)</p>
                        <p class="text-slate-500 text-sm leading-relaxed">Bihar Agricultural University, Sabour, Bhagalpur</p>
                    </div>
                </div>
            </div>
        </div>
        
<?php include 'footer.php'; ?>