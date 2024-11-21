<?php  
// require('../controllers/product_controller.php'); 
// session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Second Hand Clothes</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        function confirmAddToCart(form) {
            // Check if the session is valid
            <?php if (!isset($_SESSION['session_valid']) || $_SESSION['session_valid'] !== true) { ?>
                alert("You need to log in or sign up to add items to your cart.");
                return false;
            <?php } ?>
            // Confirm adding to cart
            if (confirm("Are you sure you want to add this product to your cart?")) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .bg-footer {
            background-color: #2d3748;
        }

        .hover\:bg-footer:hover {
            background-color: #4a5568;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col">
        <!--  -->
        
        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-4">
            <!-- Product Grid -->
            <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
                <?php foreach ($products as $product) { ?>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['title']; ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-bold mb-2"><?php echo $product['title']; ?></h3>
                            <p class="text-gray-600 mb-4"><?php echo $product['description']; ?></p>
                            <form method="POST" action="../actions/add_cart.php" onsubmit="return confirmAddToCart(this);">
                                <input type="hidden" name="p_id" value="<?php echo $product['product_id']; ?>">
                                <div class="flex justify-between items-center">
                                    <span class="text-blue-500 font-bold">GHS<?php echo $product['price']; ?></span>
                                    <button type="submit" name="add_to_cart" class="bg-footer hover:bg-footer text-white font-bold py-2 px-4 rounded">
                                        <i class="fas fa-shopping-cart mr-2"></i>
                                        Add to Cart
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-footer text-white py-8 mt-auto">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <p>&copy; 2024 FOOS. All rights reserved.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </footer>
    </div>
</body>
<script>
    document.getElementById("searchForm").addEventListener("submit", function(event) {
        event.preventDefault();
        const searchQuery = document.getElementById("searchInput").value;

        // AJAX request to fetch search results
        fetch("../actions/search_action.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `query=${searchQuery}`
        })
        .then(response => response.json())
        .then(products => {
            const productsSection = document.querySelector("main section");
            productsSection.innerHTML = ""; // Clear existing products

            // Loop through products and render each product in HTML
            products.forEach(product => {
                productsSection.innerHTML += `
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="${product.img}" alt="${product.title}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-bold mb-2">${product.title}</h3>
                            <p class="text-gray-600 mb-4">${product.description}</p>
                            <form method="POST" action="../actions/add_cart.php" onsubmit="return confirmAddToCart(this);">
                                <input type="hidden" name="p_id" value="${product.product_id}">
                                <div class="flex justify-between items-center">
                                    <span class="text-blue-500 font-bold">GHS${product.price}</span>
                                    <button type="submit" name="add_to_cart" class="bg-footer hover:bg-footer text-white font-bold py-2 px-4 rounded">
                                        <i class="fas fa-shopping-cart mr-2"></i>
                                        Add to Cart
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>`;
            });
        })
        .catch(error => console.error("Error:", error));
    });
</script>

</html>
