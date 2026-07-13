<?php include "header.php"; ?>

<div class="relative bg-emerald-900 text-white py-12 md:py-16 overflow-hidden border-b border-emerald-800 text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="assets/banner_slide_2.png" alt="Submission Guidelines" class="w-full h-full object-cover object-center opacity-25 scale-105 filter blur-[1px]">
            <div class="absolute inset-0 bg-emerald-900/85"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900 via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="index.php" class="hover:text-white transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                    <li><span class="mx-1 text-slate-500">/</span></li>
                    <li aria-current="page" class="text-white">e-Magazine > Guidelines</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-white drop-shadow-md">Submission Guidelines</h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto font-light leading-relaxed drop-shadow">Formatting requirements for Farm Science Today articles.</p>
        </div>
    </div>
    
        
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-4xl">
            <div class="bg-white rounded-tr-[4rem] rounded-bl-[4rem] shadow-2xl border-t-8 border-[#D4E157] relative overflow-hidden p-8 md:p-12 prose prose-emerald prose-lg prose-headings:font-['Oswald'] prose-headings:uppercase prose-headings:tracking-wide prose-headings:text-[#1B4332] max-w-none text-slate-600">
                <p class="lead">To ensure smooth and timely processing of your submission, authors are requested to carefully follow the guidelines below before submitting their articles.</p>
                
                <div class="grid md:grid-cols-2 gap-8 not-prose mt-10">
                    <div class="bg-[#f7f9f4] p-6 rounded-2xl border border-slate-100">
                        <h4 class="font-bold text-lg text-slate-900 mb-4 font-['Outfit'] border-b border-slate-200 pb-2">Manuscript Length & Format</h4>
                        <ul class="space-y-3 text-sm text-slate-600">
                            <li><i class="fas fa-check text-emerald-500 mr-2"></i> Max length: <strong>1500–2000 words</strong></li>
                            <li><i class="fas fa-check text-emerald-500 mr-2"></i> Format: Microsoft Word (.doc/.docx)</li>
                            <li><i class="fas fa-check text-emerald-500 mr-2"></i> Font: Times New Roman, size 12</li>
                            <li><i class="fas fa-check text-emerald-500 mr-2"></i> Spacing: 1.5-line throughout</li>
                            <li><i class="fas fa-check text-emerald-500 mr-2"></i> Title: Short, clear, and informative</li>
                        </ul>
                    </div>
                    
                    <div class="bg-[#f7f9f4] p-6 rounded-2xl border border-slate-100">
                        <h4 class="font-bold text-lg text-slate-900 mb-4 font-['Outfit'] border-b border-slate-200 pb-2">Authorship</h4>
                        <ul class="space-y-3 text-sm text-slate-600">
                            <li><i class="fas fa-check text-emerald-500 mr-2"></i> Full names (e.g. Rajesh Kumar)</li>
                            <li><i class="fas fa-check text-emerald-500 mr-2"></i> Maximum of 5 authors</li>
                            <li><i class="fas fa-check text-emerald-500 mr-2"></i> Include full affiliations below names</li>
                            <li><i class="fas fa-check text-emerald-500 mr-2"></i> Provide email of corresponding author</li>
                        </ul>
                    </div>
                </div>

                <h3 class="font-['Outfit'] text-2xl font-bold text-slate-900 mt-10">Content Structure</h3>
                <p>The article should be written in clear, simple language, intelligible to a broad readership. It must include:</p>
                <ul>
                    <li>A brief summary of the article.</li>
                    <li>A short introduction explaining the scope and relevance.</li>
                    <li>A complete account of the methodology and results/discussion.</li>
                    <li>A well-articulated conclusion.</li>
                </ul>

                <div class="bg-emerald-50 p-6 rounded-2xl border border-emerald-100 not-prose my-10">
                    <div class="flex items-start gap-4">
                        <i class="fas fa-image text-3xl text-emerald-500 mt-1"></i>
                        <div>
                            <h4 class="font-bold text-lg text-emerald-900 mb-1 font-['Outfit']">Visual Content Requirement</h4>
                            <p class="text-emerald-800/80 text-sm">Authors must include <strong>at least one relevant colour figure, photograph, or illustration</strong> within the text to enhance reader engagement and clarity.</p>
                        </div>
                    </div>
                </div>

                <h3 class="font-['Outfit'] text-2xl font-bold text-slate-900 mt-10">Author Declaration</h3>
                <p>All authors are required to confirm their individual contribution to the article and accept joint responsibility for the content, including any disputes that may arise from authorship or intellectual property claims.</p>
            </div>
        </div>
        
<?php include "footer.php"; ?>