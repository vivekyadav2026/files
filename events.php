<?php
$eventsFile = __DIR__ . '/data/events.json';
$events = [];
if (file_exists($eventsFile)) {
    $events = json_decode(file_get_contents($eventsFile), true);
    if (!is_array($events)) $events = [];
}

// Sort by date desc
usort($events, fn($a,$b) => strtotime($b['date'] ?? 0) - strtotime($a['date'] ?? 0));

$now = time();
$upcoming = array_filter($events, fn($e) => strtotime($e['date'] ?? 0) >= $now);
$past     = array_filter($events, fn($e) => strtotime($e['date'] ?? 0) < $now);
$upcoming = array_values($upcoming);
$past     = array_values($past);

include "header.php";
?>

<div class="relative bg-emerald-50 text-emerald-950 py-12 md:py-16 overflow-hidden border-b border-emerald-100 text-center">
    <div class="absolute inset-0 z-0 pointer-events-none">
        <img src="assets/light_banner_v2.png" alt="Events" class="w-full h-full object-cover object-center opacity-40">
        <div class="absolute inset-0 bg-white/70"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-emerald-50 via-transparent to-transparent"></div>
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-600" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li><a href="index.php" class="hover:text-emerald-900 transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                <li><span class="mx-1 text-slate-500">/</span></li>
                <li aria-current="page" class="text-emerald-950 font-semibold">Events</li>
            </ol>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-emerald-900">Events & Activities</h1>
        <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto font-light leading-relaxed">Conferences, workshops, and seminars organized by IJARI Research Foundation.</p>
    </div>
</div>

<div class="container mx-auto px-6 py-12 max-w-6xl">

    <?php if (empty($events)): ?>
    <div class="text-center py-24">
        <div class="w-20 h-20 mx-auto bg-slate-100 rounded-full flex items-center justify-center mb-6">
            <i class="fas fa-calendar-times text-3xl text-slate-400"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-700 mb-2 font-['Outfit']">No Events Yet</h3>
        <p class="text-slate-500">Check back soon for upcoming events.</p>
    </div>
    <?php else: ?>

    <?php if (!empty($upcoming)): ?>
    <!-- Upcoming Events -->
    <div class="mb-16">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></div>
            <h2 class="text-2xl font-bold text-slate-800 font-['Outfit']">Upcoming Events</h2>
        </div>
        <div class="grid md:grid-cols-2 gap-6">
            <?php foreach ($upcoming as $ev): 
                $dt = strtotime($ev['date']);
                $d  = date('d', $dt); $m = date('M', $dt); $y = date('Y', $dt);
            ?>
            <div class="bg-white rounded-3xl shadow-lg border border-emerald-100 overflow-hidden hover:shadow-xl transition-all duration-300 group flex flex-col">
                <?php if (!empty($ev['image'])): ?>
                <div class="h-52 overflow-hidden">
                    <img src="uploads/events/<?= htmlspecialchars($ev['image']) ?>" alt="<?= htmlspecialchars($ev['title']) ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <?php else: ?>
                <div class="h-28 bg-gradient-to-r from-emerald-600 to-teal-600 flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-4xl text-white/40"></i>
                </div>
                <?php endif; ?>
                <div class="p-6 flex flex-col flex-1">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="shrink-0 text-center bg-emerald-50 border border-emerald-200 rounded-2xl px-4 py-2">
                            <div class="text-2xl font-bold text-emerald-700 font-['Outfit']"><?= $d ?></div>
                            <div class="text-xs font-bold text-emerald-500 uppercase tracking-wider"><?= $m ?></div>
                            <div class="text-xs text-slate-500"><?= $y ?></div>
                        </div>
                        <div>
                            <span class="inline-block bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full mb-2">
                                <?= htmlspecialchars($ev['type'] ?? 'Event') ?>
                            </span>
                            <h3 class="text-lg font-bold text-slate-900 font-['Outfit'] leading-tight"><?= htmlspecialchars($ev['title']) ?></h3>
                        </div>
                    </div>
                    <?php if (!empty($ev['description'])): ?>
                    <p class="text-slate-600 text-sm leading-relaxed mb-4 flex-1"><?= nl2br(htmlspecialchars($ev['description'])) ?></p>
                    <?php endif; ?>
                    <div class="mt-auto pt-3 border-t border-slate-100 flex flex-wrap gap-3 text-xs text-slate-500 font-semibold">
                        <?php if (!empty($ev['location'])): ?>
                        <span><i class="fas fa-map-marker-alt text-emerald-500 mr-1"></i><?= htmlspecialchars($ev['location']) ?></span>
                        <?php endif; ?>
                        <?php if (!empty($ev['time'])): ?>
                        <span><i class="fas fa-clock text-emerald-500 mr-1"></i><?= htmlspecialchars($ev['time']) ?></span>
                        <?php endif; ?>
                        <?php if (!empty($ev['link'])): ?>
                        <a href="<?= htmlspecialchars($ev['link']) ?>" target="_blank" class="ml-auto text-emerald-600 hover:text-emerald-800 transition-colors">
                            Register / More Info <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($past)): ?>
    <!-- Past Events -->
    <div>
        <div class="flex items-center gap-4 mb-8">
            <div class="w-3 h-3 rounded-full bg-slate-400"></div>
            <h2 class="text-2xl font-bold text-slate-700 font-['Outfit']">Past Events</h2>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php foreach ($past as $ev):
                $dt = strtotime($ev['date']);
                $d  = date('d', $dt); $m = date('M', $dt); $y = date('Y', $dt);
            ?>
            <div class="bg-slate-50 rounded-2xl border border-slate-200 p-5 hover:bg-white hover:shadow-md transition-all duration-300 flex gap-4">
                <div class="shrink-0 text-center bg-white border border-slate-200 rounded-xl px-3 py-2 shadow-sm">
                    <div class="text-xl font-bold text-slate-600 font-['Outfit']"><?= $d ?></div>
                    <div class="text-xs font-bold text-slate-400 uppercase"><?= $m ?></div>
                    <div class="text-xs text-slate-400"><?= $y ?></div>
                </div>
                <div>
                    <span class="inline-block bg-slate-200 text-slate-600 text-xs font-bold px-2 py-0.5 rounded-full mb-1">
                        <?= htmlspecialchars($ev['type'] ?? 'Event') ?>
                    </span>
                    <h3 class="text-sm font-bold text-slate-800 font-['Outfit'] leading-tight mb-1"><?= htmlspecialchars($ev['title']) ?></h3>
                    <?php if (!empty($ev['location'])): ?>
                    <p class="text-xs text-slate-500"><i class="fas fa-map-marker-alt mr-1"></i><?= htmlspecialchars($ev['location']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>
</div>

<?php include "footer.php"; ?>
