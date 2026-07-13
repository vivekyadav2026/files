<?php
$msg = '';
  if (isset($_GET['success']) && $_GET['success'] == 1) {
      $msg = 'Form submitted successfully! We will get back to you shortly.';
  }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payer_name = trim($_POST['payer_name'] ?? '');
    $transaction_id = trim($_POST['transaction_id'] ?? '');
    $amount = trim($_POST['amount'] ?? '');
    $payment_for = trim($_POST['payment_for'] ?? '');
    
    if (empty($payer_name) || empty($transaction_id) || empty($amount) || empty($payment_for)) {
        $error = 'Please fill all the required fields.';
    } else {
        $receiptPath = '';
        if (isset($_FILES['receipt_file']) && $_FILES['receipt_file']['error'] === UPLOAD_ERR_OK) {
            $fileObj = $_FILES['receipt_file'];
            $ext = strtolower(pathinfo($fileObj['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'pdf'])) {
                $error = 'Only JPG, PNG, and PDF files are allowed for the receipt.';
            } else {
                $uploadDir = 'uploads/receipts/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $destName = uniqid('receipt_', true) . '.' . $ext;
                if (move_uploaded_file($fileObj['tmp_name'], $uploadDir . $destName)) {
                    $receiptPath = $uploadDir . $destName;
                } else {
                    $error = 'Failed to save the receipt screenshot.';
                }
            }
        }
        
        if (empty($error)) {
            $paymentsFile = 'data/payments.json';
            $payments = [];
            if (file_exists($paymentsFile)) {
                $payments = json_decode(file_get_contents($paymentsFile), true);
                if (!is_array($payments)) $payments = [];
            }
            
            $payments[] = [
                'id' => uniqid('pay_', true),
                'payer_name' => $payer_name,
                'transaction_id' => $transaction_id,
                'amount' => $amount,
                'payment_for' => $payment_for,
                'receipt_path' => $receiptPath,
                'status' => 'pending',
                'submitted_at' => time()
            ];
            
            if (!file_exists('data')) { mkdir('data', 0777, true); }
            file_put_contents($paymentsFile, json_encode($payments, JSON_PRETTY_PRINT));
            $msg = 'Thank you! Your payment confirmation has been submitted and is under review.';
        }
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
                    <i class="fas fa-home"></i> IJARI > Payment
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight tracking-tight font-['Outfit']">
                    Payment Details
                </h1>
                <p class="text-lg md:text-xl text-slate-300 leading-relaxed max-w-2xl font-light">
                    Secure and simple payment options for IJARI processing fees.
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
    
        
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-6xl">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Payment Information -->
                <div class="space-y-8">
                    <h2 class="text-3xl font-bold text-slate-800 font-['Outfit']">Our Bank Details</h2>
                    <p class="text-slate-600 leading-relaxed text-lg">Please use the details below to transfer the Article Processing Charge (APC) or Society Membership fee. After making the payment, kindly fill out the confirmation form.</p>
                    
                    <!-- Bank Card -->
                    <div class="bg-gradient-to-br from-emerald-800 to-emerald-950 p-8 rounded-3xl shadow-xl shadow-emerald-900/20 text-white relative overflow-hidden group">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/5 rounded-full blur-2xl group-hover:bg-white/10 transition-colors"></div>
                        <i class="fas fa-university text-5xl text-emerald-500/20 absolute right-8 bottom-8"></i>
                        
                        <h3 class="text-xl font-semibold mb-6 border-b border-emerald-700/50 pb-4">Bank Transfer Details</h3>
                        <div class="space-y-4">
                            <div class="flex flex-col">
                                <span class="text-emerald-400/80 text-xs uppercase tracking-wider font-bold mb-1">Account Name</span>
                                <span class="font-bold text-xl tracking-wide">Mohit Kumar</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-emerald-400/80 text-xs uppercase tracking-wider font-bold mb-1">Account Number</span>
                                <span class="font-mono text-xl tracking-wider">9729848196</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-emerald-400/80 text-xs uppercase tracking-wider font-bold mb-1">IFSC Code</span>
                                <span class="font-mono text-xl tracking-wider text-amber-300">AIRP0000001</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- UPI Mockup -->
                    <div class="bg-white border border-slate-100 p-8 rounded-3xl shadow-lg flex flex-col sm:flex-row items-center gap-8 justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-2 font-['Outfit']">UPI Payment</h3>
                            <p class="text-sm text-slate-500 mb-4">Scan the QR code or use the UPI ID below to pay via any UPI app (GPay, PhonePe, Paytm, etc.).</p>
                            <div class="inline-flex items-center gap-3 bg-slate-50 px-4 py-2 rounded-xl border border-slate-200">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/UPI-Logo-vector.svg" alt="UPI" class="h-5">
                                <span class="font-mono font-bold text-slate-700 select-all">9729848196@pthdfc</span>
                            </div>
                        </div>
                        <div class="shrink-0 bg-white p-2 rounded-2xl border-4 border-slate-100 shadow-sm relative group overflow-hidden">
                            <img src="assets/upi_qr.jpg" alt="UPI QR Code" class="w-40 h-auto rounded-xl object-contain hover:scale-105 transition-transform duration-300">
                        </div>
                    </div>
                </div>

                <!-- Payment Confirmation Form -->
                <div>
                    <?php if (!empty($msg)): ?>
                        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-5 rounded-2xl mb-6 flex gap-4 items-start shadow-sm">
                            <i class="fas fa-check-circle text-emerald-500 mt-1"></i>
                            <p class="text-sm font-semibold"><?php echo htmlspecialchars($msg); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($error)): ?>
                        <div class="bg-red-50 border border-red-200 text-red-800 p-5 rounded-2xl mb-6 flex gap-4 items-start shadow-sm">
                            <i class="fas fa-exclamation-circle text-red-500 mt-1"></i>
                            <p class="text-sm font-semibold"><?php echo htmlspecialchars($error); ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="bg-white p-8 md:p-10 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100">
                        <div class="flex items-center gap-3 mb-6 border-b border-slate-100 pb-4">
                            <i class="fas fa-file-invoice-dollar text-2xl text-emerald-500"></i>
                            <h3 class="text-2xl font-bold text-slate-800 font-['Outfit']">Submit Payment Proof</h3>
                        </div>
                        
                        <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700">Payer Name *</label>
                                <input type="text" name="payer_name" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-slate-700">Amount (₹) *</label>
                                    <input type="number" name="amount" required placeholder="e.g. 1000" class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-slate-700">Payment For *</label>
                                    <select name="payment_for" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                                        <option value="">Select Purpose</option>
                                        <option value="Journal APC">Journal APC (₹1000)</option>
                                        <option value="Magazine APC">Magazine APC (₹200)</option>
                                        <option value="Society Membership">Society Membership</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700">Transaction ID / UPI Ref No. *</label>
                                <input type="text" name="transaction_id" required class="w-full bg-emerald-50/50 border border-emerald-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                            </div>

                            <div class="space-y-2 pt-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-3">Upload Screenshot / Receipt *</label>
                                <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 text-center hover:bg-[#f7f9f4] hover:border-emerald-300 transition-colors cursor-pointer relative bg-[#f7f9f4]/50">
                                    <input type="file" name="receipt_file" required accept=".jpg,.jpeg,.png,.pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                    <i class="fas fa-image text-3xl text-slate-400 mb-2"></i>
                                    <p class="text-sm text-slate-500 font-medium">Click or drag receipt here</p>
                                    <p class="text-xs text-slate-400 mt-1">JPG, PNG, PDF up to 2MB</p>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-slate-900 text-white font-bold py-4 rounded-xl hover:bg-emerald-600 transition-colors shadow-lg shadow-slate-900/20 text-sm flex items-center justify-center gap-2 mt-4">
                                Confirm Payment <i class="fas fa-check-circle"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
<?php include "footer.php"; ?>