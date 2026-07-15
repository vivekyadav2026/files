<?php
require_once 'config.php';
check_auth();

$eventsFile = __DIR__ . '/../data/events.json';
$uploadDir  = __DIR__ . '/../uploads/events/';
$msg = ''; $error = '';

if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);
$events = file_exists($eventsFile) ? (json_decode(file_get_contents($eventsFile), true) ?? []) : [];

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $title       = trim($_POST['title'] ?? '');
        $date        = trim($_POST['date'] ?? '');
        $time        = trim($_POST['time'] ?? '');
        $location    = trim($_POST['location'] ?? '');
        $type        = trim($_POST['type'] ?? 'Event');
        $description = trim($_POST['description'] ?? '');
        $link        = trim($_POST['link'] ?? '');

        if (empty($title) || empty($date)) {
            $error = 'Title and Date are required.';
        } else {
            $imageName = '';
            if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
                    $imageName = uniqid('ev_', true) . '.' . $ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
                }
            }
            $events[] = [
                'id'          => uniqid('ev_', true),
                'title'       => $title,
                'date'        => $date,
                'time'        => $time,
                'location'    => $location,
                'type'        => $type,
                'description' => $description,
                'link'        => $link,
                'image'       => $imageName,
                'added_at'    => time()
            ];
            file_put_contents($eventsFile, json_encode(array_values($events), JSON_PRETTY_PRINT));
            $msg = 'Event added successfully!';
            $events = json_decode(file_get_contents($eventsFile), true) ?? [];
        }
    }

    if ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        foreach ($events as $k => $ev) {
            if ($ev['id'] === $id) {
                if (!empty($ev['image']) && file_exists($uploadDir . $ev['image'])) unlink($uploadDir . $ev['image']);
                unset($events[$k]);
                break;
            }
        }
        file_put_contents($eventsFile, json_encode(array_values($events), JSON_PRETTY_PRINT));
        $msg = 'Event deleted.';
        $events = json_decode(file_get_contents($eventsFile), true) ?? [];
    }
}

