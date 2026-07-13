<?php include 'header.php'; ?>

        
    <div class="relative bg-emerald-900 text-white py-12 md:py-16 overflow-hidden border-b border-emerald-800 text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="assets/banner_slide_2.png" alt="About Us" class="w-full h-full object-cover object-center opacity-25 scale-105 filter blur-[1px]">
            <div class="absolute inset-0 bg-emerald-900/85"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900 via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="index.php" class="hover:text-white transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                    <li><span class="mx-1 text-slate-500">/</span></li>
                    <li aria-current="page" class="text-white">About Us</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-white drop-shadow-md">About Us</h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto font-light leading-relaxed drop-shadow">Learn about the organization and vision behind the International Journal of Agricultural Research and Innovation.</p>
        </div>
    </div>
    
        
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-4xl">
            <div class="bg-white rounded-tr-[4rem] rounded-bl-[4rem] shadow-2xl border-t-8 border-[#D4E157] relative overflow-hidden p-8 md:p-12 prose prose-emerald prose-lg prose-headings:font-['Oswald'] prose-headings:uppercase prose-headings:tracking-wide prose-headings:text-[#1B4332] max-w-none text-slate-600">
                <p class="lead text-xl text-slate-700 font-medium">Welcome to the official platform of the International Journal of Agricultural Research and Innovation (IJARI) and the Farm Science Today e-Magazine. We are dedicated to the rapid, open-access dissemination of scientific knowledge across all domains of agriculture.</p>
                
                <h3 class="text-2xl font-bold text-slate-900 font-['Outfit'] mt-10 mb-4 border-b border-slate-100 pb-2">Our Mission</h3>
                <p>To bridge the gap between advanced agricultural research and practical application by supporting researchers, farmers, policymakers, and industry stakeholders in making evidence-based decisions for a sustainable future.</p>
                
                <h3 class="text-2xl font-bold text-slate-900 font-['Outfit'] mt-10 mb-4 border-b border-slate-100 pb-2">Our Publications</h3>
                <div class="grid md:grid-cols-2 gap-6 not-prose mt-6">
                    <div class="bg-[#f7f9f4] p-6 rounded-2xl border border-slate-100">
                        <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-xl mb-4"><i class="fas fa-book"></i></div>
                        <h4 class="font-bold text-lg text-slate-900 mb-2">IJARI Journal</h4>
                        <p class="text-slate-600 text-sm">A quarterly, double-blind peer-reviewed journal publishing original research and review articles.</p>
                    </div>
                    <div class="bg-[#f7f9f4] p-6 rounded-2xl border border-slate-100">
                        <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-xl mb-4"><i class="fas fa-file-alt"></i></div>
                        <h4 class="font-bold text-lg text-slate-900 mb-2">Farm Science Today</h4>
                        <p class="text-slate-600 text-sm">A monthly e-Magazine presenting scientific knowledge in an accessible format for progressive farmers and students.</p>
                    </div>
                </div>
            </div>
        </div>
        
<?php include 'footer.php'; ?>