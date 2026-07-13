<?php include "header.php"; ?>

<div class="relative bg-emerald-900 text-white py-12 md:py-16 overflow-hidden border-b border-emerald-800 text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="assets/banner_slide_2.png" alt="Instructions to Author" class="w-full h-full object-cover object-center opacity-25 scale-105 filter blur-[1px]">
            <div class="absolute inset-0 bg-emerald-900/85"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900 via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="index.php" class="hover:text-white transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                    <li><span class="mx-1 text-slate-500">/</span></li>
                    <li aria-current="page" class="text-white">IJARI > Instructions to Author</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-white drop-shadow-md">Instructions to Author</h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto font-light leading-relaxed drop-shadow">Guidelines to ensure smooth processing of manuscripts.</p>
        </div>
    </div>
    
        
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-4xl">
            <div class="bg-white rounded-tr-[4rem] rounded-bl-[4rem] shadow-2xl border-t-8 border-[#D4E157] relative overflow-hidden p-8 md:p-12 prose prose-emerald prose-lg prose-headings:font-['Oswald'] prose-headings:uppercase prose-headings:tracking-wide prose-headings:text-[#1B4332] max-w-none text-slate-600">
                <p class="lead">Authors are requested to rigorously follow the guidelines below to ensure rapid and smooth processing of their manuscripts.</p>
                
                <h3 class="font-['Outfit'] text-2xl font-bold text-slate-900 mt-10">Manuscript Preparation</h3>
                <ul class="not-prose space-y-3 mt-4">
                    <li class="flex items-center gap-3 p-3 bg-[#f7f9f4] rounded-lg border border-slate-100"><i class="fas fa-language text-emerald-500 w-5"></i> <strong>Language:</strong> English</li>
                    <li class="flex items-center gap-3 p-3 bg-[#f7f9f4] rounded-lg border border-slate-100"><i class="fas fa-file-word text-emerald-500 w-5"></i> <strong>Format:</strong> Microsoft Word (.doc or .docx)</li>
                    <li class="flex items-center gap-3 p-3 bg-[#f7f9f4] rounded-lg border border-slate-100"><i class="fas fa-font text-emerald-500 w-5"></i> <strong>Font:</strong> Times New Roman, 12 pt, 1.5-line spacing</li>
                    <li class="flex items-center gap-3 p-3 bg-[#f7f9f4] rounded-lg border border-slate-100"><i class="fas fa-list-ol text-emerald-500 w-5"></i> <strong>Structure:</strong> Title, Abstract, Keywords, Introduction, Materials & Methods, Results & Discussion, Conclusion, References.</li>
                </ul>
                
                <h3 class="font-['Outfit'] text-2xl font-bold text-slate-900 mt-10">Title Page</h3>
                <p>Include the full title of the manuscript, complete names of all authors, affiliations, and the email address of the corresponding author.</p>
                
                <h3 class="font-['Outfit'] text-2xl font-bold text-slate-900 mt-10">Abstract and Keywords</h3>
                <p>The abstract should not exceed <strong>250 words</strong> and must concisely summarize the objectives, methodology, key findings, and conclusion. Provide 4-6 relevant keywords below the abstract.</p>
                
                <h3 class="font-['Outfit'] text-2xl font-bold text-slate-900 mt-10">References</h3>
                <p>Ensure all citations in the text match the reference list. Use standard referencing styles (APA/Harvard). References should be up-to-date and accurately formatted to facilitate cross-linking.</p>
                
                <div class="mt-12 p-8 bg-emerald-900 rounded-2xl text-center not-prose relative overflow-hidden">
                    <div class="absolute inset-0 bg-pattern opacity-10"></div>
                    <div class="relative z-10">
                        <h4 class="text-white font-bold text-xl mb-2 font-['Outfit']">Ready to Submit?</h4>
                        <p class="text-emerald-200 mb-6 text-sm">Please review the Plagiarism Policy and Publication Ethics before submitting.</p>
                        <a href="ijari-submit.php" class="inline-flex items-center gap-2 bg-emerald-500 text-white px-8 py-3 rounded-xl hover:bg-emerald-400 font-semibold transition-colors shadow-lg">Go to Submission Portal <i class="fas fa-arrow-right text-sm"></i></a>
                    </div>
                </div>
            </div>
        </div>
        
<?php include "footer.php"; ?>