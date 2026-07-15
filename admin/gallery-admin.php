<?php
require_once 'config.php';
check_auth();

$galleryFile = __DIR__ . '/../data/gallery.json';
$uploadDir   = __DIR__ . '/../uploads/gallery/';
$msg = ''; $error = '';

if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);
$items = file_exists($galleryFile) ? (json_decode(file_get_contents($galleryFile), true) ?? []) : [];

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // Upload new images
    if ($action === 'upload') {
        $caption  = trim($_POST['caption'] ?? '');
        $category = trim($_POST['category'] ?? 'General');
        $files = $_FILES['images'] ?? [];
        $uploaded = 0;

        if (!empty($files['name'][0])) {
            foreach ($files['name'] as $i => $name) {
                if ($files['error'][$i] !== UPLOAD_ERR_OK) continue;
                $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                if (!in_array($ext, ['jpg','jpeg','png','gif','webp'])) continue;
                $newName = uniqid('gal_', true) . '.' . $ext;
                if (move_uploaded_file($files['tmp_name'][$i], $uploadDir . $newName)) {
                    $items[] = [
                        'id'       => uniqid('g_', true),
                        'filename' => $newName,
                        'caption'  => $caption,
                        'category' => $category,
                        'added_at' => time()
                    ];
                    $uploaded++;
                }
            }
        }
        if ($uploaded > 0) {
            file_put_contents($galleryFile, json_encode(array_values($items), JSON_PRETTY_PRINT));
            $msg = "$uploaded image(s) uploaded successfully.";
            $items = json_decode(file_get_contents($galleryFile), true) ?? [];
        } else {
            $error = 'No valid images uploaded.';
        }
    }

    // Delete image
    if ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        foreach ($items as $k => $item) {
            if ($item['id'] === $id) {
                $f = $uploadDir . $item['filename'];
                if (file_exists($f)) unlink($f);
                unset($items[$k]);
                break;
            }
        }
        file_put_contents($galleryFile, json_encode(array_values($items), JSON_PRETTY_PRINT));
        $msg = 'Image deleted.';
        $items = json_decode(file_get_contents($galleryFile), true) ?? [];
    }
}

$categories = ['General', 'Conference', 'Workshop', 'Field Visit', 'Award Ceremony', 'Seminar', 'Other'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gallery Manager — IJARI Admin</title>
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
        <span class="font-bold text-lg font-['Outfit']"><i class="fas fa-images mr-2 text-emerald-400"></i>Gallery Manager</span>
    </div>
    <a href="events-admin.php" class="text-sm text-emerald-300 hover:text-white transition-colors font-semibold">
        <i class="fas fa-calendar-alt mr-1"></i>Events Manager
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

    <div class="grid lg:grid-cols-3 gap-8">

        <!-- Upload Panel -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-7 sticky top-6">
                <h2 class="text-xl font-bold text-slate-800 mb-6 font-['Outfit'] flex items-center gap-2">
                    <i class="fas fa-upload text-emerald-500"></i> Upload Images
                </h2>
                <form method="POST" enctype="multipart/form-data" class="space-y-5">
                    <input type="hidden" name="action" value="upload">

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Select Images *</label>
                        <div class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center hover:border-emerald-400 hover:bg-emerald-50/30 transition-colors cursor-pointer relative bg-slate-50">
                            <input type="file" name="images[]" multiple accept="image/*" required
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-3xl text-slate-400 mb-2"></i>
                            <p class="text-sm text-slate-500 font-medium">Click or drag images here</p>
                            <p class="text-xs text-slate-400 mt-1">JPG, PNG, WEBP — Multiple allowed</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Caption</label>
                        <input type="text" name="caption" placeholder="e.g. Annual Conference 2025"
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none text-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Category</label>
                        <select name="category" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none text-sm transition-all">
                            <?php foreach ($categories as $cat): ?>
                            <option><?= htmlspecialchars($cat) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition-colors shadow-md flex items-center justify-center gap-2">
                        <i class="fas fa-upload"></i> Upload
                    </button>
                </form>

                <div class="mt-6 pt-5 border-t border-slate-100 text-center text-sm text-slate-500">
                    <strong class="text-slate-800 text-lg"><?= count($items) ?></strong> photos in gallery
                </div>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="lg:col-span-2">
            <h2 class="text-xl font-bold text-slate-800 mb-6 font-['Outfit']">
                All Photos <span class="text-sm text-slate-400 font-normal">(<?= count($items) ?> total)</span>
            </h2>

            <?php if (empty($items)): ?>
            <div class="bg-white rounded-3xl border border-slate-100 p-16 text-center">
                <i class="fas fa-images text-4xl text-slate-300 mb-4"></i>
                <p class="text-slate-500">No images yet. Upload your first photo!</p>
            </div>
            <?php else: ?>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <?php foreach (array_reverse($items) as $item): ?>
                <div class="group relative bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-md transition-all">
                    <div class="aspect-square overflow-hidden">
                        <img src="../uploads/gallery/<?= htmlspecialchars($item['filename']) ?>"
                             alt="<?= htmlspecialchars($item['caption'] ?? '') ?>"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-3">
                        <p class="text-xs font-semibold text-slate-700 truncate"><?= htmlspecialchars($item['caption'] ?? '—') ?></p>
                        <span class="text-[10px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded-full">
                            <?= htmlspecialchars($item['category'] ?? 'General') ?>
                        </span>
                    </div>
                    <!-- Delete Button -->
                    <form method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity"
                          onsubmit="return confirm('Delete this image?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                        <button type="submit" class="w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs flex items-center justify-center shadow-md transition-colors">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
