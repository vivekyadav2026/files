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
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-slate-900 text-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <a href="dashboard.php" class="text-slate-400 hover:text-white transition-colors mr-2"><i class="fas fa-arrow-left text-lg"></i></a>
                <div>
                    <h1 class="font-bold text-lg leading-tight uppercase font-title">Publish Submission</h1>
                    <p class="text-xs text-slate-400">Complete Metadata & PDF Upload</p>
                </div>
            </div>
            <a href="dashboard.php" class="text-sm text-slate-400 hover:text-white transition-colors">Cancel</a>
        </div>
    </header>

    <!-- Main -->
    <main class="flex-grow container mx-auto px-6 py-10 max-w-3xl">
        
        <?php if (!empty($error)): ?>
            <div class="bg-red-500/15 border border-red-500/30 text-red-800 p-4 rounded-xl mb-6 text-sm flex gap-3 items-center">
                <i class="fas fa-exclamation-circle text-red-500"></i>
                <span><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>

        <div class="bg-white p-10 rounded-3xl shadow-sm border border-slate-100">
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
                    <textarea name="abstract" required rows="6" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all resize-none"><?php echo htmlspecialchars($submission['abstract']); ?></textarea>
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
    </main>
</body>
</html>
