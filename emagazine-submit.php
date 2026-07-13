<?php
  $msg = '';
  $error = '';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $authorName = trim($_POST['author_name'] ?? '');
      $institute = trim($_POST['institute'] ?? '');
      $email = trim($_POST['email'] ?? '');
      $phone = trim($_POST['phone'] ?? '');
      $title = trim($_POST['title'] ?? '');
  
      if (empty($authorName) || empty($institute) || empty($email) || empty($phone) || empty($title)) {
          $error = 'All fields marked with an asterisk (*) are required.';
      } elseif (!isset($_FILES['article_file']) || $_FILES['article_file']['error'] !== UPLOAD_ERR_OK) {
          $error = 'Please upload a valid article file.';
      } else {
          $file = $_FILES['article_file'];
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
                      'type' => 'magazine',
                      'author_name' => $authorName,
                      'institute' => $institute,
                      'email' => $email,
                      'phone' => $phone,
                      'title' => $title,
                      'abstract' => 'Popular/Technical article for e-Magazine.',
                      'file_path' => 'uploads/' . $fileName,
                      'status' => 'pending',
                      'submitted_at' => time()
                  ];
                  if (!file_exists('data')) { mkdir('data', 0777, true); }
                  file_put_contents($submissionsFile, json_encode($submissions, JSON_PRETTY_PRINT));
                  $msg = 'Article submitted successfully! The editorial team will review it and publish it in the upcoming issue.';
              } else {
                  $error = 'Failed to save the uploaded file. Please try again.';
              }
          }
      }
  }
  
include "header.php";
?>

  <div class="relative bg-emerald-900 text-white py-12 md:py-16 overflow-hidden border-b border-emerald-800 text-center">
          <div class="absolute inset-0 z-0 pointer-events-none">
              <img src="assets/banner_slide_2.png" alt="Submit Article" class="w-full h-full object-cover object-center opacity-25 scale-105 filter blur-[1px]">
              <div class="absolute inset-0 bg-emerald-900/85"></div>
          </div>
          
          <div class="container mx-auto px-6 relative z-10">
              <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-white drop-shadow-md">Submit Article</h1>
          </div>
      </div>
      
          <div class="container mx-auto px-6 py-10 md:py-16 max-w-4xl">
              <?php if (!empty($msg)): ?>
                  <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-5 rounded mb-8 flex gap-4 items-start">
                      <p class="text-emerald-800 text-sm font-semibold"><?php echo htmlspecialchars($msg); ?></p>
                  </div>
              <?php endif; ?>
              <?php if (!empty($error)): ?>
                  <div class="bg-red-50 border border-red-200 text-red-800 p-5 rounded mb-8 flex gap-4 items-start">
                      <p class="text-red-800 text-sm font-semibold"><?php echo htmlspecialchars($error); ?></p>
                  </div>
              <?php endif; ?>
              
              <div class="mb-8 border border-slate-200 p-4">
                  <p class="text-slate-800 text-[15px] leading-relaxed">
                      <strong>Please read the guidelines before submitting.</strong> If your article is rejected for any reason (according to the author's guidelines), you will be informed. If you do not receive any email, your article will be published in the next upcoming issue according to your submission."
                  </p>
              </div>

              <div class="bg-white">
                  <h2 class="text-xl font-bold text-black mb-6 font-sans">Submission Process:</h2>
                  
                  <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                      
                      <div class="space-y-1">
                          <label class="block text-sm text-gray-500 italic font-semibold">Author's Name <span class="text-red-500">*</span></label>
                          <input type="text" name="author_name" required class="w-full bg-[#f1f1f1] border border-gray-300 px-3 py-2 focus:outline-none focus:border-gray-400">
                      </div>

                      <div class="space-y-1">
                          <label class="block text-sm text-gray-500 italic font-semibold">University/Institute/College <span class="text-red-500">*</span></label>
                          <input type="text" name="institute" required class="w-full bg-[#f1f1f1] border border-gray-300 px-3 py-2 focus:outline-none focus:border-gray-400">
                      </div>

                      <div class="space-y-1">
                          <label class="block text-sm text-gray-500 italic font-semibold">Email Address <span class="text-red-500">*</span></label>
                          <input type="email" name="email" required class="w-full bg-[#f1f1f1] border border-gray-300 px-3 py-2 focus:outline-none focus:border-gray-400">
                      </div>

                      <div class="space-y-1">
                          <label class="block text-sm text-gray-500 italic font-semibold">Phone <span class="text-red-500">*</span></label>
                          <input type="text" name="phone" required class="w-full bg-[#f1f1f1] border border-gray-300 px-3 py-2 focus:outline-none focus:border-gray-400">
                      </div>

                      <div class="space-y-1">
                          <label class="block text-sm text-gray-500 italic font-semibold">Title of Article <span class="text-red-500">*</span></label>
                          <input type="text" name="title" required class="w-full bg-[#f1f1f1] border border-gray-300 px-3 py-2 focus:outline-none focus:border-gray-400">
                      </div>

                      <div class="space-y-1 pt-2">
                          <label class="block text-sm text-gray-500 italic font-semibold mb-2">Extended Summary (Doc/Docx File Only Upto 10 MB) <span class="text-red-500">*</span></label>
                          <div class="flex items-center gap-4">
                              <input type="file" name="article_file" required accept=".doc,.docx" id="file-upload" class="hidden">
                              <label for="file-upload" class="bg-[#2ebfa5] text-white px-4 py-2 font-semibold cursor-pointer text-sm shadow-sm hover:bg-[#28a892] transition-colors">Choose File</label>
                              <span class="text-gray-500 text-sm italic" id="file-name">No file chosen</span>
                          </div>
                          <script>
                              document.getElementById('file-upload').addEventListener('change', function() {
                                  document.getElementById('file-name').textContent = this.files[0] ? this.files[0].name : 'No file chosen';
                              });
                          </script>
                      </div>

                      <div class="space-y-1 pt-4">
                          <label class="block text-sm text-gray-500 italic font-semibold mb-3">Declaration by Authors <span class="text-red-500">*</span></label>
                          <div class="flex items-start gap-3 pl-8">
                              <input type="checkbox" required class="mt-1 cursor-pointer">
                              <span class="text-[13px] text-black font-semibold italic leading-relaxed">
                                  It is certified that the popular article contains unpublished work and & not submitted elsewhere for publication. We confirm that authors have read understan...
                              </span>
                          </div>
                      </div>

                      <div class="pt-6">
                          <button type="submit" class="bg-gray-800 text-white px-8 py-2 font-bold uppercase text-sm hover:bg-black transition-colors">Submit Form</button>
                      </div>

                  </form>
              </div>
          </div>
          
<?php include "footer.php"; ?>