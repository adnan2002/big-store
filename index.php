<?php 
include 'includes/header.php';

$result = $conn->query("SELECT * FROM products ORDER BY RAND() LIMIT 8");
?>

<div class="text-center mb-12">
    <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight">Welcome to Our Store</h1>
    <p class="text-lg text-gray-600 mt-3 max-w-2xl mx-auto">Discover our latest collection of high-quality apparel. Built for comfort, designed for style.</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    <?php while ($product = $result->fetch_assoc()): ?>
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
</div>

<?php include 'includes/footer.php'; ?>