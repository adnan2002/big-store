
document.addEventListener('DOMContentLoaded', function() {
        const bodyStyles = window.getComputedStyle(document.body);
    if (bodyStyles.margin !== '0px') {
        const warning = document.getElementById('tailwind-warning');
        if (warning) warning.style.display = 'block';
    }

    });

const pageModal = document.getElementById('page-modal');
if (pageModal) {
    const modalContent = pageModal.querySelector('div');

    window.showModal = function() {
        pageModal.classList.add('flex');
        pageModal.classList.remove('hidden');
        setTimeout(() => modalContent.classList.add('scale-100', 'opacity-100'), 10);
    }

    window.closeModal = function() {
        modalContent.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => {
            pageModal.classList.remove('flex');
            pageModal.classList.add('hidden');
        }, 300);
    }

    pageModal.addEventListener('click', function(event) {
        if (event.target === pageModal) {
            closeModal();
        }
    });
}


function switchTab(event, tabId) {
    const tabContainer = event.target.closest('.mt-16');
    const tabContents = tabContainer.querySelectorAll('.tab-content');
    tabContents.forEach(content => {
        content.style.display = 'none';
    });

    const tabButtons = tabContainer.querySelectorAll('.tab-button');
    tabButtons.forEach(button => {
        button.classList.remove('active');
    });

    document.getElementById(tabId).style.display = 'block';
    event.currentTarget.classList.add('active');
}

const quickViewModal = document.getElementById('quick-view-modal');
if (quickViewModal) {
    const quickViewContent = document.getElementById('quick-view-content');
    const quickViewBody = document.getElementById('quick-view-body');

        window.openQuickView = async function(productId) {
        quickViewBody.innerHTML = '<div class="p-16 text-center text-gray-500">Loading Product...</div>';
        quickViewModal.classList.add('flex');
        quickViewModal.classList.remove('hidden');
        setTimeout(() => quickViewContent.classList.add('scale-100', 'opacity-100'), 10);

        try {
            const response = await fetch(`${BASE_URL}/product.php?id=${productId}`);
            if (!response.ok) throw new Error('Network response was not ok.');
            
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
                        const name = doc.querySelector('h1').textContent.trim();
            const price = doc.querySelector('.my-5 p:first-child').textContent.trim();
            const description = doc.querySelector('.leading-relaxed').textContent.trim();
            const imageUrl = doc.querySelector('.aspect-square img').src;

                        quickViewBody.innerHTML = `
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-10">
                    <div>
                        <div class="aspect-square bg-gray-100 rounded-xl shadow-inner overflow-hidden">
                            <img src="${imageUrl}" alt="${name}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">${name}</h2>
                        <p class="text-3xl font-bold text-gray-900 my-4">${price}</p>
                        <p class="text-gray-600 leading-relaxed text-sm mb-6">${description.substring(0, 150)}...</p>

                        <div class="mt-auto space-y-6">
                            <div class="flex items-center space-x-4">
                                <label for="qv-quantity" class="font-semibold text-gray-700">Quantity:</label>
                                <input type="number" id="qv-quantity" value="1" min="1" class="w-24 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div id="qv-cart-confirmation" class="transition-all duration-300"></div>
                            <button onclick="addToCartFromQuickView(${productId}, '${name.replace(/'/g, "\\'")}')" class="w-full bg-indigo-600 text-white py-3 rounded-xl text-lg font-semibold hover:bg-indigo-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-indigo-500/50 shadow-lg">
                                Add to Cart
                            </button>
                            <a href="${BASE_URL}/product.php?id=${productId}" class="block text-center mt-4 text-sm text-indigo-600 hover:underline font-medium">View Full Product Details</a>
                        </div>
                    </div>
                </div>
            `;

        } catch (error) {
            console.error('Quick View Error:', error);
            quickViewBody.innerHTML = '<div class="p-16 text-center text-red-500">Could not load product details. Please try again later.</div>';
        }
    }

        window.addToCartFromQuickView = function(productId, productName) {
        const quantityInput = document.getElementById('qv-quantity');
        const quantity = parseInt(quantityInput.value, 10);
        const confirmationDiv = document.getElementById('qv-cart-confirmation');

        if (quantity > 0) {
            console.log(`Added ${quantity} of ${productName} (ID: ${productId}) to cart.`);

            confirmationDiv.innerHTML = `
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg" role="alert">
                    <p class="font-bold">Success!</p>
                    <p>${quantity} x ${productName} added to your cart.</p>
                </div>
            `;

            setTimeout(() => { confirmationDiv.innerHTML = ''; }, 4000);
        } else {
            confirmationDiv.innerHTML = `
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg" role="alert">
                    <p>Please enter a valid quantity.</p>
                </div>
            `;
            setTimeout(() => { confirmationDiv.innerHTML = ''; }, 3000);
        }
    }

        window.closeQuickView = function() {
        quickViewContent.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => {
            quickViewModal.classList.remove('flex');
            quickViewModal.classList.add('hidden');
            quickViewBody.innerHTML = '';         }, 300);
    }

    quickViewModal.addEventListener('click', function(event) {
        if (event.target === quickViewModal) {
            closeQuickView();
        }
    });
}
