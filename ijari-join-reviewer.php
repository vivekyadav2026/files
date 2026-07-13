<?php
$reviewersFile = 'data/reviewers.json';
$msg = '';
$error = '';

function read_json($file) {
    if (!file_exists($file)) return [];
    $data = json_decode(file_get_contents($file), true);
    return is_array($data) ? $data : [];
}

function write_json($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $affiliation = trim($_POST['affiliation'] ?? '');
    $expertise = trim($_POST['expertise'] ?? '');
    
    if (empty($firstName) || empty($lastName) || empty($email) || empty($affiliation) || empty($expertise)) {
        $error = 'All fields are required.';
    } else {
        $cvPath = '';
        if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['cv_file'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, ['pdf', 'doc', 'docx'])) {
                $error = 'Only PDF and Word files (.doc, .docx) are allowed for CV upload.';
            } else {
                $uploadDir = 'uploads/cvs/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $destName = uniqid('cv_', true) . '.' . $ext;
                if (move_uploaded_file($file['tmp_name'], $uploadDir . $destName)) {
                    $cvPath = $uploadDir . $destName;
                } else {
                    $error = 'Failed to save uploaded CV.';
                }
            }
        } else {
            $error = 'CV file upload is required.';
        }
        
        if (empty($error)) {
            $reviewers = read_json($reviewersFile);
            $reviewers[] = [
                'id' => uniqid('rev_', true),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'affiliation' => $affiliation,
                'expertise' => $expertise,
                'cv_path' => $cvPath,
                'status' => 'pending',
                'submitted_at' => time()
            ];
            write_json($reviewersFile, $reviewers);
            $msg = 'Thank you for your interest! Your application to join as a reviewer has been submitted successfully and is currently under review by our editorial board.';
        }
    }
}

include "header.php";
?>

<div class="relative bg-emerald-900 text-white py-12 md:py-16 overflow-hidden border-b border-emerald-800 text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="assets/banner_slide_2.png" alt="Join as Reviewer" class="w-full h-full object-cover object-center opacity-25 scale-105 filter blur-[1px]">
            <div class="absolute inset-0 bg-emerald-900/85"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900 via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="index.php" class="hover:text-white transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                    <li><span class="mx-1 text-slate-500">/</span></li>
                    <li aria-current="page" class="text-white">IJARI > Join as Reviewer</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-white drop-shadow-md">Join as Reviewer</h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto font-light leading-relaxed drop-shadow">Contribute to the scientific community by reviewing for IJARI.</p>
        </div>
    </div>
    
        
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-3xl">
            <?php if (!empty($msg)): ?>
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-5 rounded-2xl mb-10 flex gap-4 items-start shadow-sm">
                    <i class="fas fa-check-circle text-emerald-500 mt-1 text-lg"></i>
                    <p class="text-emerald-800 text-sm leading-relaxed font-semibold"><?php echo htmlspecialchars($msg); ?></p>
                </div>
            <?php endif; ?>
            <?php if (!empty($error)): ?>
                <div class="bg-red-50 border border-red-200 text-red-800 p-5 rounded-2xl mb-10 flex gap-4 items-start shadow-sm">
                    <i class="fas fa-exclamation-circle text-red-500 mt-1 text-lg"></i>
                    <p class="text-red-800 text-sm leading-relaxed font-semibold"><?php echo htmlspecialchars($error); ?></p>
                </div>
            <?php endif; ?>

            <div class="bg-white p-10 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -z-0"></div>
                
                <form action="" method="POST" enctype="multipart/form-data" class="space-y-8 relative z-10">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">First Name <span class="text-red-500">*</span></label>
                            <input type="text" name="first_name" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Last Name <span class="text-red-500">*</span></label>
                            <input type="text" name="last_name" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all">
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Institution / Affiliation <span class="text-red-500">*</span></label>
                        <input type="text" name="affiliation" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Area of Expertise (Keywords) <span class="text-red-500">*</span></label>
                        <input type="text" name="expertise" required placeholder="e.g. Agronomy, Plant Pathology" class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all">
                    </div>
                    
                    <div class="space-y-2 pt-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-3">Upload CV (PDF/Word) <span class="text-red-500">*</span></label>
                        <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 text-center hover:bg-[#f7f9f4] hover:border-emerald-300 transition-colors cursor-pointer relative">
                            <input type="file" name="cv_file" required accept=".pdf,.doc,.docx" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-3xl text-emerald-400 mb-2"></i>
                            <p class="text-sm text-slate-500 font-medium">Click to upload or drag and drop</p>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-slate-900 text-white font-bold py-4 rounded-xl hover:bg-emerald-600 transition-colors shadow-lg mt-4 flex items-center justify-center gap-2 group">
                        Submit Application <i class="fas fa-paper-plane text-sm group-hover:-translate-y-0.5 group-hover:translate-x-0.5 transition-transform"></i>
                    </button>
                </form>
            </div>
        </div>
        
<?php include "footer.php"; ?>