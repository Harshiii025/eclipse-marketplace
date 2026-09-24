document.addEventListener("DOMContentLoaded", () => {

    const productGrid = document.getElementById("product-grid");
    const categoryButtons = document.querySelectorAll(".shop-category");
    const sortSelect = document.getElementById("sort-products");
    const productCount = document.getElementById("product-count");


    /*
    |--------------------------------------------------------------------------
    | Product Data
    |--------------------------------------------------------------------------
    */

    const products = [

        {
            id: 1,
            name: "Essential Oversized Tee",
            description: "Heavyweight Cotton",
            price: 1499,
            category: "t-shirts",
            badge: "NEW"
        },

        {
            id: 2,
            name: "Classic Relaxed Shirt",
            description: "Premium Cotton",
            price: 1999,
            category: "shirts",
            badge: "BESTSELLER"
        },

        {
            id: 3,
            name: "Minimal Zip Hoodie",
            description: "French Terry",
            price: 2499,
            category: "hoodies",
            badge: ""
        },

        {
            id: 4,
            name: "Wide Leg Trousers",
            description: "Structured Cotton",
            price: 2199,
            category: "pants",
            badge: ""
        },

        {
            id: 5,
            name: "Oversized Oxford",
            description: "Organic Cotton",
            price: 1899,
            category: "shirts",
            badge: "NEW"
        },

        {
            id: 6,
            name: "Everyday Cargo",
            description: "Utility Cotton",
            price: 2299,
            category: "pants",
            badge: ""
        }

    ];


    let activeCategory = "all";


    /*
    |--------------------------------------------------------------------------
    | Display Products
    |--------------------------------------------------------------------------
    */

    function displayProducts() {

        let filteredProducts = [...products];


        /*
        | Category Filter
        */

        if (activeCategory !== "all") {

            filteredProducts = filteredProducts.filter(product => {

                return product.category === activeCategory;

            });

        }


        /*
        | Sort Products
        */

        if (sortSelect) {

            const sortValue = sortSelect.value;


            if (sortValue === "price-low") {

                filteredProducts.sort((a, b) => {
                    return a.price - b.price;
                });

            }


            if (sortValue === "price-high") {

                filteredProducts.sort((a, b) => {
                    return b.price - a.price;
                });

            }

        }


        /*
        | Product Count
        */

        if (productCount) {

            productCount.textContent =
                `${filteredProducts.length} Products`;

        }


        /*
        | Clear Grid
        */

        productGrid.innerHTML = "";


        /*
        | No Products
        */

        if (filteredProducts.length === 0) {

            productGrid.innerHTML = `
                <div class="no-products">
                    No products found.
                </div>
            `;

            return;

        }


        /*
        | Create Product Cards
        */

        filteredProducts.forEach(product => {

            const card = document.createElement("article");

            card.className = "product-card";


            card.innerHTML = `

                <div class="product-image">

                    ${
                        product.badge
                            ? `
                                <span class="product-badge">
                                    ${product.badge}
                                </span>
                              `
                            : ""
                    }


                    <a
                        href="product.php?id=${product.id}"
                        class="product-image-link"
                    >

                        <div class="product-image-placeholder">
                            <span>IMAGE</span>
                        </div>

                    </a>

                </div>


                <div class="product-info">

                    <p class="product-category">
                        ${product.category
                            .replace("-", " ")
                            .toUpperCase()}
                    </p>


                    <h3>

                        <a href="product.php?id=${product.id}">
                            ${product.name}
                        </a>

                    </h3>


                    <p>
                        ${product.description}
                    </p>


                    <p class="product-price">
                        ₹${product.price.toLocaleString("en-IN")}
                    </p>


                    <form class="shop-add-to-cart-form">

                        <button
                            type="button"
                            class="add-to-cart-btn"
                            data-product-id="${product.id}"
                        >
                            Add to Cart
                        </button>

                    </form>

                </div>

            `;


            productGrid.appendChild(card);

        });


        /*
        | Attach Add To Cart Events
        */

        const addButtons =
            document.querySelectorAll(".add-to-cart-btn");


        addButtons.forEach(button => {

            button.addEventListener("click", () => {

                addToCart(button);

            });

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Add To Cart
    |--------------------------------------------------------------------------
    */

    async function addToCart(button) {

        const productId =
            button.dataset.productId;


        const formData = new FormData();

        formData.append("product_id", productId);

        formData.append("quantity", 1);

        formData.append("size", "M");


        try {

            button.disabled = true;

            button.textContent = "Adding...";


            const response = await fetch(
                "add-to-cart.php",
                {
                    method: "POST",
                    body: formData
                }
            );


            /*
            | add-to-cart.php redirects to cart.php.
            | fetch follows that redirect automatically.
            */

            if (response.ok) {

                button.textContent = "Added ✓";


                /*
                | Update Navbar Cart Count
                */

                const cartCount =
                    document.querySelector(".cart-count");


                if (cartCount) {

                    const currentCount =
                        parseInt(
                            cartCount.textContent
                        ) || 0;


                    cartCount.textContent =
                        currentCount + 1;

                }


                /*
                | Reset Button
                */

                setTimeout(() => {

                    button.textContent =
                        "Add to Cart";

                    button.disabled = false;

                }, 1500);

            } else {

                button.textContent =
                    "Add to Cart";

                button.disabled = false;

                alert(
                    "Unable to add product to cart."
                );

            }

        } catch (error) {

            console.error(
                "Add to cart error:",
                error
            );


            button.textContent =
                "Add to Cart";

            button.disabled = false;


            alert(
                "Something went wrong."
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Category Filters
    |--------------------------------------------------------------------------
    */

    categoryButtons.forEach(button => {

        button.addEventListener("click", () => {

            categoryButtons.forEach(btn => {

                btn.classList.remove("active");

            });


            button.classList.add("active");


            activeCategory =
                button.dataset.category;


            displayProducts();

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Sort
    |--------------------------------------------------------------------------
    */

    if (sortSelect) {

        sortSelect.addEventListener("change", () => {

            displayProducts();

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Initial Display
    |--------------------------------------------------------------------------
    */

    displayProducts();

});