<?php // /gemini-store/product.php

include 'includes/header.php';

// --- Get Product ID and validate ---
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($productId <= 0) {
    echo "<p class='text-red-500'>Invalid product selected.</p>";
    include 'includes/footer.php';
    exit;
}

// --- Fetch Product Details ---
$stmt = $conn->prepare("SELECT p.*, c.name as category_name, c.id as category_id FROM products p JOIN categories c ON p.category_id = c.id WHERE p.id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "<p class='text-red-500'>Product not found.</p>";
    include 'includes/footer.php';
    exit;
}

// --- Fetch Related Products ---
$relatedStmt = $conn->prepare("
    SELECT p.* FROM products p
    JOIN related_products rp ON p.id = rp.related_product_id
    WHERE rp.product_id = ?
    LIMIT 4
");
$relatedStmt->bind_param("i", $productId);
$relatedStmt->execute();
$relatedResult = $relatedStmt->get_result();

?>

<div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-200">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16">
        <!-- Product Image Gallery -->
        <div>
            <div class="aspect-square bg-gray-100 rounded-xl shadow-inner overflow-hidden">
                 <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
            </div>
            <!-- Thumbnails can be added here -->
        </div>

        <!-- Product Details -->
        <div class="flex flex-col">
            <a href="category.php?id=<?= $product['category_id'] ?>" class="text-indigo-600 font-bold tracking-wider uppercase text-sm hover:underline"><?= htmlspecialchars($product['category_name']) ?></a>
            <h1 class="text-4xl md:text-5xl font-extrabold mt-2 text-gray-900 tracking-tight"><?= htmlspecialchars($product['name']) ?></h1>
            <div class="my-5">
                 <p class="text-4xl font-bold text-gray-900">$<?= htmlspecialchars($product['price']) ?></p>
                 <p class="text-sm text-gray-500 mt-1">incl. VAT</p>
            </div>
            <p class="text-gray-600 leading-relaxed text-base"><?= htmlspecialchars($product['description']) ?></p>

            <div class="mt-auto pt-8">
                <button class="w-full bg-indigo-600 text-white py-4 rounded-xl text-lg font-semibold hover:bg-indigo-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-indigo-500/50 shadow-lg">
                    Add to Cart
                </button>
                <div class="mt-4 flex items-center justify-center space-x-6 text-sm text-gray-500">
                    <a href="#" class="hover:text-indigo-600 flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" /></svg>Add to Wish List</a>
                    <a href="#" class="hover:text-indigo-600 flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm14 1a1 1 0 10-2 0v2a1 1 0 102 0V6zM2 13a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2zm14 1a1 1 0 10-2 0v2a1 1 0 102 0v-2z" /></svg>Add to Compare</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs for More Info and Related Products -->
    <div class="mt-16">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button onclick="switchTab(event, 'details')" class="tab-button active">Details</button>
                <button onclick="switchTab(event, 'more-info')" class="tab-button">More Information</button>
                <button onclick="switchTab(event, 'reviews')" class="tab-button">Reviews</button>
                <button onclick="switchTab(event, 'related-products')" class="tab-button">Related Products</button>
            </nav>
        </div>
        <div class="mt-8">
            <div id="details" class="tab-content prose max-w-none">
                <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            </div>
            <div id="more-info" class="tab-content prose max-w-none" style="display: none;">
                <p><?= nl2br(htmlspecialchars($product['more_information'] ?? 'No additional information available.')) ?></p>
            </div>
            <div id="reviews" class="tab-content" style="display: none;">
                <p class="text-gray-500">No reviews yet.</p>
            </div>
            <div id="related-products" class="tab-content" style="display: none;">
                <?php if ($relatedResult->num_rows > 0): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <?php while ($relatedProduct = $relatedResult->fetch_assoc()): ?>
                            <div class="bg-gray-50 rounded-xl overflow-hidden group border border-gray-200/80 hover:shadow-lg hover:border-indigo-300 transition-all duration-300">
                                <a href="product.php?id=<?= $relatedProduct['id'] ?>" class="block aspect-square overflow-hidden">
                                    <img src="<?= htmlspecialchars($relatedProduct['image_url']) ?>" alt="<?= htmlspecialchars($relatedProduct['name']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                </a>
                                <div class="p-4 text-center">
                                    <h4 class="font-semibold text-md truncate">
                                        <a href="product.php?id=<?= $relatedProduct['id'] ?>" class="hover:text-indigo-600"><?= htmlspecialchars($relatedProduct['name']) ?></a>
                                    </h4>
                                    <p class="text-gray-800 font-bold mt-1">$<?= htmlspecialchars($relatedProduct['price']) ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">No related products found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>