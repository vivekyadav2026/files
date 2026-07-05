
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 pt-12 md:pt-16 pb-8 border-t-[6px] border-emerald-500 relative overflow-hidden">
        <!-- Subtle background decoration -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none opacity-5">
            <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="absolute w-full h-full">
                <path d="M0,0 L100,100 M100,0 L0,100" stroke="white" stroke-width="0.5" />
            </svg>
        </div>
        
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-12 gap-12 mb-16 relative z-10">
            <div class="md:col-span-4">
                <a href="index.php" class="flex items-center gap-4 mb-6">
                    <div class="bg-white p-2 rounded-xl">
                        <img src="assets/Logo.png" alt="IJARI Logo" class="h-10 w-auto">
                    </div>
                    <h2 class="font-bold text-white text-2xl tracking-wide font-['Outfit']">IJARI</h2>
                </a>
                <p class="text-[15px] text-slate-400 leading-relaxed mb-8 pr-4">
                    Advancing scientific knowledge and fostering innovation across diverse fields of agriculture and allied sciences globally through rigorous, open-access publication.
                </p>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center hover:bg-emerald-500 hover:border-emerald-500 hover:text-white transition-all shadow-sm text-slate-400"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="w-10 h-10 rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center hover:bg-emerald-500 hover:border-emerald-500 hover:text-white transition-all shadow-sm text-slate-400"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="w-10 h-10 rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center hover:bg-emerald-500 hover:border-emerald-500 hover:text-white transition-all shadow-sm text-slate-400"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
            
            <div class="md:col-span-4 lg:col-span-3 lg:col-start-6">
                <h3 class="text-white font-semibold text-lg mb-6 font-['Outfit']">Quick Links</h3>
                <ul class="space-y-3.5 text-[15px]">
                    <li><a href="ijari-about.php" class="hover:text-emerald-400 transition-colors flex items-center gap-2 text-slate-400"><i class="fas fa-chevron-right text-[10px] text-emerald-500"></i> About Journal</a></li>
                    <li><a href="ijari-editorial-board.php" class="hover:text-emerald-400 transition-colors flex items-center gap-2 text-slate-400"><i class="fas fa-chevron-right text-[10px] text-emerald-500"></i> Editorial Board</a></li>
                    <li><a href="ijari-instructions.php" class="hover:text-emerald-400 transition-colors flex items-center gap-2 text-slate-400"><i class="fas fa-chevron-right text-[10px] text-emerald-500"></i> Instructions to Author</a></li>
                    <li><a href="ijari-policies-ethics.php" class="hover:text-emerald-400 transition-colors flex items-center gap-2 text-slate-400"><i class="fas fa-chevron-right text-[10px] text-emerald-500"></i> Publication Ethics</a></li>
                    <li><a href="ijari-submit.php" class="hover:text-emerald-400 transition-colors flex items-center gap-2 text-slate-400"><i class="fas fa-chevron-right text-[10px] text-emerald-500"></i> Submit Paper</a></li>
                </ul>
            </div>
            
            <div class="md:col-span-4 lg:col-span-4">
                <h3 class="text-white font-semibold text-lg mb-6 font-['Outfit']">Contact Us</h3>
                <ul class="space-y-4 text-[15px] text-slate-400">
                    <li class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center text-emerald-400 shrink-0 mt-0.5"><i class="fas fa-map-marker-alt"></i></div>
                        <span class="leading-relaxed">Sasroli, Jhajjar,<br>Haryana 124106, India</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center text-emerald-400 shrink-0"><i class="fas fa-phone-alt"></i></div>
                        <a href="tel:+919729848196" class="hover:text-emerald-400 transition-colors">+91 9729848196</a>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center text-emerald-400 shrink-0"><i class="fas fa-envelope"></i></div>
                        <a href="mailto:ijariglobal@gmail.com" class="hover:text-emerald-400 transition-colors">ijariglobal@gmail.com</a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="container mx-auto px-6 border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-slate-500">
            <p>&copy; 2026 International Journal of Agricultural Research and Innovation. All rights reserved.</p>
            <div class="mt-4 md:mt-0 space-x-6">
                <a href="#" class="hover:text-slate-300 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-slate-300 transition-colors">Terms & Conditions</a>
            </div>
        </div>
    </footer>
    <script>
        // Fallback for missing logo
        document.querySelectorAll('.fallback-icon').forEach(img => {
            img.addEventListener('error', function() {
                this.style.display = 'none';
                if(!this.nextElementSibling?.classList.contains('fallback-text')) {
                    const span = document.createElement('div');
                    span.className = 'w-10 h-10 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center font-bold text-lg fallback-text';
                    span.innerHTML = '<i class="fas fa-leaf"></i>';
                    this.parentNode.insertBefore(span, this);
                }
            });
        });
    </script>
</body>
</html>
