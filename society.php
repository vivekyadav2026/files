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
                        <h2 class="text-3xl font-bold text-slate-800 mb-4 font-['Outfit']">About IJARI Research Foundation</h2>
                        <p class="mb-4"><strong>IJARI Research Foundation (IJARI)</strong> was founded in 2026. It is an autonomous research and educational society, which is under process of registration under Societies Registration Act. It is a scientific and educational society, working in agriculture, environment, rural development, allied sciences such as veterinary, home science, biotechnology, engineering as well as natural farming for sustainable development, and provides a unique platform to scientists, academicians, researchers, and policymakers to exchange ideas, encourage research, and disseminate knowledge in the field of agriculture.</p>
                        <p class="mb-4">IJARI Research Foundation was started with the aim to revitalize agricultural and allied advance scientific research and extension and strengthen community livelihoods by providing members with opportunities for the exchange of knowledge and cooperation among relevant societies. IJARI's primary scope covers Agronomy, Horticulture, Entomology, Plant Pathology, Soil Science, Agricultural Economics, Environmental Science, Home Science, Extension, Agricultural Engineering, Biotechnology as well as humanities and other applied sciences.</p>
                        <p>IJARI Research Foundation is one of India's emerging networks of agricultural professionals and acts as a bridge between research communities, government bodies, development organizations, and corporate entities and farmers. IJARI achieves this through research and extension publications, field implementation projects, capacity-building programs with integrated deployment of technological and scientific innovation for efficiency and scale.</p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-emerald-50/70 p-6 rounded-2xl border border-emerald-100">
                            <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white mb-4"><i class="fas fa-eye"></i></div>
                            <h3 class="font-bold text-lg text-emerald-900 mb-2 font-['Outfit']">Vision</h3>
                            <p class="text-sm">To advance scientific research and innovation for sustainable development, empowering communities with basic and applied knowledge in agriculture. We believe that when students, farmers, and researchers are enabled with the right knowledge and tools, agriculture can become a place of opportunity and progress for all.</p>
                        </div>
                        <div class="bg-emerald-50/70 p-6 rounded-2xl border border-emerald-100">
                            <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white mb-4"><i class="fas fa-bullseye"></i></div>
                            <h3 class="font-bold text-lg text-emerald-900 mb-2 font-['Outfit']">Mission</h3>
                            <p class="text-sm">To diversify and strengthen organizational competency to develop and implement strategies and programmes that enhance the capacities of students, farmers, and researchers through empowerment, participation, and advocacy.</p>
                        </div>
                    </div>

                    <div class="bg-emerald-50/50 p-6 rounded-2xl border border-emerald-100/50">
                        <h3 class="font-bold text-xl text-emerald-950 mb-3 font-['Outfit']">Our Key Focus Areas</h3>
                        <ul class="space-y-2.5">
                            <li class="flex items-start gap-2.5"><i class="fas fa-check text-emerald-600 mt-1.5 text-xs"></i> <span>Pioneering a participatory approach to the long-term betterment of the agricultural sector.</span></li>
                            <li class="flex items-start gap-2.5"><i class="fas fa-check text-emerald-600 mt-1.5 text-xs"></i> <span>Enhancing incomes, knowledge access, and research output through access to markets, technologies, and scientific findings.</span></li>
                            <li class="flex items-start gap-2.5"><i class="fas fa-check text-emerald-600 mt-1.5 text-xs"></i> <span>Bridging knowledge gaps and providing technical/scientific innovations that create measurable impact and improved outcomes.</span></li>
                            <li class="flex items-start gap-2.5"><i class="fas fa-check text-emerald-600 mt-1.5 text-xs"></i> <span>Ensuring communities and systems remain resilient through proper application and dissemination of research for sustainable development.</span></li>
                        </ul>
                    </div>

                    <!-- Our Publications -->
                    <div class="mt-8">
                        <h3 class="text-2xl font-bold text-slate-800 mb-4 font-['Outfit']">Our Publications</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="bg-emerald-50/30 p-6 rounded-2xl border border-emerald-100/50">
                                <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-xl mb-4"><i class="fas fa-book"></i></div>
                                <h4 class="font-bold text-lg text-slate-900 mb-2 font-['Outfit']">IJARI Journal</h4>
                                <p class="text-slate-600 text-sm">A quarterly, double-blind peer-reviewed journal publishing original research and review articles across all major fields of agricultural and allied sciences.</p>
                            </div>
                            <div class="bg-emerald-50/30 p-6 rounded-2xl border border-emerald-100/50">
                                <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-xl mb-4"><i class="fas fa-file-alt"></i></div>
                                <h4 class="font-bold text-lg text-slate-900 mb-2 font-['Outfit']">Farm Science Today</h4>
                                <p class="text-slate-600 text-sm">A monthly open-access e-Magazine presenting scientific knowledge in an accessible format for progressive farmers, students, and researchers.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Membership Info -->
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-3 font-['Outfit']">Membership</h3>
                        <p class="text-slate-600 mb-4">All individuals associated with any scientific community or any other interested citizens can become members of IJARI Research Foundation as per the membership policy and guidelines defined by the advisory board. Professionals engaged and interested in teaching, research, or extension in Agriculture and allied sciences shall be admitted as members after they pay the prescribed fee.</p>
                        <p class="text-slate-600 mb-6">Members shall be entitled to receive the Magazine/Journal of the Foundation free of charge from the year from which subscription is paid, will have rights to vote, and hold an office of the Foundation, provided they have been members for a minimum period of two years prior to the year of election.</p>
                    </div>

                    <!-- Membership Fee Categories -->
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-6 font-['Outfit']">Membership Categories &amp; Fees</h3>
                        <div class="overflow-hidden border border-slate-700/30 rounded-2xl shadow-lg">
                            <table class="w-full text-left border-collapse text-sm">
                                <thead>
                                    <tr class="bg-slate-900 text-white font-semibold">
                                        <th class="py-4 px-6 border-b border-slate-700">Category</th>
                                        <th class="py-4 px-6 border-b border-slate-700">Indian Members (INR)</th>
                                        <th class="py-4 px-6 border-b border-slate-700">Foreign Members (USD)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-slate-900 text-slate-600">
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