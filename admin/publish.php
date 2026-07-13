<?php
require_once 'config.php';
check_auth();

$submissionsFile = '../data/submissions.json';
$articlesFile = '../data/articles.json';

function read_json($file) {
    if (!file_exists($file)) return [];
    $data = json_decode(file_get_contents($file), true);
    return is_array($data) ? $data : [];
}

function write_json($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

$id = $_GET['id'] ?? '';
$submissions = read_json($submissionsFile);
$submission = null;

foreach ($submissions as $sub) {
    if ($sub['id'] === $id && $sub['status'] === 'pending') {
        $submission = $sub;
        break;
    }
}

if (!$submission) {
    header('Location: dashboard.php?msg=Invalid or already published submission');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $authors = trim($_POST['authors'] ?? '');
    $abstract = trim($_POST['abstract'] ?? '');
    $volume = trim($_POST['volume'] ?? '');
    $issue = trim($_POST['issue'] ?? '');
    $year = trim($_POST['year'] ?? '');
    $doi = trim($_POST['doi'] ?? '');

    // PDF Upload handling
    if (!isset($_FILES['pdf_file']) || $_FILES['pdf_file']['error'] !== UPLOAD_ERR_OK) {
        $error = 'Please upload a valid PDF file.';
    } else {
        $pdfFile = $_FILES['pdf_file'];
        $ext = strtolower(pathinfo($pdfFile['name'], PATHINFO_EXTENSION));

        if ($ext !== 'pdf') {
            $error = 'Only PDF files are allowed for publication.';
        } else {
            // Ensure uploads/articles directory exists
            $uploadDir = '../uploads/articles/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $destName = uniqid('article_', true) . '.pdf';
            $destPath = $uploadDir . $destName;

            if (move_uploaded_file($pdfFile['tmp_name'], $destPath)) {
                // Save to articles.json
                $articles = read_json($articlesFile);
                $articles[] = [
                    'id' => uniqid('art_', true),
                    'submission_id' => $submission['id'],
                    'type' => $submission['type'],
                    'title' => $title,
                    'authors' => $authors,
                    'email' => $submission['email'],
                    'abstract' => $abstract,
                    'volume' => $volume,
                    'issue' => $issue,
                    'year' => $year,
                    'doi' => $doi,
                    'pdf_path' => 'uploads/articles/' . $destName,
                    'issue_status' => 'current',
                    'published_at' => time()
                ];
                write_json($articlesFile, $articles);

                // Update submission status to published
                foreach ($submissions as &$sub) {
                    if ($sub['id'] === $submission['id']) {
                        $sub['status'] = 'published';
                        break;
                    }
                }
                write_json($submissionsFile, $submissions);

                header('Location: dashboard.php?msg=Article published successfully');
                exit;
            } else {
                $error = 'Failed to move uploaded PDF file.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publish Article | IJARI Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Inter:wght@400;500;600&display=swap');
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, button, .font-title { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen overflow-hidden">

    <div class="flex h-screen overflow-hidden bg-slate-50 relative">
        <!-- Sidebar Overlay Backdrop for Mobile -->
        <div id="sidebar-backdrop" onclick="toggleSidebar()" class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-sm hidden md:hidden transition-all duration-300"></div>

        <!-- Sidebar -->
        <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-slate-300 flex flex-col justify-between shrink-0 font-['Outfit'] border-r border-slate-800 transform -translate-x-full transition-transform duration-300 ease-in-out md:relative md:translate-x-0 md:flex">
            <div>
                <!-- Header Logo -->
                <div class="p-6 border-b border-slate-800 flex items-center gap-3 relative">
                    <div class="bg-emerald-500 p-2.5 rounded-xl text-white shadow-md shadow-emerald-500/20">
                        <i class="fas fa-user-shield text-lg"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-white text-base leading-tight">IJARI Admin</h1>
                        <p class="text-xs text-slate-500">Publication Control Center</p>
                    </div>
                    
                    <!-- Close Button on Mobile -->
                    <button onclick="toggleSidebar()" class="md:hidden text-slate-400 hover:text-white absolute top-6 right-6 focus:outline-none">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                
                <!-- Navigation Links -->
                <nav class="p-4 space-y-1.5">
                    <button onclick="goToTab('overview')" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-sm font-semibold text-slate-400">
                        <i class="fas fa-chart-pie w-5 text-base"></i> Dashboard Overview
                    </button>
                    <button onclick="goToTab('pending')" class="w-full flex items-center justify-between px-4 py-3.5 rounded-xl bg-slate-800 text-white transition-all text-sm font-semibold">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-hourglass-start w-5 text-base"></i> Pending Review
                        </div>
                    </button>
                    <button onclick="goToTab('catalog')" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-sm font-semibold text-slate-400">
                        <i class="fas fa-book-open w-5 text-base"></i> Published Catalog
                    </button>
                    <button onclick="goToTab('messages')" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-sm font-semibold text-slate-400">
                        <i class="fas fa-envelope-open-text w-5 text-base"></i> Contact Messages
                    </button>
                    <button onclick="goToTab('settings')" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-sm font-semibold text-slate-400">
                        <i class="fas fa-key w-5 text-base"></i> Change Password
                    </button>
                    <div class="pt-4 mt-4 border-t border-slate-800">
                        <a href="../index.php" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-sm font-semibold text-slate-400">
                            <i class="fas fa-external-link-alt w-5 text-base"></i> View Live Site
                        </a>
                    </div>
                </nav>
            </div>
            
            <!-- Profile slot at bottom -->
            <div class="p-4 border-t border-slate-800 bg-slate-950/20">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold">A</div>
                        <div>
                            <div class="text-sm font-semibold text-white">System Admin</div>
                            <div class="text-xs text-slate-500">Active Session</div>
                        </div>
                    </div>
                    <a href="logout.php" class="text-slate-500 hover:text-red-500 transition-colors py-1 px-2 rounded-lg hover:bg-slate-800" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-grow flex flex-col h-screen overflow-hidden">
            <!-- Top Header bar -->
            <header class="bg-white border-b border-slate-100 py-5 px-6 md:px-8 flex justify-between items-center shrink-0">
                <div class="flex items-center">
                    <!-- Hamburger Menu Button -->
                    <button onclick="toggleSidebar()" class="md:hidden text-slate-600 hover:text-slate-950 focus:outline-none mr-4">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="flex items-center gap-3">
                        <a href="dashboard.php" class="text-slate-400 hover:text-slate-950 transition-colors mr-1"><i class="fas fa-arrow-left text-lg"></i></a>
                        <h2 class="font-bold text-xl text-slate-900 font-['Outfit']">Publish Submission</h2>
                    </div>
                </div>
                <a href="dashboard.php" class="text-sm text-slate-400 hover:text-slate-800 transition-colors">Cancel</a>
            </header>

            <!-- Scrollable Content Pane -->
            <div class="flex-grow overflow-y-auto p-5 md:p-8">
                
                <?php if (!empty($error)): ?>
                    <div class="bg-red-500/15 border border-red-500/30 text-red-800 p-4 rounded-xl mb-6 text-sm flex gap-3 items-center max-w-3xl">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                        <span><?php echo htmlspecialchars($error); ?></span>
                    </div>
                <?php endif; ?>

                <div class="bg-white p-6 md:p-10 rounded-3xl shadow-sm border border-slate-100 max-w-3xl">
                    <form action="" method="POST" enctype="multipart/form-data" class="space-y-8">
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Article Title *</label>
                            <input type="text" name="title" required value="<?php echo htmlspecialchars($submission['title']); ?>" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Authors (Comma-separated) *</label>
                            <input type="text" name="authors" required value="<?php echo htmlspecialchars($submission['first_name'] . ' ' . $submission['last_name']); ?>" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all" placeholder="e.g. Dr. Praveen Kumar, Dr. Abhishek Raj">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700 font-title">Abstract / Summary *</label>
                            <textarea name="abstract" required rows="6" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all resize-none text-sm"><?php echo htmlspecialchars($submission['abstract']); ?></textarea>
                        </div>

                        <div class="grid grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700">Volume *</label>
                                <input type="text" name="volume" required value="1" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-center">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700">Issue *</label>
                                <input type="text" name="issue" required value="1" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-center font-semibold">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700">Year *</label>
                                <input type="text" name="year" required value="<?php echo date('Y'); ?>" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-center">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">DOI (Digital Object Identifier) <span class="text-slate-400 font-normal">(Optional)</span></label>
                            <input type="text" name="doi" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all" placeholder="e.g. 10.1234/ijari.2026.01">
                        </div>

                        <div class="space-y-2 pt-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-3">Upload Formatted Article PDF *</label>
                            <div class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center hover:bg-slate-50 hover:border-emerald-300 transition-colors cursor-pointer relative">
                                <input type="file" name="pdf_file" required accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                <i class="fas fa-file-pdf text-4xl text-red-500 mb-3 animate-pulse"></i>
                                <p class="text-slate-700 font-semibold mb-1">Click to select PDF File</p>
                                <p class="text-xs text-slate-400">PDF copy will be served to the readers.</p>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-4 rounded-xl shadow-lg transition-all text-lg flex items-center justify-center gap-2">
                            Confirm & Publish Article <i class="fas fa-check-double text-sm"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }
        }

        function goToTab(tabId) {
            localStorage.setItem('admin_active_tab', tabId);
            window.location.href = 'dashboard.php';
        }
    </script>

</body>
</html>
