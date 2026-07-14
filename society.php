<?php
$msg = '';
  if (isset($_GET['success']) && $_GET['success'] == 1) {
      $msg = 'Form submitted successfully! We will get back to you shortly.';
  }
$error = '';
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
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
        header('Location: ' . basename($_SERVER['PHP_SELF']) . '?success=1'); exit;
    }
}

include "header.php";
?>

        
      <div class="relative bg-emerald-50 text-emerald-950 py-12 md:py-16 overflow-hidden border-b border-emerald-100 text-center z-10">
          <!-- Background Image with Overlay -->
          <div class="absolute inset-0 z-0 pointer-events-none">
              <img src="assets/light_banner_v2.png" alt="Banner" class="w-full h-full object-cover object-center opacity-40 ">
              <div class="absolute inset-0 bg-white/70"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-emerald-50 via-transparent to-transparent"></div>
          </div>
          
          <div class="container mx-auto px-6 relative z-10">
              <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-600" aria-label="Breadcrumb">
                  <ol class="inline-flex items-center space-x-2">
                      <li><a href="index.php" class="hover:text-emerald-900 transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                      <li><span class="mx-1 text-slate-500">/</span></li>
                      <li aria-current="page" class="text-emerald-950 font-semibold">IJARI > Society</li>
                  </ol>
              </nav>
              <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-emerald-900">
                  IJARI Research Foundation
              </h1>
              <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto font-light leading-relaxed">
                  Advancing agricultural sciences and fostering innovation globally.
              </p>
          </div>
      </div>
      
        
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-7xl">
            <div class="grid lg:grid-cols-12 gap-12">
                <!-- Info Section -->
                <div class="lg:col-span-7 space-y-8 text-slate-600 leading-relaxed text-base">
                    <div>
                        <h2 class="text-3xl font-bold text-slate-800 mb-4 font-['Outfit']">About the Society</h2>
                        <p class="mb-4">The Agricultural Research and Development Society is a registered scientific organization dedicated to the promotion and advancement of agricultural sciences, rural development, and scientific innovations. The society acts as the proud publisher of the <strong>International Journal of Agricultural Research and Innovation (IJARI)</strong>.</p>
                        <p>Our network comprises scientists, researchers, extension specialists, and students collaborating to address critical issues like global food security, climate-resilient farming, and sustainable agricultural technologies.</p>
                    </div>

                    <div class="bg-emerald-50/50 p-6 rounded-2xl border border-emerald-100/50">
                        <h3 class="font-bold text-xl text-emerald-950 mb-3 font-['Outfit']">Key Objectives</h3>
                        <ul class="space-y-2.5">
                            <li class="flex items-start gap-2.5"><i class="fas fa-check text-emerald-600 mt-1.5 text-xs"></i> <span>Fostering peer-reviewed publication of high-quality scientific literature.</span></li>
                            <li class="flex items-start gap-2.5"><i class="fas fa-check text-emerald-600 mt-1.5 text-xs"></i> <span>Organizing conferences, workshops, and training for researchers.</span></li>
                            <li class="flex items-start gap-2.5"><i class="fas fa-check text-emerald-600 mt-1.5 text-xs"></i> <span>Supporting innovative technologies that aid progressive farming.</span></li>
                        </ul>
                    </div>

                    <!-- Membership Fee Categories -->
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-6 font-['Outfit']">Membership Categories & Fees</h3>
                        <div class="overflow-hidden border border-slate-700/30 rounded-2xl shadow-lg">
                            <table class="w-full text-left border-collapse text-sm">
                                <thead>
                                    <tr class="bg-slate-900 text-white font-semibold">
                                        <th class="py-4 px-6 border-b border-slate-700">Category</th>
                                        <th class="py-4 px-6 border-b border-slate-700">Indian Members (INR)</th>
                                        <th class="py-4 px-6 border-b border-slate-700">Foreign Members (USD)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-slate-900 text-slate-300">
                                    <tr class="border-b border-slate-700/50 hover:bg-slate-800 transition-colors">
                                        <td class="py-4 px-6 font-medium text-white">Lifetime</td>
                                        <td class="py-4 px-6">2000</td>
                                        <td class="py-4 px-6">100</td>
                                    </tr>
                                    <tr class="border-b border-slate-700/50 hover:bg-slate-800 transition-colors bg-slate-800/30">
                                        <td class="py-4 px-6 font-medium text-white">Annual</td>
                                        <td class="py-4 px-6">500</td>
                                        <td class="py-4 px-6">20</td>
                                    </tr>
                                    <tr class="border-b border-slate-700/50 hover:bg-slate-800 transition-colors">
                                        <td class="py-4 px-6 font-medium text-white">Student</td>
                                        <td class="py-4 px-6">300</td>
                                        <td class="py-4 px-6">15</td>
                                    </tr>
                                    <tr class="hover:bg-slate-800 transition-colors bg-slate-800/30">
                                        <td class="py-4 px-6 font-medium text-white">Institutional</td>
                                        <td class="py-4 px-6">5000</td>
                                        <td class="py-4 px-6">200</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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