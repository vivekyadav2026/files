<?php include "header.php"; ?>

<div class="relative bg-emerald-50 text-emerald-950 py-12 md:py-16 overflow-hidden border-b border-emerald-100 text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="assets/light_banner_v2.png" alt="Plagiarism Policy" class="w-full h-full object-cover object-center opacity-40 ">
            <div class="absolute inset-0 bg-white/70"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-50 via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-600" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="index.php" class="hover:text-emerald-900 transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                    <li><span class="mx-1 text-slate-500">/</span></li>
                    <li aria-current="page" class="text-emerald-950 font-semibold">IJARI > Plagiarism Policy</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-emerald-900">Plagiarism Policy</h1>
            <p class="text-lg md:text-xl text-slate-600 max-w-3xl mx-auto font-light leading-relaxed">Maintaining originality and academic integrity.</p>
        </div>
    </div>
    
        
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-4xl">
            <div class="bg-white rounded-tr-[4rem] rounded-bl-[4rem] shadow-2xl border-t-8 border-[#D4E157] relative overflow-hidden p-8 md:p-12 prose prose-emerald prose-lg prose-headings:font-['Oswald'] prose-headings:uppercase prose-headings:tracking-wide prose-headings:text-[#1B4332] max-w-none text-slate-600">
                <div class="flex items-center gap-4 mb-6 not-prose p-4 bg-red-50 text-red-800 rounded-xl border border-red-100">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-500"></i>
                    <p class="font-medium">IJARI maintains a strict zero-tolerance policy towards plagiarism and intellectual property theft.</p>
                </div>
                
                <p>All submissions are screened using industry-standard plagiarism-detection software prior to review. While original work with zero similarity is the goal, IJARI permits a <strong>maximum similarity threshold of 10%</strong>, consistent with common international indexing standards.</p>
                
                <ul class="space-y-2 mt-6">
                    <li>Any manuscript exceeding the 10% similarity index will be immediately rejected and returned to the author without review.</li>
                    <li><strong>Self-plagiarism</strong> (reusing one's own previously published work without proper citation) is also strictly unacceptable.</li>
                    <li>Authors must ensure proper attribution is given for all data, text, figures, and ideas originating from other sources.</li>
                </ul>
            </div>
        </div>
        
<?php include "footer.php"; ?>