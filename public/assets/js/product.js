document.addEventListener("DOMContentLoaded", () => {

    /*
    |--------------------------------------------------------------------------
    | Quantity
    |--------------------------------------------------------------------------
    */

    const minusButton = document.getElementById("quantity-minus");
    const plusButton = document.getElementById("quantity-plus");
    const quantityDisplay = document.getElementById("quantity");

    let quantity = 1;


    if (plusButton) {

        plusButton.addEventListener("click", () => {

            quantity++;

            quantityDisplay.textContent = quantity;

        });

    }


    if (minusButton) {

        minusButton.addEventListener("click", () => {

            if (quantity > 1) {

                quantity--;

                quantityDisplay.textContent = quantity;

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Size
    |--------------------------------------------------------------------------
    */

    const sizeButtons =
        document.querySelectorAll(".size-options button");

    let selectedSize = "M";


    sizeButtons.forEach(button => {

        button.addEventListener("click", () => {

            sizeButtons.forEach(btn => {
                btn.classList.remove("active");
            });

            button.classList.add("active");

            selectedSize = button.textContent.trim();

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Add To Cart
    |--------------------------------------------------------------------------
    */

    const addToCartButton =
        document.getElementById("product-add-to-cart");


    if (!addToCartButton) {
        console.error("Add to Cart button not found.");
        return;
    }


    addToCartButton.addEventListener("click", async () => {

        /*
        | Get product ID directly from URL
        */

        const urlParams =
            new URLSearchParams(window.location.search);

        const productId =
            urlParams.get("id");


        console.log("Product ID:", productId);
        console.log("Quantity:", quantity);
        console.log("Size:", selectedSize);


        /*
        | Safety check
        */

        if (!productId) {

            alert("Product ID is missing.");

            return;

        }


        /*
        | Create request
        */

        const formData = new FormData();

        formData.append("product_id", productId);
        formData.append("quantity", quantity);
        formData.append("size", selectedSize);


        try {

            const response = await fetch("add-to-cart.php", {

                method: "POST",

                body: formData

            });


            const data = await response.json();


            console.log("Add to cart response:", data);


            if (data.success) {

                addToCartButton.textContent = "Added ✓";

                addToCartButton.classList.add("added");


                /*
                | Update cart count if navbar has one
                */

                const cartCount =
                    document.querySelector(".cart-count");


                if (cartCount) {

                    cartCount.textContent =
                        data.totalItems;

                }


                /*
                | Reset button
                */

                setTimeout(() => {

                    addToCartButton.textContent =
                        "Add to Cart";

                    addToCartButton.classList.remove("added");

                }, 1500);

            } else {

                alert(data.message);

                console.error(data.message);

            }

        } catch (error) {

            console.error("Add to cart error:", error);

            alert(
                "Something went wrong while adding the product."
            );

        }

    });

});