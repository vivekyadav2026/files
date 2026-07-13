<?php
$articlesFile = 'data/articles.json';
$articles = [];
if (file_exists($articlesFile)) {
    $articles = json_decode(file_get_contents($articlesFile), true);
    if (!is_array($articles)) $articles = [];
}
$magazineArticles = array_filter($articles, function($art) {
    return $art['type'] === 'magazine';
});
usort($magazineArticles, function($a, $b) {
    return $b['published_at'] <=> $a['published_at'];
});
?><?php include 'header.php'; ?>

        
    <div class="relative bg-emerald-900 text-white py-12 md:py-16 overflow-hidden border-b border-emerald-800 text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="assets/banner_slide_2.png" alt="Magazine Archives" class="w-full h-full object-cover object-center opacity-25 scale-105 filter blur-[1px]">
            <div class="absolute inset-0 bg-emerald-900/85"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900 via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="index.php" class="hover:text-white transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                    <li><span class="mx-1 text-slate-500">/</span></li>
                    <li aria-current="page" class="text-white">e-Magazine > Archives</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-white drop-shadow-md">Magazine Archives</h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto font-light leading-relaxed drop-shadow">Browse past issues of Farm Science Today.</p>
        </div>
    </div>
    
        
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-4xl">
            <?php if (empty($magazineArticles)): ?>
                <div class="py-20 bg-white rounded-tr-[4rem] rounded-bl-[4rem] shadow-2xl border-t-8 border-[#D4E157] relative overflow-hidden text-center flex flex-col items-center">
                    <div class="w-24 h-24 bg-[#f7f9f4] rounded-2xl rotate-3 flex items-center justify-center mb-6 border border-slate-200">
                        <i class="fas fa-box-open text-4xl text-slate-400"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-800 mb-3 font-['Outfit']">Archive Empty</h2>
                    <p class="text-slate-500 max-w-md text-lg">Published articles and monthly PDF issues will be cataloged here.</p>
                </div>
            <?php else: ?>
                <div class="grid md:grid-cols-2 gap-6 text-left">
                    <?php foreach ($magazineArticles as $art): ?>
                        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition-shadow">
                            <div>
                                <span class="inline-flex px-3 py-1 bg-teal-50 text-teal-700 text-xs font-semibold rounded-full border border-teal-100 mb-4">
                                    Issue <?php echo htmlspecialchars($art['issue']); ?> (<?php echo htmlspecialchars($art['year']); ?>)
                                </span>
                                <h3 class="text-xl font-bold text-slate-900 mb-2 font-['Outfit'] line-clamp-2"><?php echo htmlspecialchars($art['title']); ?></h3>
                                <p class="text-slate-500 font-medium text-xs mb-4">By: <?php echo htmlspecialchars($art['authors']); ?></p>
                                <p class="text-sm text-slate-600 line-clamp-3 mb-6"><?php echo htmlspecialchars($art['abstract']); ?></p>
                            </div>
                            <div class="flex justify-between items-center border-t border-slate-50 pt-4 mt-auto">
                                <span class="text-xs text-slate-400"><?php echo date('M Y', $art['published_at']); ?></span>
                                <a href="<?php echo htmlspecialchars($art['pdf_path']); ?>" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-teal-600 hover:text-teal-800 font-bold bg-teal-50 px-3 py-2 rounded-lg border border-teal-100 hover:bg-teal-100 transition-all">
                                    <i class="fas fa-file-pdf"></i> Read Article
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        
<?php include 'footer.php'; ?>