<?php
$msg = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        $messagesFile = 'data/messages.json';
        $messages = [];
        if (file_exists($messagesFile)) {
            $messages = json_decode(file_get_contents($messagesFile), true);
            if (!is_array($messages)) $messages = [];
        }
        $messages[] = [
            'id' => uniqid('msg_', true),
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
            'submitted_at' => time()
        ];
        file_put_contents($messagesFile, json_encode($messages, JSON_PRETTY_PRINT));
        $msg = 'Thank you! Your message has been sent successfully. We will get back to you shortly.';
    }
}
?><?php include 'header.php'; ?>

        
    <div class="relative bg-emerald-900 text-white py-12 md:py-16 overflow-hidden border-b border-emerald-800 text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="assets/banner_slide_2.png" alt="Contact Us" class="w-full h-full object-cover object-center opacity-25 scale-105 filter blur-[1px]">
            <div class="absolute inset-0 bg-emerald-900/85"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900 via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-center mb-6 text-sm font-semibold text-emerald-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="index.php" class="hover:text-white transition-colors flex items-center gap-1.5"><i class="fas fa-home text-xs"></i> Home</a></li>
                    <li><span class="mx-1 text-slate-500">/</span></li>
                    <li aria-current="page" class="text-white">Contact Us</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-['Outfit'] tracking-tight text-white drop-shadow-md">Contact Us</h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto font-light leading-relaxed drop-shadow">Have questions? Get in touch with our editorial and support teams.</p>
        </div>
    </div>
    
        
        <div class="container mx-auto px-6 py-10 md:py-16 max-w-5xl">
            <div class="grid md:grid-cols-12 gap-8 items-start">
                
                <!-- Left Column: Contact info -->
                <div class="md:col-span-5 space-y-6">
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-6 text-left">
                        <h3 class="text-xl font-bold text-slate-800 font-['Outfit'] border-b border-slate-50 pb-2 mb-4">Contact Information</h3>
                        
                        <!-- Address -->
                        <div class="flex gap-4 items-start">
                            <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center shrink-0 text-base"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <h4 class="font-semibold text-slate-700 text-sm">Office Address</h4>
                                <p class="text-slate-500 text-sm mt-1 leading-relaxed">Sasroli, Jhajjar,<br>Haryana, 124106</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex gap-4 items-start">
                            <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center shrink-0 text-base"><i class="fas fa-phone-alt"></i></div>
                            <div>
                                <h4 class="font-semibold text-slate-700 text-sm">Call/WhatsApp</h4>
                                <p class="text-slate-500 text-sm mt-1 leading-relaxed">+91 9729848196</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex gap-4 items-start">
                            <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center shrink-0 text-base"><i class="fas fa-envelope"></i></div>
                            <div>
                                <h4 class="font-semibold text-slate-700 text-sm">Email Address</h4>
                                <p class="text-slate-500 text-sm mt-1 leading-relaxed"><a href="mailto:ijariglobal@gmail.com" class="hover:underline text-emerald-600">ijariglobal@gmail.com</a></p>
                            </div>
                        </div>
                    </div>

                    <!-- Map Card -->
                    <div class="bg-white rounded-3xl p-4 shadow-sm border border-slate-100">
                        <div class="w-full h-48 rounded-2xl overflow-hidden border border-slate-100 relative">
                            <div class="absolute inset-0 bg-[#f7f9f4] flex flex-col items-center justify-center text-slate-400 p-4 text-center">
                                <i class="fas fa-map-marked-alt text-3xl text-emerald-500 mb-2"></i>
                                <span class="text-xs font-semibold text-slate-700">Sasroli, Jhajjar, Haryana</span>
                                <span class="text-[10px] text-slate-400 mt-1">Latitude: 28.5305, Longitude: 76.6712</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Contact form -->
                <div class="md:col-span-7">
                    <?php if (!empty($msg)): ?>
                        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-5 rounded-2xl mb-6 flex gap-3 items-center shadow-sm">
                            <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                            <span class="text-sm font-semibold"><?php echo htmlspecialchars($msg); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($error)): ?>
                        <div class="bg-red-50 border border-red-200 text-red-800 p-5 rounded-2xl mb-6 flex gap-3 items-center shadow-sm">
                            <i class="fas fa-exclamation-circle text-red-500 text-lg"></i>
                            <span class="text-sm font-semibold"><?php echo htmlspecialchars($error); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="bg-white p-8 md:p-10 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 text-left">
                        <h3 class="text-xl font-bold text-slate-800 font-['Outfit'] border-b border-slate-50 pb-2 mb-6">Send an Inquiry</h3>
                        
                        <form action="" method="POST" class="space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-slate-700">Your Name *</label>
                                    <input type="text" name="name" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-slate-700">Email Address *</label>
                                    <input type="email" name="email" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700">Subject *</label>
                                <input type="text" name="subject" required class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700">Message *</label>
                                <textarea name="message" required rows="5" class="w-full bg-[#f7f9f4] border border-slate-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all resize-none text-sm"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-3.5 rounded-xl hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-600/20 text-sm flex items-center justify-center gap-2">
                                Send Message <i class="fas fa-paper-plane text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        
<?php include 'footer.php'; ?>