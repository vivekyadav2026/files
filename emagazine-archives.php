<?php
$articlesFile = 'data/articles.json';
$articles = [];
if (file_exists($articlesFile)) {
    $articles = json_decode(file_get_contents($articlesFile), true);
    if (!is_array($articles)) $articles = [];
}
$magArticles = array_filter($articles, function($art) {
    return $art['type'] === 'magazine' && isset($art['issue_status']) && $art['issue_status'] === 'archived';
});
usort($magArticles, function($a, $b) {
    return $b['published_at'] <=> $a['published_at'];
});

include "header.php";
?>
<div class="relative bg-emerald-50 text-emerald-950 py-12 md:py-16 overflow-hidden border-b border-emerald-100 text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="assets/light_banner_v2.png" alt="Magazine Archives" class="w-full h-full object-cover object-center opacity-40 ">
            <div class="absolute inset-0 bg-white/70"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-50 via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-600" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="index.php" class="hover:text-emerald-900 transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                    <li><span class="mx-1 text-slate-500">/</span></li>
                    <li aria-current="page" class="text-emerald-950 font-semibold">e-Magazine > Archives</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-emerald-900">e-Magazine Archives</h1>
            <p class="text-lg md:text-xl text-slate-600 max-w-3xl mx-auto font-light leading-relaxed">Browse past issues of Farm Science Today.</p>
        </div>
    </div>
    
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-4xl">
            <?php if (empty($magArticles)): ?>
                <div class="py-20 bg-white rounded-tr-[4rem] rounded-bl-[4rem] shadow-2xl border-t-8 border-[#D4E157] relative overflow-hidden flex flex-col items-center text-center">
                    <div class="w-24 h-24 bg-[#f7f9f4] rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-folder-open text-4xl text-slate-600"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-800 mb-3 font-['Outfit']">No Past Issues Found</h2>
                    <p class="text-slate-500 max-w-md text-lg">The archives will be populated once magazine issues are moved to past issues.</p>
                </div>
            <?php else: ?>
                <div class="space-y-8">
                    <?php foreach ($magArticles as $art): ?>
                        <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 flex justify-between items-center">
                            <div>
                                <span class="inline-flex px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full border border-emerald-100 mb-3">
                                    Vol. <?php echo htmlspecialchars($art['volume']); ?>, Issue <?php echo htmlspecialchars($art['issue']); ?> (<?php echo htmlspecialchars($art['year']); ?>)
                                </span>
                                <h3 class="text-2xl font-bold text-slate-900 mb-2 font-['Outfit']"><?php echo htmlspecialchars($art['title']); ?></h3>
                                <p class="text-slate-600 font-medium text-sm">By: <?php echo htmlspecialchars($art['authors']); ?></p>
                            </div>
                            <a href="<?php echo htmlspecialchars($art['pdf_path']); ?>" target="_blank" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-teal-600 text-white font-semibold px-5 py-3 rounded-xl transition-all shadow-md ml-4 shrink-0">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

<?php include "footer.php"; ?>