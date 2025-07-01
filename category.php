<?php // /gemini-store/category.php

include 'includes/header.php';

// --- Get Category ID and validate ---
$categoryId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($categoryId <= 0) {
    echo "<p class='text-red-500'>Invalid category selected.</p>";
    include 'includes/footer.php';
    exit;
}

// --- Fetch Category Info ---
$stmt = $conn->prepare("SELECT name, description FROM categories WHERE id = ?");
$stmt->bind_param("i", $categoryId);
$stmt->execute();
$categoryResult = $stmt->get_result();
$category = $categoryResult->fetch_assoc();

if (!$category) {
    echo "<p class='text-red-500'>Category not found.</p>";
    include 'includes/footer.php';
    exit;
}

// --- Fetch Products in this Category ---
$stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ?");
$stmt->bind_param("i", $categoryId);
$stmt->execute();
$productsResult = $stmt->get_result();

?>

<div class="text-left mb-12 border-b border-gray-200 pb-6">
    <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight"><?= htmlspecialchars($category['name']) ?></h1>
    <p class="text-lg text-gray-600 mt-3 max-w-3xl"><?= htmlspecialchars($category['description']) ?></p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    <?php if ($productsResult->num_rows > 0): ?>
        <?php while ($product = $productsResult->fetch_assoc()): ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 border border-gray-200/80">
                <div class="aspect-w-1 aspect-h-1 overflow-hidden">
                    <a href="product.php?id=<?= $product['id'] ?>" class="block">
                        <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </a>
                </div>
                <div class="p-5 flex flex-col">
                    <h3 class="font-bold text-lg text-gray-800 truncate">
                        <a href="product.php?id=<?= $product['id'] ?>" class="hover:text-indigo-600 transition-colors"><?= htmlspecialchars($product['name']) ?></a>
                    </h3>
                    <p class="text-gray-800 font-extrabold text-xl mt-2">$<?= htmlspecialchars($product['price']) ?></p>
                     <button onclick="openQuickView(<?= $product['id'] ?>)" class="mt-4 w-full bg-gray-800 text-white py-2.5 rounded-lg hover:bg-indigo-600 transition-all duration-300 font-semibold transform hover:scale-105">
                        Quick View
                    </button>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="col-span-full text-center text-gray-500 py-16">No products found in this category yet.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>