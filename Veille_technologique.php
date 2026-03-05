<!DOCTYPE html>
<html class="dark" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Portfolio</title>
<link href="data:image/x-icon;base64," rel="icon" type="image/x-icon"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#00aaff",
                        "electric-blue": "#007BFF",
                        "neon-green": "#39FF14",
                        "background-light": "#f0f2f5",
                        "background-dark": "#121212",
                        "code-bg-light": "#fbfcfd",
                        "code-bg-dark": "#1e1e1e",
                        "border-light": "#d0d7de",
                        "border-dark": "#2d2d2d",
                    },
                    fontFamily: {
                        display: ["Roboto Mono", "monospace"],
                    },
                    borderRadius: {
                        DEFAULT: "6px",
                        lg: "12px",
                        xl: "16px",
                        full: "9999px"
                    },
                },
            },
        };
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
        }
    </style>
</head>
<body class="bg-background-dark font-display text-slate-200">
<div class="flex min-h-screen w-full flex-col">
<header class="flex items-center justify-between whitespace-nowrap border-b border-border-dark px-6 py-4">
<div class="flex items-center gap-3 text-white">
<div class="size-8 text-electric-blue">
<svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<path d="M6.293 13.293l1.414 1.414L12 10.414l4.293 4.293 1.414-1.414L12 7.586z"></path>
<path d="M4 17h16v2H4z"></path>
</svg>
</div>
<h1 class="text-xl font-bold">// Mon Portfolio</h1>
</div>
<nav class="hidden md:flex items-center gap-6">
<a class="text-sm font-medium text-slate-300 hover:text-electric-blue transition-colors" href="Accueil.php">
<span class="text-electric-blue mr-1">/</span>Accueil</a>
<a class="text-sm font-medium text-slate-300 hover:text-electric-blue transition-colors" href="Projets.php">
<span class="text-electric-blue mr-1">/</span>Projets</a>
<a class="text-sm font-medium text-slate-300 hover:text-electric-blue transition-colors" href="Competences.php">
<span class="text-electric-blue mr-1">/</span>Compétences</a>
<a class="text-sm font-medium text-slate-300 hover:text-electric-blue transition-colors" href="Experiences_professionelles.php">
<span class="text-electric-blue mr-1">/</span>Expériences professionelles</a>
<a class="text-sm font-medium text-slate-300 hover:text-electric-blue transition-colors" href="Contact.php">
<span class="text-electric-blue mr-1">/</span>Contact</a>
</nav>
<div class="flex items-center gap-4">
<button class="md:hidden p-2 text-slate-200">
<span class="material-symbols-outlined"> menu </span>
</button>
</div>
</header>
<main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
<div class="max-w-4xl mx-auto">
<div class="text-center mb-12">
<h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white">Tech Watch</h2>
<p class="mt-4 text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
              Stay updated with the latest trends in technology. Explore articles, sources, and personal insights on AI, cybersecurity, and web technologies.
            </p>
</div>
<div class="space-y-16">
<div>
<h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white flex items-center gap-3">
<span class="material-symbols-outlined text-primary">star</span> Featured Articles
              </h3>
<div class="space-y-8">
<article class="grid md:grid-cols-5 gap-6 items-center">
<div class="md:col-span-2 h-48 rounded-lg bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCk-_w73MivrSOrPtUKA86ymS3W34Gy4yRjfrMZ2zqo5JHzveSJn1rCey5b-VKejKKmhvjSx5y9tDsmTFsJ4lwADmMcIs3dJT_ohJdbyav8MJSsNcEOyjW7BDAEszOEVgayElH4zxGQiBqAbV9a9_ETBd2mEAzkK9h6QBK8kIkhK9ksv86c2W066hoyB7Yo-kp11vF1jpxHhJiP72vRaQlVouPBTa8NmLtwiN_hK6IH3etfVevMPDlY9sGCBrSeFgdmySn09X21");'></div>
<div class="md:col-span-3">
<p class="text-sm font-medium text-primary mb-1">AI</p>
<h4 class="text-xl font-bold text-gray-900 dark:text-white">The Future of AI in Software Development</h4>
<p class="mt-2 text-gray-600 dark:text-gray-400">
                      Explore how artificial intelligence is transforming software development, from automated testing to code generation.
                    </p>
