<?php include 'header.php'; ?>

        
    <div class="relative bg-[#1c2e1a] text-white py-12 md:py-16 overflow-hidden border-b border-[#2d472a] text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="assets/banner_slide_1.png" alt="Peer Review Process" class="w-full h-full object-cover object-center opacity-25 scale-105 filter blur-[1px]">
            <div class="absolute inset-0 bg-[#1c2e1a]/85"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#1c2e1a] via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="index.php" class="hover:text-white transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                    <li><span class="mx-1 text-slate-500">/</span></li>
                    <li aria-current="page" class="text-white">IJARI > Peer Review</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-white drop-shadow-md">Peer Review Process</h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto font-light leading-relaxed drop-shadow">Ensuring scientific validity and quality.</p>
        </div>
    </div>
    
        
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-4xl">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 md:p-12 prose prose-emerald prose-lg max-w-none text-slate-600">
                <p class="lead">IJARI follows a rigorous <strong>double-blind peer review</strong> process to ensure the integrity, originality, and quality of published research.</p>
                
                <div class="not-prose my-12 relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-emerald-100 hidden md:block"></div>
                    
                    <div class="space-y-8">
                        <div class="flex gap-6 relative">
                            <div class="w-16 h-16 rounded-full bg-emerald-100 border-4 border-white shadow-sm flex items-center justify-center text-emerald-600 text-xl shrink-0 z-10 hidden md:flex font-bold">1</div>
                            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex-grow">
                                <h4 class="font-bold text-lg text-slate-900 mb-2 font-['Outfit']">Initial Screening</h4>
                                <p class="text-slate-600 text-sm">All submissions undergo initial screening by the Editorial Office to confirm scope, originality (plagiarism check), and formatting compliance.</p>
                            </div>
                        </div>
                        
                        <div class="flex gap-6 relative">
                            <div class="w-16 h-16 rounded-full bg-emerald-100 border-4 border-white shadow-sm flex items-center justify-center text-emerald-600 text-xl shrink-0 z-10 hidden md:flex font-bold">2</div>
                            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex-grow">
                                <h4 class="font-bold text-lg text-slate-900 mb-2 font-['Outfit']">Expert Review</h4>
                                <p class="text-slate-600 text-sm">Manuscripts meeting the criteria proceed to review by at least two independent subject-matter experts from relevant fields.</p>
                            </div>
                        </div>
                        
                        <div class="flex gap-6 relative">
                            <div class="w-16 h-16 rounded-full bg-emerald-100 border-4 border-white shadow-sm flex items-center justify-center text-emerald-600 text-xl shrink-0 z-10 hidden md:flex font-bold">3</div>
                            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex-grow">
                                <h4 class="font-bold text-lg text-slate-900 mb-2 font-['Outfit']">Double-Blind Confidentiality</h4>
                                <p class="text-slate-600 text-sm">Reviewer identities and author identities remain strictly confidential to one another throughout the process to prevent bias.</p>
                            </div>
                        </div>
                        
                        <div class="flex gap-6 relative">
                            <div class="w-16 h-16 rounded-full bg-emerald-500 border-4 border-white shadow-sm flex items-center justify-center text-white text-xl shrink-0 z-10 hidden md:flex font-bold">4</div>
                            <div class="bg-emerald-50 p-6 rounded-2xl border border-emerald-100 flex-grow">
                                <h4 class="font-bold text-lg text-emerald-900 mb-2 font-['Outfit']">Final Decision</h4>
                                <p class="text-emerald-800/80 text-sm">Final publication decisions rest with the Editor-in-Chief, informed by reviewer feedback and guidance from the Editorial Board.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <p>The Editorial Office provides administrative support to maintain review integrity while ensuring a rapid, efficient turnaround for authors.</p>
            </div>
        </div>
        
<?php include 'footer.php'; ?>