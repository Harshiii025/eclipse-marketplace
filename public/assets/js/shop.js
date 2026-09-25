document.addEventListener("DOMContentLoaded", () => {

    const productGrid =
        document.getElementById("product-grid");

    const categoryButtons =
        document.querySelectorAll(".shop-category");

    const sortSelect =
        document.getElementById("sort-products");

    const productCount =
        document.getElementById("product-count");


    /*
    |--------------------------------------------------------------------------
    | Products are now loaded by PHP from MySQL.
    |--------------------------------------------------------------------------
    |
    | PHP creates the product cards.
    | JavaScript only handles:
    |
    | - Category filtering
    | - Sorting
    | - Product count
    |
    */


    let activeCategory = "all";


    /*
    |--------------------------------------------------------------------------
    | Get Product Cards
    |--------------------------------------------------------------------------
    */

    function getProductCards() {

        return Array.from(
            productGrid.querySelectorAll(".product-card")
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Display Products
    |--------------------------------------------------------------------------
    */

    function displayProducts() {

        let cards = getProductCards();


        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */

        if (activeCategory !== "all") {

            cards.forEach(card => {

                const category =
                    card.dataset.category;

                if (category === activeCategory) {

                    card.style.display = "";

                } else {

                    card.style.display = "none";

                }

            });

        } else {

            cards.forEach(card => {

                card.style.display = "";

            });

        }


        /*
        |--------------------------------------------------------------------------
        | Sort Products
        |--------------------------------------------------------------------------
        */

        if (sortSelect) {

            const sortValue =
                sortSelect.value;


            if (
                sortValue === "price-low" ||
                sortValue === "price-high"
            ) {

                cards.sort((a, b) => {

                    const priceA =
                        parseFloat(
                            a.querySelector(".product-price")
                                ?.textContent
                                .replace(/[^\d.]/g, "")
                        ) || 0;

                    const priceB =
                        parseFloat(
                            b.querySelector(".product-price")
                                ?.textContent
                                .replace(/[^\d.]/g, "")
                        ) || 0;


                    if (sortValue === "price-low") {

                        return priceA - priceB;

                    }

                    return priceB - priceA;

                });


                cards.forEach(card => {

                    productGrid.appendChild(card);

                });

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Product Count
        |--------------------------------------------------------------------------
        */

        const visibleCards =
            cards.filter(card => {

                return card.style.display !== "none";

            });


        if (productCount) {

            productCount.textContent =
                `${visibleCards.length} Products`;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Category Filters
    |--------------------------------------------------------------------------
    */

    categoryButtons.forEach(button => {

        button.addEventListener("click", event => {

            event.preventDefault();


            categoryButtons.forEach(btn => {

                btn.classList.remove("active");

            });


            button.classList.add("active");


            activeCategory =
                button.dataset.category || "all";


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