usort($events, fn($a,$b) => strtotime($b['date'] ?? 0) - strtotime($a['date'] ?? 0));
$eventTypes = ['Conference', 'Workshop', 'Seminar', 'Webinar', 'Field Visit', 'Award Ceremony', 'Training', 'Other'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Events Manager — IJARI Admin</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-[#f7f9f4] min-h-screen font-sans">

<!-- Top Nav -->
<nav class="bg-[#1B4332] text-white px-6 py-4 flex items-center justify-between shadow-lg">
    <div class="flex items-center gap-4">
        <a href="dashboard.php" class="text-emerald-300 hover:text-white transition-colors text-sm font-semibold">
            <i class="fas fa-arrow-left mr-2"></i>Dashboard
        </a>
        <span class="text-slate-500">|</span>
        <span class="font-bold text-lg font-['Outfit']"><i class="fas fa-calendar-alt mr-2 text-emerald-400"></i>Events Manager</span>
    </div>
    <a href="gallery-admin.php" class="text-sm text-emerald-300 hover:text-white transition-colors font-semibold">
        <i class="fas fa-images mr-1"></i>Gallery Manager
    </a>
</nav>

<div class="max-w-7xl mx-auto px-6 py-10">

    <?php if ($msg): ?>
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl mb-6 flex items-center gap-3">
        <i class="fas fa-check-circle text-emerald-500"></i> <?= htmlspecialchars($msg) ?>
    </div>
    <?php endif; ?>
    <?php if ($error): ?>
    <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl mb-6 flex items-center gap-3">
        <i class="fas fa-exclamation-circle text-red-500"></i> <?= htmlspecialchars($error) ?>
    </div>
    <?php endif; ?>

    <div class="grid lg:grid-cols-5 gap-8">

        <!-- Add Event Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-7 sticky top-6">
                <h2 class="text-xl font-bold text-slate-800 mb-6 font-['Outfit'] flex items-center gap-2">
                    <i class="fas fa-plus-circle text-emerald-500"></i> Add New Event
                </h2>
                <form method="POST" enctype="multipart/form-data" class="space-y-4">
                    <input type="hidden" name="action" value="add">

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Event Title *</label>
                        <input type="text" name="title" required placeholder="e.g. National Conference on Agriculture"
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none text-sm transition-all">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Date *</label>
                            <input type="date" name="date" required
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none text-sm transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Time</label>
                            <input type="time" name="time"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none text-sm transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Event Type</label>
                        <select name="type" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none text-sm transition-all">
                            <?php foreach ($eventTypes as $t): ?>
                            <option><?= htmlspecialchars($t) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Location / Venue</label>
                        <input type="text" name="location" placeholder="e.g. RPCAU, Pusa, Samastipur"
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none text-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Description</label>
                        <textarea name="description" rows="3" placeholder="Brief description of the event..."
                                  class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none text-sm transition-all resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Registration Link (optional)</label>
                        <input type="url" name="link" placeholder="https://..."
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none text-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Event Image (optional)</label>
                        <div class="border-2 border-dashed border-slate-200 rounded-xl p-4 text-center hover:border-emerald-400 transition-colors cursor-pointer relative bg-slate-50">
                            <input type="file" name="image" accept="image/*"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <i class="fas fa-image text-2xl text-slate-400 mb-1"></i>
                            <p class="text-xs text-slate-500">Upload banner image</p>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition-colors shadow-md flex items-center justify-center gap-2">
                        <i class="fas fa-plus"></i> Add Event
                    </button>
                </form>
            </div>
        </div>

        <!-- Events List -->
        <div class="lg:col-span-3">
            <h2 class="text-xl font-bold text-slate-800 mb-6 font-['Outfit']">
                All Events <span class="text-sm text-slate-400 font-normal">(<?= count($events) ?> total)</span>
            </h2>

            <?php if (empty($events)): ?>
            <div class="bg-white rounded-3xl border border-slate-100 p-16 text-center">
                <i class="fas fa-calendar-times text-4xl text-slate-300 mb-4"></i>
                <p class="text-slate-500">No events yet. Add your first event!</p>
            </div>
            <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($events as $ev):
                    $isPast = strtotime($ev['date'] ?? 0) < time();
                ?>
                <div class="bg-white rounded-2xl border <?= $isPast ? 'border-slate-200' : 'border-emerald-200' ?> shadow-sm hover:shadow-md transition-all p-5 flex gap-5 items-start">
                    <?php if (!empty($ev['image']) && file_exists($uploadDir . $ev['image'])): ?>
                    <div class="w-20 h-20 rounded-xl overflow-hidden shrink-0">
                        <img src="../uploads/events/<?= htmlspecialchars($ev['image']) ?>" class="w-full h-full object-cover">
                    </div>
                    <?php else: ?>
                    <div class="w-20 h-20 rounded-xl shrink-0 <?= $isPast ? 'bg-slate-100' : 'bg-emerald-50' ?> flex flex-col items-center justify-center">
                        <span class="text-2xl font-bold <?= $isPast ? 'text-slate-500' : 'text-emerald-700' ?>"><?= date('d', strtotime($ev['date'])) ?></span>
                        <span class="text-xs font-bold <?= $isPast ? 'text-slate-400' : 'text-emerald-500' ?> uppercase"><?= date('M', strtotime($ev['date'])) ?></span>
                        <span class="text-[10px] text-slate-400"><?= date('Y', strtotime($ev['date'])) ?></span>
                    </div>
                    <?php endif; ?>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <span class="inline-block text-xs font-bold px-2 py-0.5 rounded-full mb-1 <?= $isPast ? 'bg-slate-100 text-slate-500' : 'bg-emerald-100 text-emerald-700' ?>">
                                    <?= htmlspecialchars($ev['type'] ?? 'Event') ?>
                                    <?= $isPast ? ' · Past' : ' · Upcoming' ?>
                                </span>
                                <h3 class="font-bold text-slate-900 text-base font-['Outfit'] leading-tight"><?= htmlspecialchars($ev['title']) ?></h3>
                            </div>
                            <form method="POST" onsubmit="return confirm('Delete this event?')" class="shrink-0">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($ev['id']) ?>">
                                <button type="submit" class="w-8 h-8 bg-red-50 hover:bg-red-500 hover:text-white text-red-400 rounded-lg text-xs flex items-center justify-center transition-colors border border-red-100">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        <div class="flex flex-wrap gap-3 text-xs text-slate-500 mt-2 font-semibold">
                            <span><i class="fas fa-calendar text-emerald-400 mr-1"></i><?= date('d M Y', strtotime($ev['date'])) ?></span>
                            <?php if (!empty($ev['time'])): ?>
                            <span><i class="fas fa-clock text-emerald-400 mr-1"></i><?= htmlspecialchars($ev['time']) ?></span>
                            <?php endif; ?>
                            <?php if (!empty($ev['location'])): ?>
                            <span><i class="fas fa-map-marker-alt text-emerald-400 mr-1"></i><?= htmlspecialchars($ev['location']) ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($ev['description'])): ?>
                        <p class="text-xs text-slate-400 mt-1 line-clamp-2"><?= htmlspecialchars($ev['description']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