<a class="inline-block mt-4 text-sm font-medium text-primary hover:underline" href="#">Read More →</a>
</div>
</article>
<article class="grid md:grid-cols-5 gap-6 items-center">
<div class="md:col-span-2 h-48 rounded-lg bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAF_vJJrInZFChqywq5vCFuBzSflt2pItZqrd62GxnzZEostJiHUQLlP8pbOlqu_3ZY9LWztIYZAjTu-1GwJGWzJhdSAXaDGNTXk6-GJU81NG7M3fowOMu5eGp43rewrY-dZ3p3xiP2x__a_ECYr3Te3Wc_6v7BOaJh2WUPbN4tz0j6A5dO4z2nZKWCVXVfHb93Ak0ws4LEgHibIdayz6_DZTdyAAogh7083S1TiYBisZDC5QM8SyB0c4UR7iFlfAOyEPzuLZSK");'></div>
<div class="md:col-span-3">
<p class="text-sm font-medium text-primary mb-1">Cybersecurity</p>
<h4 class="text-xl font-bold text-gray-900 dark:text-white">Securing Web Applications in 2024</h4>
<p class="mt-2 text-gray-600 dark:text-gray-400">
                      A comprehensive guide to the latest cybersecurity threats and best practices for securing web applications.
                    </p>
<a class="inline-block mt-4 text-sm font-medium text-primary hover:underline" href="#">Read More →</a>
</div>
</article>
</div>
</div>
<div>
<h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white flex items-center gap-3">
<span class="material-symbols-outlined text-primary">source</span> Sources of Tech Intelligence
              </h3>
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
<div class="p-6 bg-gray-50 dark:bg-gray-800/30 rounded-lg border border-gray-200 dark:border-gray-800/50">
<span class="material-symbols-outlined text-primary text-3xl mb-4">public</span>
<h4 class="text-lg font-bold text-gray-900 dark:text-white">Tech Blogs</h4>
<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Stay informed with insights from leading tech blogs.</p>
</div>
<div class="p-6 bg-gray-50 dark:bg-gray-800/30 rounded-lg border border-gray-200 dark:border-gray-800/50">
<span class="material-symbols-outlined text-primary text-3xl mb-4">slideshow</span>
<h4 class="text-lg font-bold text-gray-900 dark:text-white">Conferences</h4>
<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Attend key conferences to learn from industry experts.</p>
</div>
<div class="p-6 bg-gray-50 dark:bg-gray-800/30 rounded-lg border border-gray-200 dark:border-gray-800/50">
<span class="material-symbols-outlined text-primary text-3xl mb-4">groups</span>
<h4 class="text-lg font-bold text-gray-900 dark:text-white">Communities</h4>
<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Engage with tech communities to share knowledge.</p>
</div>
</div>
</div>
<div>
<h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white flex items-center gap-3">
<span class="material-symbols-outlined text-primary">person</span> Personal Insights
              </h3>
<div class="prose prose-lg dark:prose-invert max-w-none text-gray-600 dark:text-gray-400">
<p>
                  As a student in BTS SIO (SLAM option), I am passionate about staying at the forefront of technology. My focus areas include AI, cybersecurity, and emerging web technologies. This section reflects my ongoing learning process and personal analysis of the ever-evolving tech landscape. I aim to continuously update my knowledge and share my findings here.
                </p>
</div>
</div>
</div>
</div>
</main>
<footer class="bg-background-light dark:bg-background-dark border-t border-gray-200/50 dark:border-gray-800/50 mt-12">
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
<p>© 2024 TechWatch. All Rights Reserved.</p>
</div>
</footer>
</div>

</body></html>