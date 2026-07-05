<?php include 'header.php'; ?>

        
    <div class="relative bg-slate-900 text-white py-24 overflow-hidden border-b border-slate-800 text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="assets/banner_slide_1.png" alt="Archives" class="w-full h-full object-cover object-center opacity-30 scale-105 filter blur-[1px]">
            <div class="absolute inset-0 bg-slate-950/85"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="index.php" class="hover:text-white transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                    <li><span class="mx-1 text-slate-500">/</span></li>
                    <li aria-current="page" class="text-white">IJARI > Archives</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-white drop-shadow-md">Archives</h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto font-light leading-relaxed drop-shadow">Browse past issues of the International Journal of Agricultural Research and Innovation.</p>
        </div>
    </div>
    
        
        <div class="container mx-auto px-6 py-24 max-w-4xl text-center">
            <div class="py-20 bg-white rounded-3xl shadow-sm border border-slate-100 flex flex-col items-center">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-folder-open text-4xl text-slate-300"></i>
                </div>
                <h2 class="text-3xl font-bold text-slate-800 mb-3 font-['Outfit']">No Past Issues Found</h2>
                <p class="text-slate-500 max-w-md text-lg">The archives will be populated once the first issue is fully processed and published.</p>
                <a href="ijari-submit.php" class="mt-8 px-6 py-3 bg-emerald-50 text-emerald-700 font-medium rounded-xl hover:bg-emerald-100 transition-colors">Submit a Manuscript</a>
            </div>
        </div>
        
<?php include 'footer.php'; ?>