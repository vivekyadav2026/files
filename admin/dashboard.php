<?php
require_once 'config.php';
check_auth();

$submissionsFile = '../data/submissions.json';
$articlesFile = '../data/articles.json';
$messagesFile = '../data/messages.json';
$reviewersFile = '../data/reviewers.json';

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
$messages = read_json($messagesFile);
$reviewers = read_json($reviewersFile);

// Handle Actions (Delete/Unpublish/Delete Message/Change Password/Reviewer Approval)
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

    if ($action === 'delete_message') {
        $messages = array_filter($messages, function($m) use ($id) {
            return $m['id'] !== $id;
        });
        write_json($messagesFile, array_values($messages));
        header('Location: dashboard.php?msg=Message deleted successfully');
        exit;
    }

    if ($action === 'approve_reviewer') {
        foreach ($reviewers as &$rev) {
            if ($rev['id'] === $id) {
                $rev['status'] = 'approved';
                break;
            }
        }
        write_json($reviewersFile, $reviewers);
        header('Location: dashboard.php?msg=Reviewer application approved successfully');
        exit;
    }

    if ($action === 'decline_reviewer') {
        foreach ($reviewers as &$rev) {
            if ($rev['id'] === $id) {
                $rev['status'] = 'declined';
                break;
            }
        }
        write_json($reviewersFile, $reviewers);
        header('Location: dashboard.php?msg=Reviewer application declined successfully');
        exit;
    }

    if ($action === 'delete_reviewer') {
        $reviewers = array_filter($reviewers, function($r) use ($id) {
            return $r['id'] !== $id;
        });
        write_json($reviewersFile, array_values($reviewers));
        header('Location: dashboard.php?msg=Reviewer application deleted successfully');
        exit;
    }
}

