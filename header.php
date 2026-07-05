<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IJARI | International Journal of Agricultural Research and Innovation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap');
        
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .nav-text { font-family: 'Outfit', sans-serif; }
        
        .nav-link { position: relative; }
        .nav-link::after {
            content: ''; position: absolute; width: 100%; transform: scaleX(0); height: 2px; bottom: -4px; left: 0; background-color: #10b981; transform-origin: bottom right; transition: transform 0.3s ease-out;
        }
        .nav-link:hover::after { transform: scaleX(1); transform-origin: bottom left; }
        
        /* Modern Dropdown */
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .glass-nav { 
            background: rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(12px); 
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        /* Slider Styles */
        .slider-wrapper { position: relative; overflow: hidden; width: 100%; height: 100%; }
        .slides { display: flex; transition: transform 0.7s cubic-bezier(0.25, 1, 0.5, 1); height: 100%; }
        .slide { min-width: 100%; height: 100%; position: relative; }
        .slide img { width: 100%; height: 100%; object-fit: cover; }
        .slide-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.7) 50%, rgba(15, 23, 42, 0.9) 100%); }
        @media (min-width: 1024px) {
            .slide-overlay { background: linear-gradient(to right, rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.4)); }
        }
        
        /* Premium Hero Pattern */
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-slate-50 flex flex-col min-h-screen text-slate-800 antialiased selection:bg-emerald-200 selection:text-emerald-900">

    <!-- Header -->
    <header class="sticky top-0 z-50 glass-nav shadow-sm">
        <div class="h-1 bg-gradient-to-r from-emerald-400 via-teal-300 to-emerald-500 w-full"></div>
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="index.php" class="flex items-center gap-4 group">
                <div class="relative w-14 h-14 rounded-xl overflow-hidden bg-white shadow-md border-2 border-emerald-400 flex items-center justify-center transition-transform group-hover:scale-105 group-hover:border-emerald-500">
                    <img src="assets/Logo.png" alt="IJARI Logo" class="h-10 w-auto object-contain fallback-icon">
                </div>
                <div>
                    <h1 class="font-bold text-emerald-900 text-base md:text-lg leading-tight uppercase hidden md:block tracking-wide">International Journal of Agricultural<br>Research & Innovation</h1>
                    <h1 class="font-bold text-emerald-900 text-2xl md:hidden tracking-wider">IJARI</h1>
                </div>
            </a>
            
            <nav class="hidden lg:flex items-center gap-8 font-medium text-[15px] text-slate-600 nav-text">
                <a href="index.php" class="hover:text-emerald-600 nav-link transition-colors">Home</a>
                <a href="about.php" class="hover:text-emerald-600 nav-link transition-colors">About</a>
                
                <!-- IJARI Dropdown -->
                <div class="relative group dropdown py-4 -my-4">
                    <button class="hover:text-emerald-600 flex items-center gap-1.5 transition-colors nav-link">
                        Journal <i class="fas fa-chevron-down text-[10px] opacity-70 mt-1"></i>
                    </button>
                    <div class="absolute left-0 top-full w-[36rem] bg-white rounded-2xl shadow-2xl border border-slate-100 p-6 dropdown-menu z-50">
                        <div class="grid grid-cols-2 gap-6">
                            <!-- Column 1: Info & Archive -->
                            <div>
                                <div class="px-3 py-1 mb-2 border-b border-slate-50">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Information</span>
                                </div>
                                <div class="space-y-1">
                                    <a href="ijari-about.php" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-emerald-600 transition-colors text-sm">
                                        <i class="fas fa-info-circle text-slate-400 w-4"></i> About Journal
                                    </a>
                                    <a href="ijari-editorial-board.php" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-emerald-600 transition-colors text-sm">
                                        <i class="fas fa-users text-slate-400 w-4"></i> Editorial Board
                                    </a>
                                    <a href="ijari-archives.php" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-emerald-600 transition-colors text-sm">
                                        <i class="fas fa-archive text-slate-400 w-4"></i> Archives
                                    </a>
                                    <a href="ijari-current-issues.php" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-emerald-600 transition-colors text-sm">
                                        <i class="fas fa-book-open text-slate-400 w-4"></i> Current Issues
                                    </a>
                                </div>
                            </div>
                            <!-- Column 2: Guidelines & Policies -->
                            <div>
                                <div class="px-3 py-1 mb-2 border-b border-slate-50">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Guidelines</span>
                                </div>
                                <div class="space-y-1">
                                    <a href="ijari-instructions.php" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-emerald-600 transition-colors text-sm">
                                        <i class="fas fa-file-alt text-slate-400 w-4"></i> Instructions to Author
                                    </a>
                                    <a href="ijari-policies-ethics.php" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-emerald-600 transition-colors text-sm">
                                        <i class="fas fa-balance-scale text-slate-400 w-4"></i> Policies & Ethics
                                    </a>
                                    <a href="ijari-plagiarism-policy.php" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-emerald-600 transition-colors text-sm">
                                        <i class="fas fa-copy text-slate-400 w-4"></i> Plagiarism Policy
                                    </a>
                                    <a href="ijari-peer-review.php" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-emerald-600 transition-colors text-sm">
                                        <i class="fas fa-eye text-slate-400 w-4"></i> Peer Review Process
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-50 bg-emerald-50/50 -mx-6 -mb-6 p-4 rounded-b-2xl grid grid-cols-2 gap-4">
                            <a href="ijari-join-reviewer.php" class="flex items-center justify-center gap-2 px-4 py-2 bg-white border border-emerald-100 rounded-xl text-emerald-700 hover:bg-emerald-50 transition-colors text-sm font-semibold shadow-sm">
                                <i class="fas fa-user-plus"></i> Join as Reviewer
                            </a>
                            <a href="ijari-submit.php" class="flex items-center justify-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-colors text-sm shadow-sm">
                                <i class="fas fa-paper-plane"></i> Submit Paper
                            </a>
                        </div>
                    </div>
                </div>

                <a href="society.php" class="hover:text-emerald-600 nav-link transition-colors">Society</a>

                <!-- e-Magazine Dropdown -->
                <div class="relative group dropdown py-4 -my-4">
                    <button class="hover:text-emerald-600 flex items-center gap-1.5 transition-colors nav-link">
                        Farm Science Today <i class="fas fa-chevron-down text-[10px] opacity-70 mt-1"></i>
                    </button>
                    <div class="absolute left-0 top-full w-64 bg-white rounded-2xl shadow-2xl border border-slate-100 py-3 dropdown-menu z-50">
                        <a href="emagazine-about.php" class="flex items-center gap-3 px-5 py-2.5 hover:bg-slate-50 hover:text-emerald-600 transition-colors">
                            <i class="fas fa-info-circle text-slate-400 w-4"></i> About Magazine
                        </a>
                        <a href="emagazine-guidelines.php" class="flex items-center gap-3 px-5 py-2.5 hover:bg-slate-50 hover:text-emerald-600 transition-colors">
                            <i class="fas fa-list-ul text-slate-400 w-4"></i> Submission Guidelines
                        </a>
                        <a href="emagazine-archives.php" class="flex items-center gap-3 px-5 py-2.5 hover:bg-slate-50 hover:text-emerald-600 transition-colors">
                            <i class="fas fa-archive text-slate-400 w-4"></i> Archives
                        </a>
                        <div class="mt-2 pt-2 border-t border-slate-50 bg-emerald-50/50">
                            <a href="emagazine-submit.php" class="flex items-center gap-3 px-5 py-2.5 text-emerald-700 font-semibold hover:bg-emerald-100/50 transition-colors">
                                <i class="fas fa-paper-plane w-4"></i> Submit Article
                            </a>
                        </div>
                    </div>
                </div>
                
                <a href="contact.php" class="hover:text-emerald-600 nav-link transition-colors">Contact Us</a>
            </nav>
            
            <a href="ijari-submit.php" class="hidden lg:inline-flex bg-emerald-600 text-white px-6 py-2.5 rounded-full font-semibold hover:bg-emerald-700 transition-all shadow-[0_4px_14px_0_rgba(16,185,129,0.39)] hover:shadow-[0_6px_20px_rgba(16,185,129,0.23)] hover:-translate-y-0.5 items-center gap-2 nav-text">
                Submit <i class="fas fa-arrow-right text-sm"></i>
            </a>
            
            <!-- Mobile Menu Button -->
            <button onclick="toggleMobileMenu()" class="lg:hidden text-slate-600 hover:text-emerald-600 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Menu Drawer -->
    <div id="mobile-menu" onclick="toggleMobileMenu()" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div class="absolute right-0 top-0 bottom-0 w-80 bg-white shadow-2xl p-6 flex flex-col justify-between transform translate-x-full transition-transform duration-300 ease-out" id="mobile-menu-drawer" onclick="event.stopPropagation()">
            <div class="overflow-y-auto pr-2 flex-grow min-h-0">
                <div class="flex justify-between items-center mb-6">
                    <span class="font-bold text-emerald-900 text-lg uppercase tracking-wide font-['Outfit']">Navigation Menu</span>
                    <button onclick="toggleMobileMenu()" class="text-slate-600 hover:text-emerald-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <nav class="flex flex-col gap-1 text-base font-semibold text-slate-700 font-['Outfit']">
                    <a href="index.php" class="hover:text-emerald-600 transition-colors py-2 border-b border-slate-100">Home</a>
                    <a href="about.php" class="hover:text-emerald-600 transition-colors py-2 border-b border-slate-100">About Us</a>
                    
                    <div class="border-b border-slate-100 py-1.5">
                        <button onclick="toggleSubmenu('submenu-journal', 'chevron-journal')" class="w-full flex justify-between items-center text-left py-2 hover:text-emerald-600 transition-colors focus:outline-none">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider font-['Outfit']">IJARI Journal</span>
                            <i id="chevron-journal" class="fas fa-chevron-down text-xs text-slate-400 transition-transform duration-200"></i>
                        </button>
                        <div id="submenu-journal" class="hidden pl-3 pb-2 pt-1 space-y-2 text-sm font-medium text-slate-600">
                            <a href="ijari-about.php" class="block hover:text-emerald-600 py-1 transition-colors">About Journal</a>
                            <a href="ijari-editorial-board.php" class="block hover:text-emerald-600 py-1 transition-colors">Editorial Board</a>
                            <a href="ijari-archives.php" class="block hover:text-emerald-600 py-1 transition-colors">Archives</a>
                            <a href="ijari-current-issues.php" class="block hover:text-emerald-600 py-1 transition-colors">Current Issues</a>
                            <a href="ijari-instructions.php" class="block hover:text-emerald-600 py-1 transition-colors">Instructions to Author</a>
                            <a href="ijari-policies-ethics.php" class="block hover:text-emerald-600 py-1 transition-colors">Policies & Ethics</a>
                            <a href="ijari-plagiarism-policy.php" class="block hover:text-emerald-600 py-1 transition-colors">Plagiarism Policy</a>
                            <a href="ijari-peer-review.php" class="block hover:text-emerald-600 py-1 transition-colors">Peer Review Process</a>
                        </div>
                    </div>

                    <a href="society.php" class="hover:text-emerald-600 transition-colors py-2 border-b border-slate-100">Society</a>

                    <div class="border-b border-slate-100 py-1.5">
                        <button onclick="toggleSubmenu('submenu-magazine', 'chevron-magazine')" class="w-full flex justify-between items-center text-left py-2 hover:text-emerald-600 transition-colors focus:outline-none">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider font-['Outfit']">Farm Science Today</span>
                            <i id="chevron-magazine" class="fas fa-chevron-down text-xs text-slate-400 transition-transform duration-200"></i>
                        </button>
                        <div id="submenu-magazine" class="hidden pl-3 pb-2 pt-1 space-y-2 text-sm font-medium text-slate-600">
                            <a href="emagazine-about.php" class="block hover:text-emerald-600 py-1 transition-colors">About Magazine</a>
                            <a href="emagazine-guidelines.php" class="block hover:text-emerald-600 py-1 transition-colors">Submission Guidelines</a>
                            <a href="emagazine-archives.php" class="block hover:text-emerald-600 py-1 transition-colors">Archives</a>
                        </div>
                    </div>
                    
                    <a href="contact.php" class="hover:text-emerald-600 transition-colors py-2 border-b border-slate-100 block">Contact Us</a>
                </nav>
            </div>
            
            <div class="pt-4 border-t border-slate-100 space-y-3 shrink-0">
                <a href="ijari-submit.php" class="block w-full text-center bg-emerald-600 text-white py-3 rounded-xl font-bold hover:bg-emerald-700 transition-colors shadow-md text-sm">
                    Submit Paper
                </a>
                <a href="emagazine-submit.php" class="block w-full text-center bg-slate-900 text-white py-3 rounded-xl font-bold hover:bg-slate-800 transition-colors text-sm">
                    Submit Article
                </a>
            </div>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const drawer = document.getElementById('mobile-menu-drawer');
            if (menu.classList.contains('opacity-0')) {
                menu.classList.remove('opacity-0', 'pointer-events-none');
                drawer.classList.remove('translate-x-full');
            } else {
                menu.classList.add('opacity-0', 'pointer-events-none');
                drawer.classList.add('translate-x-full');
            }
        }

        function toggleSubmenu(submenuId, chevronId) {
            const submenu = document.getElementById(submenuId);
            const chevron = document.getElementById(chevronId);
            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                chevron.classList.add('rotate-180');
            } else {
                submenu.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        }
    </script>

    <!-- Main Content -->
    <main class="flex-grow">
