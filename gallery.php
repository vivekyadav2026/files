<?php
$galleryFile = __DIR__ . '/data/gallery.json';
$items = [];
if (file_exists($galleryFile)) {
    $items = json_decode(file_get_contents($galleryFile), true);
    if (!is_array($items)) $items = [];
}
// Group by category
$categories = ['All'];
foreach ($items as $item) {
    if (!empty($item['category']) && !in_array($item['category'], $categories)) {
        $categories[] = $item['category'];
    }
}
include "header.php";
?>

<div class="relative bg-emerald-50 text-emerald-950 py-12 md:py-16 overflow-hidden border-b border-emerald-100 text-center">
    <div class="absolute inset-0 z-0 pointer-events-none">
        <img src="assets/light_banner_v2.png" alt="Gallery" class="w-full h-full object-cover object-center opacity-40">
        <div class="absolute inset-0 bg-white/70"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-emerald-50 via-transparent to-transparent"></div>
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-600" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li><a href="index.php" class="hover:text-emerald-900 transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                <li><span class="mx-1 text-slate-500">/</span></li>
                <li aria-current="page" class="text-emerald-950 font-semibold">Gallery</li>
            </ol>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-emerald-900">Photo Gallery</h1>
        <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto font-light leading-relaxed">Moments, milestones, and memories from IJARI events and activities.</p>
    </div>
</div>

<div class="container mx-auto px-6 py-12 max-w-7xl">
    <?php if (count($categories) > 1): ?>
    <!-- Category Filter -->
    <div class="flex flex-wrap gap-3 justify-center mb-12" id="gallery-filters">
        <?php foreach ($categories as $i => $cat): ?>
        <button onclick="filterGallery('<?= htmlspecialchars($cat) ?>')"
            class="filter-btn px-5 py-2 rounded-full font-semibold text-sm border-2 transition-all <?= $i === 0 ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white text-slate-600 border-slate-200 hover:border-emerald-400 hover:text-emerald-700' ?>"
            data-cat="<?= htmlspecialchars($cat) ?>">
            <?= htmlspecialchars($cat) ?>
        </button>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if (empty($items)): ?>
    <div class="text-center py-24">
        <div class="w-20 h-20 mx-auto bg-slate-100 rounded-full flex items-center justify-center mb-6">
            <i class="fas fa-images text-3xl text-slate-400"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-700 mb-2 font-['Outfit']">No Photos Yet</h3>
        <p class="text-slate-500">Check back soon for gallery updates.</p>
    </div>
    <?php else: ?>
    <!-- Gallery Grid -->
    <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4" id="gallery-grid">
        <?php foreach ($items as $item): ?>
        <div class="gallery-item break-inside-avoid group cursor-pointer"
             data-cat="<?= htmlspecialchars($item['category'] ?? 'General') ?>"
             onclick="openLightbox('<?= htmlspecialchars('uploads/gallery/' . $item['filename']) ?>','<?= htmlspecialchars($item['caption'] ?? '') ?>')">
            <div class="relative overflow-hidden rounded-2xl shadow-md hover:shadow-xl transition-all duration-300">
                <img src="uploads/gallery/<?= htmlspecialchars($item['filename']) ?>"
                     alt="<?= htmlspecialchars($item['caption'] ?? 'Gallery Image') ?>"
                     class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                    <div>
                        <?php if (!empty($item['caption'])): ?>
                        <p class="text-white text-sm font-semibold leading-tight"><?= htmlspecialchars($item['caption']) ?></p>
                        <?php endif; ?>
                        <?php if (!empty($item['category'])): ?>
                        <span class="text-emerald-300 text-xs font-bold uppercase tracking-wider"><?= htmlspecialchars($item['category']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="absolute top-3 right-3 w-8 h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <i class="fas fa-expand text-white text-xs"></i>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<!-- Lightbox -->
<div id="lightbox" class="fixed inset-0 z-[9999] bg-black/90 hidden items-center justify-center p-4" onclick="closeLightbox()">
    <button class="absolute top-6 right-6 text-white text-3xl hover:text-emerald-400 transition-colors z-10" onclick="closeLightbox()">
        <i class="fas fa-times"></i>
    </button>
    <div class="relative max-w-5xl max-h-[90vh] w-full" onclick="event.stopPropagation()">
        <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[80vh] mx-auto rounded-2xl shadow-2xl object-contain">
        <p id="lightbox-caption" class="text-white text-center mt-4 text-lg font-semibold"></p>
    </div>
</div>

<script>
function filterGallery(cat) {
    document.querySelectorAll('.filter-btn').forEach(btn => {
        if (btn.dataset.cat === cat) {
            btn.className = btn.className.replace('bg-white text-slate-600 border-slate-200 hover:border-emerald-400 hover:text-emerald-700', 'bg-emerald-600 text-white border-emerald-600');
        } else {
            btn.className = btn.className.replace('bg-emerald-600 text-white border-emerald-600', 'bg-white text-slate-600 border-slate-200 hover:border-emerald-400 hover:text-emerald-700');
        }
    });
    document.querySelectorAll('.gallery-item').forEach(item => {
        if (cat === 'All' || item.dataset.cat === cat) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}

function openLightbox(src, caption) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-caption').textContent = caption;
    const lb = document.getElementById('lightbox');
    lb.classList.remove('hidden');
    lb.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lb = document.getElementById('lightbox');
    lb.classList.add('hidden');
    lb.classList.remove('flex');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>

<?php include "footer.php"; ?>
