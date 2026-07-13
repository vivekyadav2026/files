<?php
$msg = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $title = trim($_POST['title'] ?? '');
    $abstract = trim($_POST['abstract'] ?? '');

    if (empty($firstName) || empty($lastName) || empty($email) || empty($title) || empty($abstract)) {
        $error = 'All fields marked with an asterisk (*) are required.';
    } elseif (!isset($_FILES['manuscript_file']) || $_FILES['manuscript_file']['error'] !== UPLOAD_ERR_OK) {
        $error = 'Please upload a valid manuscript file.';
    } else {
        $file = $_FILES['manuscript_file'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['doc', 'docx'])) {
            $error = 'Only Microsoft Word (.doc, .docx) formats are supported.';
        } else {
            $uploadDir = 'uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $fileName = uniqid('sub_', true) . '.' . $ext;
            $destPath = $uploadDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $destPath)) {
                $submissionsFile = 'data/submissions.json';
                $submissions = [];
                if (file_exists($submissionsFile)) {
                    $submissions = json_decode(file_get_contents($submissionsFile), true);
                    if (!is_array($submissions)) $submissions = [];
                }
                
                $submissions[] = [
                    'id' => uniqid('sub_id_', true),
                    'type' => 'journal',
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $email,
                    'title' => $title,
                    'abstract' => $abstract,
                    'file_path' => 'uploads/' . $fileName,
                    'status' => 'pending',
                    'submitted_at' => time()
                ];
                file_put_contents($submissionsFile, json_encode($submissions, JSON_PRETTY_PRINT));
                $msg = 'Manuscript submitted successfully! The editorial board will review it and contact you shortly.';
            } else {
                $error = 'Failed to save the uploaded file. Please try again.';
            }
        }
    }
}

include "header.php";
?>

<div class="relative bg-emerald-900 text-white py-12 md:py-16 overflow-hidden border-b border-emerald-800 text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="assets/banner_slide_2.png" alt="Submit Manuscript Online" class="w-full h-full object-cover object-center opacity-25 scale-105 filter blur-[1px]">
            <div class="absolute inset-0 bg-emerald-900/85"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900 via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="index.php" class="hover:text-white transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                    <li><span class="mx-1 text-slate-500">/</span></li>
                    <li aria-current="page" class="text-white">IJARI > Submit Paper</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-white drop-shadow-md">Submit Manuscript Online</h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto font-light leading-relaxed drop-shadow">Upload your manuscript for peer review. Fast, secure, and simple.</p>
        </div>
    </div>
    
        
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-4xl">
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

            <div class="bg-emerald-50 border border-emerald-100 p-5 rounded-2xl mb-10 flex gap-4 items-start shadow-sm">
                <i class="fas fa-info-circle text-emerald-500 mt-1 text-lg"></i>
                <p class="text-emerald-800 text-sm leading-relaxed">
                    <strong>Note on Fees:</strong> There are no charges to submit a manuscript. An Article Processing Charge (APC) of ₹1000 is only payable <em>after</em> a manuscript has successfully passed peer review and has been accepted for publication.
                </p>
            </div>

            <div class="bg-white p-10 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100">
                <form action="" method="POST" enctype="multipart/form-data" class="space-y-10">
                    
                    <!-- Section 1 -->
                    <div>
                        <div class="flex items-center gap-3 mb-6 border-b border-slate-100 pb-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 font-bold flex items-center justify-center font-['Outfit']">1</div>
                            <h3 class="text-xl font-bold text-slate-800 font-['Outfit']">Corresponding Author Details</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700">First Name <span class="text-red-500">*</span></label>
                                <input type="text" name="first_name" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700">Last Name <span class="text-red-500">*</span></label>
                                <input type="text" name="last_name" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" name="email" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all">
                        </div>
                    </div>
                    
                    <!-- Section 2 -->
                    <div>
                        <div class="flex items-center gap-3 mb-6 border-b border-slate-100 pb-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 font-bold flex items-center justify-center font-['Outfit']">2</div>
                            <h3 class="text-xl font-bold text-slate-800 font-['Outfit']">Manuscript Information</h3>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700">Manuscript Title <span class="text-red-500">*</span></label>
                                <input type="text" name="title" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all">
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700">Abstract <span class="text-slate-400 font-normal">(Max 250 words)</span> <span class="text-red-500">*</span></label>
                                <textarea name="abstract" required rows="5" class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all resize-none"></textarea>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-3">Upload Manuscript (.doc / .docx) <span class="text-red-500">*</span></label>
                                <div class="border-2 border-dashed border-emerald-200 bg-emerald-50/30 rounded-xl p-8 text-center hover:bg-emerald-50 hover:border-emerald-400 transition-colors cursor-pointer relative">
                                    <input type="file" name="manuscript_file" required accept=".doc,.docx" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                    <i class="fas fa-file-word text-4xl text-emerald-400 mb-3"></i>
                                    <p class="text-slate-700 font-medium mb-1">Select Manuscript File</p>
                                    <p class="text-xs text-slate-500">Ensure author names are included in the file.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Section 3 -->
                    <div class="bg-[#f7f9f4] p-6 rounded-2xl border border-slate-200">
                        <label class="flex items-start gap-4 cursor-pointer group">
                            <div class="mt-1 relative flex items-center justify-center">
                                <input type="checkbox" required class="peer appearance-none w-5 h-5 border-2 border-slate-300 rounded focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1 checked:bg-emerald-500 checked:border-emerald-500 transition-all cursor-pointer">
                                <i class="fas fa-check absolute text-white text-xs opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity"></i>
                            </div>
                            <span class="text-sm text-slate-700 leading-relaxed group-hover:text-slate-900 transition-colors">
                                <strong>Declaration:</strong> I declare that this manuscript is original, has not been published before, and is not currently being considered for publication elsewhere. I agree to the <a href="ijari-plagiarism-policy.php" class="text-emerald-600 hover:underline" target="_blank">Plagiarism Policy</a>.
                            </span>
                        </label>
                    </div>
                    
                    <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-xl hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-600/20 text-lg flex items-center justify-center gap-3">
                        Submit Manuscript <i class="fas fa-cloud-upload-alt"></i>
                    </button>
                </form>
            </div>
        </div>
        
<?php include "footer.php"; ?>