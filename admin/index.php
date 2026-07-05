<?php
require_once 'config.php';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === ADMIN_USER && password_verify($password, ADMIN_PASS_HASH)) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | IJARI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Inter:wght@400;500&display=swap');
        body { font-family: 'Inter', sans-serif; }
        h1, h2, button { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl"></div>

    <div class="w-full max-w-md p-8 bg-slate-800 rounded-3xl border border-slate-700 shadow-2xl relative z-10 mx-4">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-emerald-500 text-white text-3xl mb-4 shadow-lg shadow-emerald-500/20">
                <i class="fas fa-user-shield"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Admin Portal</h1>
            <p class="text-slate-400 text-sm">International Journal of Agricultural Research and Innovation</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="bg-red-500/15 border border-red-500/30 text-red-300 p-4 rounded-xl mb-6 text-sm flex gap-3 items-center">
                <i class="fas fa-exclamation-circle text-red-400"></i>
                <span><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-6">
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-300">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <i class="fas fa-user text-sm"></i>
                    </span>
                    <input type="text" name="username" required placeholder="Enter username" class="w-full bg-slate-900 border border-slate-700 rounded-xl pl-11 pr-4 py-3.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-300">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <i class="fas fa-lock text-sm"></i>
                    </span>
                    <input type="password" name="password" required placeholder="Enter password" class="w-full bg-slate-900 border border-slate-700 rounded-xl pl-11 pr-4 py-3.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                </div>
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-4 rounded-xl transition-colors shadow-lg shadow-emerald-500/20 flex items-center justify-center gap-2">
                Sign In <i class="fas fa-sign-in-alt text-sm"></i>
            </button>
        </form>
    </div>
</body>
</html>
