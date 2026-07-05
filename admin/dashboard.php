<?php
require_once 'config.php';
check_auth();

$submissionsFile = '../data/submissions.json';
$articlesFile = '../data/articles.json';

// Helper to read JSON
function read_json($file) {
    if (!file_exists($file)) return [];
    $data = json_decode(file_get_contents($file), true);
    return is_array($data) ? $data : [];
}

// Helper to write JSON
function write_json($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

$submissions = read_json($submissionsFile);
$articles = read_json($articlesFile);

// Handle Actions (Delete/Unpublish)
$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? '';

if ($action && $id) {
    if ($action === 'delete_submission') {
        foreach ($submissions as &$sub) {
            if ($sub['id'] === $id) {
                $sub['status'] = 'deleted';
                break;
            }
        }
        write_json($submissionsFile, $submissions);
        header('Location: dashboard.php?msg=Submission deleted successfully');
        exit;
    }

    if ($action === 'unpublish') {
        // Remove from articles
        $articles = array_filter($articles, function($art) use ($id) {
            return $art['submission_id'] !== $id;
        });
        write_json($articlesFile, array_values($articles));

        // Mark submission back to pending
        foreach ($submissions as &$sub) {
            if ($sub['id'] === $id) {
                $sub['status'] = 'pending';
                break;
            }
        }
        write_json($submissionsFile, $submissions);
        header('Location: dashboard.php?msg=Article unpublished and returned to submissions');
        exit;
    }
}

$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | IJARI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Inter:wght@400;500;600&display=swap');
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, button, .font-title { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="bg-slate-900 text-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-emerald-500 p-2 rounded-lg text-white">
                    <i class="fas fa-lock text-lg"></i>
                </div>
                <div>
                    <h1 class="font-bold text-lg leading-tight uppercase font-title">IJARI Admin Panel</h1>
                    <p class="text-xs text-slate-400">Manage Journal and e-Magazine Publications</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="../index.php" target="_blank" class="text-sm text-slate-300 hover:text-white transition-colors flex items-center gap-1.5">
                    <i class="fas fa-external-link-alt text-xs"></i> View Site
                </a>
                <span class="text-slate-600">|</span>
                <a href="logout.php" class="bg-red-600/90 hover:bg-red-600 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-all shadow-sm">
                    Logout <i class="fas fa-sign-out-alt ml-1"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-6 py-10 max-w-6xl">
        
        <?php if (!empty($msg)): ?>
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl mb-8 flex gap-3 items-center shadow-sm">
                <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                <span class="font-medium"><?php echo htmlspecialchars($msg); ?></span>
            </div>
        <?php endif; ?>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-5">
                <div class="w-12 h-12 bg-amber-50 rounded-xl text-amber-600 flex items-center justify-center text-xl shrink-0"><i class="fas fa-hourglass-start"></i></div>
                <div>
                    <div class="text-sm text-slate-400 font-semibold uppercase tracking-wider">Pending Submissions</div>
                    <div class="text-3xl font-bold text-slate-800 mt-1">
                        <?php 
                        echo count(array_filter($submissions, function($s) { return $s['status'] === 'pending'; })); 
                        ?>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-5">
                <div class="w-12 h-12 bg-emerald-50 rounded-xl text-emerald-600 flex items-center justify-center text-xl shrink-0"><i class="fas fa-file-invoice"></i></div>
                <div>
                    <div class="text-sm text-slate-400 font-semibold uppercase tracking-wider">Published Journal Papers</div>
                    <div class="text-3xl font-bold text-slate-800 mt-1">
                        <?php 
                        echo count(array_filter($articles, function($a) { return $a['type'] === 'journal'; })); 
                        ?>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-5">
                <div class="w-12 h-12 bg-teal-50 rounded-xl text-teal-600 flex items-center justify-center text-xl shrink-0"><i class="fas fa-paper-plane"></i></div>
                <div>
                    <div class="text-sm text-slate-400 font-semibold uppercase tracking-wider">Published Magazine Articles</div>
                    <div class="text-3xl font-bold text-slate-800 mt-1">
                        <?php 
                        echo count(array_filter($articles, function($a) { return $a['type'] === 'magazine'; })); 
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Tabs / Grid -->
        <div class="space-y-12">

            <!-- 1. Pending Submissions Table -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 font-title">Pending Submissions</h2>
                        <p class="text-sm text-slate-500">Review newly submitted manuscripts and articles</p>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-100/50 text-[13px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                                <th class="px-8 py-4">Author</th>
                                <th class="px-6 py-4">Title & Details</th>
                                <th class="px-6 py-4">Type</th>
                                <th class="px-6 py-4 text-center">Manuscript</th>
                                <th class="px-8 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            <?php 
                            $pending = array_filter($submissions, function($s) { return $s['status'] === 'pending'; });
                            if (empty($pending)): 
                            ?>
                                <tr>
                                    <td colspan="5" class="px-8 py-10 text-center text-slate-400 font-medium">
                                        <i class="fas fa-inbox text-3xl mb-3 block text-slate-300"></i>
                                        No pending submissions found.
                                    </td>
                                </tr>
                            <?php else: foreach ($pending as $sub): ?>
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-5">
                                        <div class="font-semibold text-slate-800"><?php echo htmlspecialchars($sub['first_name'] . ' ' . $sub['last_name']); ?></div>
                                        <a href="mailto:<?php echo htmlspecialchars($sub['email']); ?>" class="text-xs text-slate-400 hover:text-emerald-600 transition-colors"><?php echo htmlspecialchars($sub['email']); ?></a>
                                    </td>
                                    <td class="px-6 py-5 max-w-md">
                                        <div class="font-medium text-slate-800 line-clamp-2"><?php echo htmlspecialchars($sub['title']); ?></div>
                                        <div class="text-xs text-slate-400 mt-1">Submitted on: <?php echo date('M d, Y h:i A', $sub['submitted_at']); ?></div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold <?php echo $sub['type'] === 'journal' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-teal-50 text-teal-700 border border-teal-100'; ?>">
                                            <?php echo $sub['type'] === 'journal' ? 'Journal' : 'e-Magazine'; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <a href="../<?php echo htmlspecialchars($sub['file_path']); ?>" download class="inline-flex items-center gap-1.5 text-xs text-emerald-600 hover:text-emerald-800 font-bold bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-100 hover:bg-emerald-100 transition-all">
                                            <i class="fas fa-file-download"></i> Doc/Word
                                        </a>
                                    </td>
                                    <td class="px-8 py-5 text-right space-x-2">
                                        <a href="publish.php?id=<?php echo htmlspecialchars($sub['id']); ?>" class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold px-4 py-2 rounded-xl shadow-sm transition-all hover:shadow-lg inline-block">
                                            <i class="fas fa-check-circle mr-1"></i> Publish
                                        </a>
                                        <a href="dashboard.php?action=delete_submission&id=<?php echo htmlspecialchars($sub['id']); ?>" onclick="return confirm('Are you sure you want to delete this submission?')" class="bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 text-xs font-bold px-3 py-2 rounded-xl transition-colors inline-block border border-slate-200 hover:border-red-100">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 2. Published Articles Management -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
                    <h2 class="text-xl font-bold text-slate-800 font-title">Published Articles Catalog</h2>
                    <p class="text-sm text-slate-500">Manage approved research papers and e-magazine publications</p>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-100/50 text-[13px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                                <th class="px-8 py-4">Authors</th>
                                <th class="px-6 py-4">Article Metadata</th>
                                <th class="px-6 py-4">Type / Index</th>
                                <th class="px-6 py-4 text-center">PDF</th>
                                <th class="px-8 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            <?php if (empty($articles)): ?>
                                <tr>
                                    <td colspan="5" class="px-8 py-10 text-center text-slate-400 font-medium">
                                        <i class="fas fa-newspaper text-3xl mb-3 block text-slate-300"></i>
                                        No published articles found.
                                    </td>
                                </tr>
                            <?php else: foreach ($articles as $art): ?>
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-5">
                                        <div class="font-semibold text-slate-800"><?php echo htmlspecialchars($art['authors']); ?></div>
                                        <div class="text-xs text-slate-400"><?php echo htmlspecialchars($art['email']); ?></div>
                                    </td>
                                    <td class="px-6 py-5 max-w-md">
                                        <div class="font-medium text-slate-800 line-clamp-2"><?php echo htmlspecialchars($art['title']); ?></div>
                                        <div class="text-xs text-slate-400 mt-1">
                                            Vol. <?php echo htmlspecialchars($art['volume']); ?>, 
                                            Issue <?php echo htmlspecialchars($art['issue']); ?> 
                                            (<?php echo htmlspecialchars($art['year']); ?>)
                                            <?php if(!empty($art['doi'])): ?> | DOI: <?php echo htmlspecialchars($art['doi']); ?><?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold <?php echo $art['type'] === 'journal' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-teal-50 text-teal-700 border border-teal-100'; ?>">
                                            <?php echo $art['type'] === 'journal' ? 'Journal' : 'e-Magazine'; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <a href="../<?php echo htmlspecialchars($art['pdf_path']); ?>" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-red-600 hover:text-red-800 font-bold bg-red-50 px-3 py-1.5 rounded-lg border border-red-100 hover:bg-red-100 transition-all">
                                            <i class="fas fa-file-pdf"></i> View PDF
                                        </a>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <a href="dashboard.php?action=unpublish&id=<?php echo htmlspecialchars($art['submission_id']); ?>" onclick="return confirm('Are you sure you want to unpublish this article? It will return to the pending list.')" class="bg-white hover:bg-slate-100 text-slate-700 text-xs font-semibold px-4 py-2 border border-slate-200 rounded-xl transition-all shadow-sm">
                                            Unpublish
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</body>
</html>
