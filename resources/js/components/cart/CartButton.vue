<template>
    <li class="nav-item nav-link">
        <div class="w-full sm:max-w-2xl mt-6 mb-10 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <a href="/cart"><i class="fa fa-shopping-cart"> 
                ({{ count }})
            </i></a>
        </div>
    </li>
</template>

<script>
export default {
    props: {
        content: {
            type: Array
        },
        cartCount: {
            type: Number
        }
    },
    data() {
        return {
            products: [],
            count: 0
        }
    },
    created() {
        this.products = this.content,
        this.count = this.cartCount

        this.emitter.on('add-to-cart', data => {
            console.log(data)
            this.count = this.count + data.quantity,
            this.products.push(data.product)
        })
    }

   /*  0 => array:10 [▼
    "rowId" => "8a48aa7c8e5202841ddaf767bb4d10da"
    "id" => 6
    "name" => "Juan Valdez Cafe"
    "qty" => 1
    "price" => 100.0
    "weight" => 0.0
    "options" => []
    "discount" => 0.0
    "tax" => 21.0
    "subtotal" => 100.0] */
}
</script>
