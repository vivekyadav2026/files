<?php
$articlesFile = 'data/articles.json';
$articles = [];
if (file_exists($articlesFile)) {
    $articles = json_decode(file_get_contents($articlesFile), true);
    if (!is_array($articles)) $articles = [];
}

// Filter for archived journal articles
$journalArticles = array_filter($articles, function($art) {
    return $art['type'] === 'journal' && isset($art['issue_status']) && $art['issue_status'] === 'archived';
});

// Group by volume, then issue
$groupedArchives = [];
foreach ($journalArticles as $art) {
    $vol = $art['volume'];
    $issue = $art['issue'];
    if (!isset($groupedArchives[$vol])) {
        $groupedArchives[$vol] = [];
    }
    if (!isset($groupedArchives[$vol][$issue])) {
        $groupedArchives[$vol][$issue] = [];
    }
    $groupedArchives[$vol][$issue][] = $art;
}

// Sort volumes descending
krsort($groupedArchives);
$availableVolumes = array_keys($groupedArchives);
$firstVol = !empty($availableVolumes) ? $availableVolumes[0] : '';

include "header.php";
?>

<!-- Banner Section -->
<div class="bg-[#eef8f4] py-14 border-b border-slate-100 text-center">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl md:text-5xl font-bold tracking-wider text-[#1B4332] font-['Outfit'] uppercase">Archives</h1>
    </div>
</div>

<div class="container mx-auto px-6 py-12 max-w-6xl">
    <?php if (empty($groupedArchives)): ?>
        <div class="py-20 bg-white rounded-3xl shadow-lg border border-slate-100 text-center flex flex-col items-center">
            <div class="w-20 h-20 bg-[#f7f9f4] rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-folder-open text-3xl text-slate-400"></i>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 mb-2 font-['Outfit']">No Archives Found</h2>
            <p class="text-slate-500 max-w-md">There are no archived issues available at the moment.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
            
            <!-- Left Sidebar: Volumes list buttons (Dynamic client-side filter) -->
            <div class="md:col-span-3 space-y-2">
                <?php foreach ($groupedArchives as $volNum => $issues): ?>
                    <button onclick="switchVolume('<?= htmlspecialchars($volNum) ?>')" 
                       data-vol-btn="<?= htmlspecialchars($volNum) ?>"
                       class="vol-btn block w-full text-center py-3.5 px-4 font-bold text-sm uppercase tracking-wider rounded transition-all duration-200 <?= $firstVol == $volNum ? 'bg-[#1B4332] text-white shadow-md' : 'bg-[#f0f2f5] text-slate-700 hover:bg-[#e4e7eb]' ?>">
                        Volume <?= htmlspecialchars($volNum) ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Right Content Area: Dynamic content panes -->
            <div class="md:col-span-9 space-y-10">
                <?php foreach ($groupedArchives as $volNum => $activeIssues): ?>
                    <div id="volume-pane-<?= htmlspecialchars($volNum) ?>" 
                         class="vol-pane space-y-10 <?= $firstVol == $volNum ? '' : 'hidden' ?>">
                        
                        <?php 
                        // Sort issues ascending
                        ksort($activeIssues);
                        ?>
                        <?php foreach ($activeIssues as $issueNum => $issueArticles): ?>
                            <div class="space-y-6">
                                <!-- Issue Title Banner -->
                                <div class="bg-[#1B4332] text-white px-6 py-3 font-bold text-sm uppercase tracking-wider rounded inline-block">
                                    Volume <?= htmlspecialchars($volNum) ?> – Issue <?= htmlspecialchars($issueNum) ?>
                                </div>

                                <!-- Articles List -->
                                <div class="space-y-8 pl-1">
                                    <?php foreach ($issueArticles as $art): ?>
                                        <div class="group">
                                            <!-- Title with Arrow -->
                                            <div class="flex items-start gap-2.5 mb-1.5">
                                                <span class="text-[#008080] text-lg mt-0.5 shrink-0">➔</span>
                                                <a href="<?= htmlspecialchars($art['pdf_path']) ?>" target="_blank" 
                                                   class="text-[#008080] hover:text-[#1B4332] hover:underline font-semibold text-lg leading-snug transition-colors">
                                                    <?= htmlspecialchars($art['title']) ?>
                                                </a>
                                            </div>

                                            <!-- Authors -->
                                            <p class="text-slate-800 font-bold text-sm mb-1 pl-7">
                                                <?= htmlspecialchars($art['authors']) ?>
                                            </p>

                                            <!-- DOI -->
                                            <?php if (!empty($art['doi'])): ?>
                                                <p class="text-xs pl-7 text-slate-500">
                                                    DOI: <a href="https://doi.org/<?= htmlspecialchars($art['doi']) ?>" target="_blank" 
                                                            class="text-[#e75480] hover:underline transition-colors font-medium">
                                                        https://doi.org/<?= htmlspecialchars($art['doi']) ?>
                                                    </a>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    <?php endif; ?>
</div>

<script>
function switchVolume(volNum) {
    // Hide all panes
    document.querySelectorAll('.vol-pane').forEach(pane => {
        pane.classList.add('hidden');
    });
    
    // Show selected pane
    const activePane = document.getElementById('volume-pane-' + volNum);
    if (activePane) {
        activePane.classList.remove('hidden');
    }
    
    // Reset all buttons style
    document.querySelectorAll('.vol-btn').forEach(btn => {
        btn.className = "vol-btn block w-full text-center py-3.5 px-4 font-bold text-sm uppercase tracking-wider rounded transition-all duration-200 bg-[#f0f2f5] text-slate-700 hover:bg-[#e4e7eb]";
    });
    
    // Set active style to current button
    const activeBtn = document.querySelector(`[data-vol-btn="${volNum}"]`);
    if (activeBtn) {
        activeBtn.className = "vol-btn block w-full text-center py-3.5 px-4 font-bold text-sm uppercase tracking-wider rounded transition-all duration-200 bg-[#1B4332] text-white shadow-md";
    }
}
</script>

<?php include "footer.php"; ?>