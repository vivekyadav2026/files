<?php include 'header.php'; ?>

        
    <div class="relative bg-[#1c2e1a] text-white py-12 md:py-16 overflow-hidden border-b border-[#2d472a] text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="assets/banner_slide_3.png" alt="Our Society" class="w-full h-full object-cover object-center opacity-25 scale-105 filter blur-[1px]">
            <div class="absolute inset-0 bg-[#1c2e1a]/85"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#1c2e1a] via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="index.php" class="hover:text-white transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                    <li><span class="mx-1 text-slate-500">/</span></li>
                    <li aria-current="page" class="text-white">Society</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-white drop-shadow-md">Our Society</h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto font-light leading-relaxed drop-shadow">The driving force behind our publishing initiatives.</p>
        </div>
    </div>
    
        
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-4xl">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 md:p-12 prose prose-emerald prose-lg max-w-none text-slate-600">
                <p class="lead">The agricultural research society backing IJARI is committed to fostering innovation and collaboration among scientists, academicians, and extension professionals globally.</p>
                
                <h3 class="text-2xl font-bold text-slate-900 font-['Outfit'] mt-10 mb-6 border-b border-slate-100 pb-2">Objectives</h3>
                
                <ul class="space-y-4 not-prose">
                    <li class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0"><i class="fas fa-check text-xs"></i></div>
                        <span class="text-slate-700">To promote and disseminate high-quality research in agricultural and allied sciences.</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0"><i class="fas fa-check text-xs"></i></div>
                        <span class="text-slate-700">To provide a platform for young researchers and students to showcase their innovations.</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0"><i class="fas fa-check text-xs"></i></div>
                        <span class="text-slate-700">To organize workshops, seminars, and conferences addressing contemporary challenges in agriculture.</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0"><i class="fas fa-check text-xs"></i></div>
                        <span class="text-slate-700">To publish reputable journals and magazines that serve the farming community and academia alike.</span>
                    </li>
                </ul>
                
                <div class="mt-10 bg-emerald-50 rounded-2xl p-6 border border-emerald-100 text-emerald-900 not-prose text-center">
                    <i class="fas fa-hands-helping text-3xl text-emerald-400 mb-3"></i>
                    <p class="font-medium">We welcome researchers and professionals to join our network and contribute to the advancement of sustainable agriculture.</p>
                </div>
            </div>
        </div>
        
<?php include 'footer.php'; ?>