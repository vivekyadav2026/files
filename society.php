<?php
$msg = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $designation = trim($_POST['designation'] ?? '');
    $affiliation = trim($_POST['affiliation'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $membership_type = trim($_POST['membership_type'] ?? '');
    $transaction_id = trim($_POST['transaction_id'] ?? '');

    if (empty($name) || empty($email) || empty($membership_type) || empty($transaction_id)) {
        $error = 'Please fill all required fields and provide your payment Transaction ID.';
    } else {
        $membershipsFile = 'data/memberships.json';
        $memberships = [];
        if (file_exists($membershipsFile)) {
            $memberships = json_decode(file_get_contents($membershipsFile), true);
            if (!is_array($memberships)) $memberships = [];
        }
        
        $memberships[] = [
            'id' => uniqid('mem_', true),
            'name' => $name,
            'designation' => $designation,
            'affiliation' => $affiliation,
            'email' => $email,
            'phone' => $phone,
            'type' => $membership_type,
            'transaction_id' => $transaction_id,
            'status' => 'pending',
            'submitted_at' => time()
        ];
        
        if (!file_exists('data')) { mkdir('data', 0777, true); }
        file_put_contents($membershipsFile, json_encode($memberships, JSON_PRETTY_PRINT));
        $msg = 'Your membership application has been submitted successfully! We will review your payment and activate your membership shortly.';
    }
}

include "header.php";
?>

        
    <div class="relative bg-slate-900 pt-24 pb-20 lg:pt-32 lg:pb-28 overflow-hidden z-10">
        <!-- Abstract Background -->
        <div class="absolute inset-0 bg-pattern opacity-10"></div>
        <div class="absolute right-0 top-0 w-1/2 h-full bg-gradient-to-l from-emerald-900/40 to-transparent"></div>
        <div class="absolute -left-40 -bottom-40 w-96 h-96 bg-emerald-500/20 rounded-full blur-[80px]"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-semibold mb-6 tracking-wide backdrop-blur-md">
                    <i class="fas fa-home"></i> IJARI > Society
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight tracking-tight font-['Outfit']">
                    IJARI Research Foundation
                </h1>
                <p class="text-lg md:text-xl text-slate-300 leading-relaxed max-w-2xl font-light">
                    Advancing agricultural sciences and fostering innovation globally.
                </p>
            </div>
        </div>
        
        <!-- Decorative Bottom Curve -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-[60px] md:h-[80px]">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" fill="#f7f9f4"></path>
            </svg>
        </div>
    </div>
    
        
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-5xl">
            <div class="grid lg:grid-cols-12 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-7 space-y-10">
                    <div class="bg-white rounded-tr-[4rem] rounded-bl-[4rem] shadow-2xl border-t-8 border-[#D4E157] relative overflow-hidden p-8 md:p-10 prose prose-emerald prose-lg prose-headings:font-['Oswald'] prose-headings:uppercase prose-headings:tracking-wide prose-headings:text-[#1B4332] max-w-none text-slate-600">
                        <p class="lead">Founded in <strong>2026</strong>, the <strong>IJARI Research Foundation</strong> is a premier non-profit organization dedicated to the continuous advancement of agricultural research, education, and extension.</p>
                        
                        <h3 class="font-['Outfit'] text-2xl font-bold text-slate-900 mt-8">Vision</h3>
                        <p>To be a global leader in fostering agricultural innovation, sustainability, and scientific excellence to ensure food security and environmental resilience for future generations.</p>
                        
                        <h3 class="font-['Outfit'] text-2xl font-bold text-slate-900 mt-8">Mission</h3>
                        <p>To provide a dynamic platform for researchers, academicians, and farming communities to collaborate, share groundbreaking research, and implement scientifically validated practices that enhance agricultural productivity globally.</p>
                        
                        <h3 class="font-['Outfit'] text-2xl font-bold text-slate-900 mt-8">Objectives</h3>
                        <ul class="space-y-2">
                            <li>To promote and publish high-quality research through the International Journal of Agricultural Research and Innovation (IJARI).</li>
                            <li>To disseminate practical agricultural knowledge through the Farm Science Today e-magazine.</li>
                            <li>To organize national and international conferences, seminars, and workshops.</li>
                            <li>To confer awards and fellowships recognizing outstanding contributions to agricultural sciences.</li>
                        </ul>
                    </div>
                </div>

                <!-- Membership Form Sidebar -->
                <div class="lg:col-span-5">
                    <?php if (!empty($msg)): ?>
                        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-5 rounded-2xl mb-8 flex gap-4 items-start shadow-sm">
                            <i class="fas fa-check-circle text-emerald-500 mt-1"></i>
                            <p class="text-sm font-semibold"><?php echo htmlspecialchars($msg); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($error)): ?>
                        <div class="bg-red-50 border border-red-200 text-red-800 p-5 rounded-2xl mb-8 flex gap-4 items-start shadow-sm">
                            <i class="fas fa-exclamation-circle text-red-500 mt-1"></i>
                            <p class="text-sm font-semibold"><?php echo htmlspecialchars($error); ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100">
                        <div class="flex items-center gap-3 mb-6 border-b border-slate-100 pb-4">
                            <i class="fas fa-id-card text-2xl text-emerald-500"></i>
                            <h3 class="text-2xl font-bold text-slate-800 font-['Outfit']">Join the Society</h3>
                        </div>
                        
                        <form action="" method="POST" class="space-y-5">
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-slate-700">Full Name *</label>
                                <input type="text" name="name" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-2.5 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                            </div>

                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-slate-700">Designation / Position</label>
                                <input type="text" name="designation" class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-2.5 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                            </div>

                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-slate-700">Affiliation / Institution</label>
                                <input type="text" name="affiliation" class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-2.5 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-slate-700">Email *</label>
                                    <input type="email" name="email" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-2.5 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-slate-700">Phone / Mobile</label>
                                    <input type="text" name="phone" class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-2.5 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-slate-700">Type of Membership *</label>
                                <select name="membership_type" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-2.5 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                                    <option value="">Select Membership</option>
                                    <option value="Lifetime">Lifetime Membership</option>
                                    <option value="Annual">Annual Membership</option>
                                    <option value="Student">Student Membership</option>
                                    <option value="Institutional">Institutional Membership</option>
                                </select>
                            </div>

                            <div class="bg-emerald-50 p-4 rounded-xl border border-emerald-100 mt-2">
                                <label class="block text-sm font-semibold text-emerald-900 mb-1">Payment Transaction ID *</label>
                                <p class="text-[11px] text-emerald-700 mb-2">Please make the payment via our <a href="payment.php" class="underline font-bold" target="_blank">Payment Page</a> and enter the Transaction ID here.</p>
                                <input type="text" name="transaction_id" required placeholder="e.g. UPI Ref / NEFT UTR" class="w-full bg-white border border-emerald-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                            </div>

                            <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-3.5 rounded-xl hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-600/20 text-sm flex items-center justify-center gap-2 mt-4">
                                Submit Application <i class="fas fa-paper-plane text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
<?php include "footer.php"; ?>