// Handle Change Password Form
$error_pwd = '';
$success_pwd = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'change_password') {
    $current = $_POST['current_password'] ?? '';
    $newPass = $_POST['new_password'] ?? '';
    $confirmPass = $_POST['confirm_password'] ?? '';
    
    $credsFile = '../data/admin_credentials.json';
    $creds = json_decode(file_get_contents($credsFile), true);
    
    if (!password_verify($current, $creds['password_hash'])) {
        $error_pwd = 'Current password is incorrect.';
    } elseif ($newPass !== $confirmPass) {
        $error_pwd = 'New passwords do not match.';
    } elseif (strlen($newPass) < 6) {
        $error_pwd = 'New password must be at least 6 characters.';
    } else {
        $creds['password_hash'] = password_hash($newPass, PASSWORD_DEFAULT);
        file_put_contents($credsFile, json_encode($creds, JSON_PRETTY_PRINT));
        $success_pwd = 'Password changed successfully.';
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
                    <button onclick="showTab('overview')" id="tab-btn-overview" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-sm font-semibold text-slate-400">
                        <i class="fas fa-chart-pie w-5 text-base"></i> Dashboard Overview
                    </button>
                    <button onclick="showTab('pending')" id="tab-btn-pending" class="w-full flex items-center justify-between px-4 py-3.5 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-sm font-semibold text-slate-400">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-hourglass-start w-5 text-base"></i> Pending Review
                        </div>
                        <?php 
                        $pendingCount = count(array_filter($submissions, function($s) { return $s['status'] === 'pending'; }));
                        if ($pendingCount > 0): 
                        ?>
                            <span class="bg-amber-500 text-slate-950 font-bold px-2 py-0.5 rounded-full text-xs"><?php echo $pendingCount; ?></span>
                        <?php endif; ?>
                    </button>
                    <button onclick="showTab('catalog')" id="tab-btn-catalog" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-sm font-semibold text-slate-400">
                        <i class="fas fa-book-open w-5 text-base"></i> Published Catalog
                    </button>
                    <button onclick="showTab('reviewers')" id="tab-btn-reviewers" class="w-full flex items-center justify-between px-4 py-3.5 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-sm font-semibold text-slate-400">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-user-plus w-5 text-base"></i> Reviewer Apps
                        </div>
                        <?php 
                        $pendingRevCount = count(array_filter($reviewers, function($r) { return $r['status'] === 'pending'; }));
                        if ($pendingRevCount > 0): 
                        ?>
                            <span class="bg-blue-500 text-white font-bold px-2 py-0.5 rounded-full text-xs"><?php echo $pendingRevCount; ?></span>
                        <?php endif; ?>
                    </button>
                    <button onclick="showTab('messages')" id="tab-btn-messages" class="w-full flex items-center justify-between px-4 py-3.5 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-sm font-semibold text-slate-400">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope-open-text w-5 text-base"></i> Contact Messages
                        </div>
                        <?php 
                        $msgCount = count($messages);
                        if ($msgCount > 0): 
                        ?>
                            <span class="bg-emerald-500 text-white font-bold px-2 py-0.5 rounded-full text-xs"><?php echo $msgCount; ?></span>
                        <?php endif; ?>
                    </button>
                    <button onclick="showTab('settings')" id="tab-btn-settings" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-sm font-semibold text-slate-400">
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
                    <h2 id="page-title" class="font-bold text-xl text-slate-900 font-['Outfit']">Dashboard Overview</h2>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-sm text-slate-500 font-medium hidden sm:block"><?php echo date('l, M d, Y'); ?></div>
                </div>
            </header>

            <!-- Scrollable Content Pane -->
            <div class="flex-grow overflow-y-auto p-5 md:p-8">
                
                <?php if (!empty($msg)): ?>
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl mb-8 flex gap-3 items-center shadow-sm max-w-4xl">
                        <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                        <span class="font-medium"><?php echo htmlspecialchars($msg); ?></span>
                    </div>
                <?php endif; ?>

                <!-- Tab 1: Overview -->
                <div id="tab-overview" class="space-y-10 max-w-5xl">
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-5">
                            <div class="w-12 h-12 bg-amber-50 rounded-xl text-amber-600 flex items-center justify-center text-xl shrink-0"><i class="fas fa-hourglass-start"></i></div>
                            <div>
                                <div class="text-xs text-slate-400 font-bold uppercase tracking-wider">Submissions</div>
                                <div class="text-3xl font-bold text-slate-800 mt-1"><?php echo $pendingCount; ?></div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-5">
                            <div class="w-12 h-12 bg-emerald-50 rounded-xl text-emerald-600 flex items-center justify-center text-xl shrink-0"><i class="fas fa-file-invoice"></i></div>
                            <div>
                                <div class="text-xs text-slate-400 font-bold uppercase tracking-wider">Published</div>
                                <div class="text-3xl font-bold text-slate-800 mt-1">
                                    <?php echo count(array_filter($articles, function($a) { return $a['type'] === 'journal'; })); ?>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-5">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl text-blue-600 flex items-center justify-center text-xl shrink-0"><i class="fas fa-user-plus"></i></div>
                            <div>
                                <div class="text-xs text-slate-400 font-bold uppercase tracking-wider">Reviewer Apps</div>
                                <div class="text-3xl font-bold text-slate-800 mt-1"><?php echo $pendingRevCount; ?></div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-5">
                            <div class="w-12 h-12 bg-teal-50 rounded-xl text-teal-600 flex items-center justify-center text-xl shrink-0"><i class="fas fa-envelope-open-text"></i></div>
                            <div>
                                <div class="text-xs text-slate-400 font-bold uppercase tracking-wider">Messages</div>
                                <div class="text-3xl font-bold text-slate-800 mt-1"><?php echo $msgCount; ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Greeting & Quick Actions -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-3xl p-8 shadow-xl flex flex-col justify-between relative overflow-hidden">
                            <div class="absolute -right-16 -top-16 w-48 h-48 bg-emerald-500/10 rounded-full blur-2xl"></div>
                            <div>
                                <h3 class="text-2xl font-bold mb-3 font-['Outfit']">Welcome Back!</h3>
                                <p class="text-slate-400 text-sm leading-relaxed mb-6">You are logged into the IJARI control center. From here, you can process incoming submissions and manage the active publishing catalog dynamically.</p>
                            </div>
                            <div class="flex flex-wrap gap-3 border-t border-slate-700/50 pt-6">
                                <button onclick="showTab('pending')" class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-all shadow-md">
                                    Review Submissions
                                </button>
                                <button onclick="showTab('reviewers')" class="bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-all shadow-md">
                                    Reviewer Requests
                                </button>
                                <button onclick="showTab('messages')" class="bg-white/10 hover:bg-white/20 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-all">
                                    Read Messages
                                </button>
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
                            <h3 class="text-lg font-bold text-slate-900 mb-6 font-['Outfit'] border-b border-slate-50 pb-2">Quick Navigation Links</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <a href="../ijari-submit.php" target="_blank" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 border border-slate-100 text-slate-700 hover:text-emerald-600 transition-all">
                                    <i class="fas fa-file-invoice text-emerald-500 text-base"></i>
                                    <span class="text-sm font-semibold">Submit Journal Form</span>
                                </a>
                                <a href="../emagazine-submit.php" target="_blank" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 border border-slate-100 text-slate-700 hover:text-teal-600 transition-all">
                                    <i class="fas fa-paper-plane text-teal-500 text-base"></i>
                                    <span class="text-sm font-semibold">Submit Magazine Form</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 2: Pending Submissions -->
                <div id="tab-pending" class="space-y-6 max-w-5xl hidden">
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-100/50 text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
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
                                            <td colspan="5" class="px-8 py-12 text-center text-slate-400 font-medium">
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
                                                <div class="text-xs text-slate-400 mt-1">Submitted: <?php echo date('M d, Y h:i A', $sub['submitted_at']); ?></div>
                                            </td>
                                            <td class="px-6 py-5">
                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold <?php echo $sub['type'] === 'journal' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-teal-50 text-teal-700 border border-teal-100'; ?>">
                                                    <?php echo $sub['type'] === 'journal' ? 'Journal' : 'e-Magazine'; ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 text-center">
                                                <a href="../<?php echo htmlspecialchars($sub['file_path']); ?>" download class="inline-flex items-center gap-1.5 text-xs text-emerald-600 hover:text-emerald-800 font-bold bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-100 hover:bg-emerald-100 transition-all">
                                                    <i class="fas fa-file-download"></i> Doc
                                                </a>
                                            </td>
                                            <td class="px-8 py-5 text-right space-x-2 whitespace-nowrap">
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
                </div>

                <!-- Tab 3: Published Catalog -->
                <div id="tab-catalog" class="space-y-6 max-w-5xl hidden">
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-100/50 text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
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
                                            <td colspan="5" class="px-8 py-12 text-center text-slate-400 font-medium">
                                                <i class="fas fa-newspaper text-3xl mb-3 block text-slate-300"></i>
                                                No published articles found.
                                            </td>
                                        </tr>
                                    <?php else: foreach ($articles as $art): ?>
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-8 py-5 font-semibold text-slate-800">
                                                <div><?php echo htmlspecialchars($art['authors']); ?></div>
                                                <div class="text-xs text-slate-400 font-normal"><?php echo htmlspecialchars($art['email']); ?></div>
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
                                                    <i class="fas fa-file-pdf"></i> PDF
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

                <!-- Tab 6: Reviewer Applications -->
                <div id="tab-reviewers" class="space-y-6 max-w-5xl hidden">
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-100/50 text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                                        <th class="px-8 py-4">Applicant</th>
                                        <th class="px-6 py-4">Affiliation & Expertise</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4 text-center">CV / Resume</th>
                                        <th class="px-8 py-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    <?php if (empty($reviewers)): ?>
                                        <tr>
                                            <td colspan="5" class="px-8 py-12 text-center text-slate-400 font-medium">
                                                <i class="fas fa-user-plus text-3xl mb-3 block text-slate-300"></i>
                                                No reviewer applications found.
                                            </td>
                                        </tr>
                                    <?php else: foreach ($reviewers as $rev): ?>
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-8 py-5">
                                                <div class="font-semibold text-slate-800"><?php echo htmlspecialchars($rev['first_name'] . ' ' . $rev['last_name']); ?></div>
                                                <a href="mailto:<?php echo htmlspecialchars($rev['email']); ?>" class="text-xs text-slate-400 hover:text-emerald-600 transition-colors"><?php echo htmlspecialchars($rev['email']); ?></a>
                                                <div class="text-[10px] text-slate-400 mt-1"><?php echo date('M d, Y h:i A', $rev['submitted_at']); ?></div>
                                            </td>
                                            <td class="px-6 py-5 max-w-md">
                                                <div class="font-medium text-slate-800"><?php echo htmlspecialchars($rev['affiliation']); ?></div>
                                                <div class="text-xs text-emerald-600 font-bold mt-1 uppercase tracking-wide"><i class="fas fa-tags text-[10px] mr-1"></i><?php echo htmlspecialchars($rev['expertise']); ?></div>
                                            </td>
                                            <td class="px-6 py-5">
                                                <?php if ($rev['status'] === 'pending'): ?>
                                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">Pending Review</span>
                                                <?php elseif ($rev['status'] === 'approved'): ?>
                                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">Approved</span>
                                                <?php else: ?>
                                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-100">Declined</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-5 text-center">
                                                <?php if(!empty($rev['cv_path'])): ?>
                                                    <a href="../<?php echo htmlspecialchars($rev['cv_path']); ?>" download class="inline-flex items-center gap-1.5 text-xs text-emerald-600 hover:text-emerald-800 font-bold bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-100 hover:bg-emerald-100 transition-all">
                                                        <i class="fas fa-file-pdf"></i> Download CV
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-slate-400 text-xs">No CV</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-8 py-5 text-right space-x-1 whitespace-nowrap">
                                                <?php if ($rev['status'] === 'pending'): ?>
                                                    <a href="dashboard.php?action=approve_reviewer&id=<?php echo htmlspecialchars($rev['id']); ?>" class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold px-3 py-1.5 rounded-xl transition-all shadow-sm">Approve</a>
                                                    <a href="dashboard.php?action=decline_reviewer&id=<?php echo htmlspecialchars($rev['id']); ?>" class="bg-amber-500 hover:bg-amber-400 text-slate-950 text-xs font-bold px-3 py-1.5 rounded-xl transition-all shadow-sm">Decline</a>
                                                <?php endif; ?>
                                                <a href="dashboard.php?action=delete_reviewer&id=<?php echo htmlspecialchars($rev['id']); ?>" onclick="return confirm('Are you sure you want to delete this reviewer application?')" class="bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 text-xs font-bold px-3 py-2 rounded-xl transition-colors inline-block border border-slate-200 hover:border-red-100">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tab 4: Messages -->
                <div id="tab-messages" class="space-y-6 max-w-5xl hidden">
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-100/50 text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                                        <th class="px-8 py-4">Sender</th>
                                        <th class="px-6 py-4">Subject & Message</th>
                                        <th class="px-6 py-4">Date</th>
                                        <th class="px-8 py-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    <?php if (empty($messages)): ?>
                                        <tr>
                                            <td colspan="4" class="px-8 py-12 text-center text-slate-400 font-medium">
                                                <i class="fas fa-envelope text-3xl mb-3 block text-slate-300"></i>
                                                No contact messages found.
                                            </td>
                                        </tr>
                                    <?php else: foreach ($messages as $m): ?>
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-8 py-5 font-semibold text-slate-800">
                                                <div><?php echo htmlspecialchars($m['name']); ?></div>
                                                <a href="mailto:<?php echo htmlspecialchars($m['email']); ?>" class="text-xs text-slate-400 hover:text-emerald-600 transition-colors"><?php echo htmlspecialchars($m['email']); ?></a>
                                            </td>
                                            <td class="px-6 py-5 max-w-lg">
                                                <div class="font-semibold text-slate-800"><?php echo htmlspecialchars($m['subject']); ?></div>
                                                <div class="text-xs text-slate-500 mt-1 whitespace-pre-line leading-relaxed"><?php echo htmlspecialchars($m['message']); ?></div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap text-xs text-slate-400">
                                                <?php echo date('M d, Y h:i A', $m['submitted_at']); ?>
                                            </td>
                                            <td class="px-8 py-5 text-right">
                                                <a href="dashboard.php?action=delete_message&id=<?php echo htmlspecialchars($m['id']); ?>" onclick="return confirm('Are you sure you want to delete this message?')" class="bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 text-xs font-bold px-3 py-2 rounded-xl transition-colors inline-block border border-slate-200 hover:border-red-100">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tab 5: Settings / Change Password -->
                <div id="tab-settings" class="space-y-6 max-w-xl hidden">
                    <?php if (!empty($error_pwd)): ?>
                        <div class="bg-red-50 border border-red-200 text-red-800 p-5 rounded-2xl mb-6 flex gap-3 items-center shadow-sm">
                            <i class="fas fa-exclamation-circle text-red-500 text-lg"></i>
                            <span class="text-sm font-semibold"><?php echo htmlspecialchars($error_pwd); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($success_pwd)): ?>
                        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-5 rounded-2xl mb-6 flex gap-3 items-center shadow-sm">
                            <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                            <span class="text-sm font-semibold"><?php echo htmlspecialchars($success_pwd); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="bg-white p-8 md:p-10 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 text-left">
                        <h3 class="text-xl font-bold text-slate-800 font-['Outfit'] border-b border-slate-50 pb-2 mb-6">Change Account Password</h3>
                        
                        <form action="" method="POST" class="space-y-6">
                            <input type="hidden" name="action" value="change_password">
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700">Current Password *</label>
                                <input type="password" name="current_password" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700">New Password *</label>
                                <input type="password" name="new_password" required minlength="6" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700">Confirm New Password *</label>
                                <input type="password" name="confirm_password" required minlength="6" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                            </div>

                            <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3.5 rounded-xl hover:bg-emerald-600 transition-colors shadow-lg text-sm flex items-center justify-center gap-2">
                                Update Password <i class="fas fa-save text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Client-side Tab Switcher & Responsive Menu Scripts -->
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

        function showTab(tabId) {
            // Hide all tabs
            document.getElementById('tab-overview').classList.add('hidden');
            document.getElementById('tab-pending').classList.add('hidden');
            document.getElementById('tab-catalog').classList.add('hidden');
            document.getElementById('tab-reviewers').classList.add('hidden');
            document.getElementById('tab-messages').classList.add('hidden');
            document.getElementById('tab-settings').classList.add('hidden');
            
            // Deactivate all button active styles
            const btns = ['overview', 'pending', 'catalog', 'reviewers', 'messages', 'settings'];
            btns.forEach(btn => {
                const el = document.getElementById('tab-btn-' + btn);
                if (el) {
                    el.classList.remove('bg-slate-800', 'text-white');
                    el.classList.add('text-slate-400');
                }
            });
            
            // Show active tab
            document.getElementById('tab-' + tabId).classList.remove('hidden');
            
            // Activate active button style
            const activeEl = document.getElementById('tab-btn-' + tabId);
            if (activeEl) {
                activeEl.classList.remove('text-slate-400');
                activeEl.classList.add('bg-slate-800', 'text-white');
            }
            
            // Update top header page title
            const titles = {
                overview: 'Dashboard Overview',
                pending: 'Pending Submissions',
                catalog: 'Published Catalog',
                reviewers: 'Reviewer Applications',
                messages: 'Contact Messages',
                settings: 'Change Password'
            };
            document.getElementById('page-title').innerText = titles[tabId];
            
            // Persist tab state across dashboard reloads
            localStorage.setItem('admin_active_tab', tabId);

            // Auto-close sidebar on mobile after clicking a tab
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            if (!sidebar.classList.contains('-translate-x-full') && window.innerWidth < 768) {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }
        }

        // Initialize active tab on load
        window.addEventListener('DOMContentLoaded', () => {
            // If server form validation triggers, we display settings tab if form was posted
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'change_password'): ?>
                showTab('settings');
            <?php else: ?>
                const activeTab = localStorage.getItem('admin_active_tab') || 'overview';
                showTab(activeTab);
            <?php endif; ?>
        });
    </script>

</body>
</html>
