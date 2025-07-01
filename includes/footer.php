<?php // /gemini-store/includes/footer.php ?>
    </main>
    <footer class="bg-white mt-16 border-t border-gray-200">
        <div class="container mx-auto px-6 py-8 text-center text-gray-500">
            &copy; <?= date('Y') ?> Gemini Store. Built with PHP & Tailwind CSS.
        </div>
    </footer>

    <!-- Generic Modal for Popups -->
    <div id="page-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full transform transition-all scale-95 opacity-0 border border-gray-200">
            <div class="text-center">
                 <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 -mt-16 shadow-lg">
                    <span class="text-3xl text-white">🎉</span>
                </div>
                <h3 class="text-2xl font-bold mt-5" id="modal-title">Welcome to the Club!</h3>
                <p id="modal-content" class="text-gray-600 mt-2 mb-6">
                    As a thank you for visiting, here's 15% off your next purchase! Use code: <br> <span class="mt-2 inline-block font-mono bg-gray-100 text-indigo-600 px-3 py-1.5 rounded-md text-lg border border-gray-200">GEMINI15</span>
                </p>
                <button onclick="closeModal()" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-semibold">
                    Start Shopping
                </button>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div id="quick-view-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
        <div id="quick-view-content" class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl relative transform transition-all scale-95 opacity-0 max-h-[90vh] flex flex-col">
             <button onclick="closeQuickView()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-800 transition-colors z-10 bg-white/50 rounded-full p-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
             </button>
             <div id="quick-view-body" class="overflow-y-auto p-6 md:p-8"></div>
        </div>
    </div>

    <!-- Custom JavaScript -->
    <script src="<?= BASE_URL ?>/js/main.js"></script>
</body>
</html>