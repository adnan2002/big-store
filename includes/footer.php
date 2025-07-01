    </main>
    <footer class="bg-white mt-16 border-t border-gray-200">
        <div class="container mx-auto px-6 py-8 text-center text-gray-500">
            &copy; <?= date('Y') ?> Big Store. Built with PHP & Tailwind CSS.
        </div>
    </footer>

    

    <div id="quick-view-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
        <div id="quick-view-content" class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl relative transform transition-all scale-95 opacity-0 max-h-[90vh] flex flex-col">
             <button onclick="closeQuickView()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-800 transition-colors z-10 bg-white/50 rounded-full p-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
             </button>
             <div id="quick-view-body" class="overflow-y-auto p-6 md:p-8"></div>
        </div>
    </div>

    <script src="<?= BASE_URL ?>/js/main.js"></script>
</body>
</html>