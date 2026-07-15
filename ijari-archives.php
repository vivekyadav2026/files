<?php
$articlesFile = 'data/articles.json';
$articles = [];
if (file_exists($articlesFile)) {
    $articles = json_decode(file_get_contents($articlesFile), true);
    if (!is_array($articles)) $articles = [];
}
$journalArticles = array_filter($articles, function($art) {
    return $art['type'] === 'journal' && isset($art['issue_status']) && $art['issue_status'] === 'archived';
});
usort($journalArticles, function($a, $b) {
    return $b['published_at'] <=> $a['published_at'];
});

// Group by volume and issue
$groupedArchives = [];
foreach ($journalArticles as $art) {
    $key = "Vol. " . $art['volume'] . ", Issue " . $art['issue'] . " (" . $art['year'] . ")";
    if (!isset($groupedArchives[$key])) {
        $groupedArchives[$key] = [];
    }
    $groupedArchives[$key][] = $art;
}

include "header.php";
?>
<div class="relative bg-emerald-50 text-emerald-950 py-12 md:py-16 overflow-hidden border-b border-emerald-100 text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="assets/light_banner_v2.png" alt="Archives" class="w-full h-full object-cover object-center opacity-40 ">
            <div class="absolute inset-0 bg-white/70"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-50 via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-600" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="index.php" class="hover:text-emerald-900 transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                    <li><span class="mx-1 text-slate-500">/</span></li>
                    <li aria-current="page" class="text-emerald-950 font-semibold">IJARI > Archives</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-emerald-900">Archives</h1>
            <p class="text-lg md:text-xl text-slate-600 max-w-3xl mx-auto font-light leading-relaxed">Browse past issues of the International Journal of Agricultural Research and Innovation.</p>
        </div>
    </div>
    
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-5xl">
            <?php if (empty($groupedArchives)): ?>
                <div class="py-20 bg-white rounded-tr-[4rem] rounded-bl-[4rem] shadow-2xl border-t-8 border-[#D4E157] relative overflow-hidden flex flex-col items-center text-center">
                    <div class="w-24 h-24 bg-[#f7f9f4] rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-folder-open text-4xl text-slate-600"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-800 mb-3 font-['Outfit']">No Past Issues Found</h2>
                    <p class="text-slate-500 max-w-md text-lg">The archives will be populated once current issues are moved to past issues.</p>
                </div>
            <?php else: ?>
                <div class="space-y-12">
                    <?php foreach ($groupedArchives as $issueName => $articlesGroup): ?>
                        <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                            <h2 class="text-2xl font-bold text-slate-900 mb-6 font-['Outfit'] border-b border-slate-100 pb-4">
                                <i class="fas fa-book text-emerald-500 mr-2"></i> <?php echo htmlspecialchars($issueName); ?>
                            </h2>
                            <div class="space-y-6">
                                <?php foreach ($articlesGroup as $art): ?>
                                    <div class="bg-[#f7f9f4]/50 p-6 rounded-2xl border border-slate-100 hover:shadow-md transition-shadow">
                                        <h3 class="text-xl font-bold text-slate-900 mb-2 font-['Outfit']"><?php echo htmlspecialchars($art['title']); ?></h3>
                                        <p class="text-slate-600 font-medium text-sm mb-3">By: <?php echo htmlspecialchars($art['authors']); ?></p>
                                        <?php if (!empty($art['doi'])): ?>
                                            <p class="text-xs text-slate-400 mb-4">DOI: <a href="https://doi.org/<?php echo htmlspecialchars($art['doi']); ?>" target="_blank" class="hover:underline text-emerald-600"><?php echo htmlspecialchars($art['doi']); ?></a></p>
                                        <?php endif; ?>
                                        <div class="flex justify-between items-center mt-4">
                                            <a href="<?php echo htmlspecialchars($art['pdf_path']); ?>" target="_blank" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-emerald-600 text-white font-semibold px-4 py-2 rounded-xl transition-all shadow-sm text-sm">
                                                <i class="fas fa-file-pdf"></i> Download PDF
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

<?php include "footer.php"; ?>