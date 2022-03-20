<template>
<ul>
    <li class="nav-item nav-link">
        <div class="w-full sm:max-w-2xl mt-6 mb-10 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <a href="/cart"><em class="fa fa-shopping-cart"> 
                ({{ count }})
            </em></a>
        </div>
    </li>
</ul>
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

        this.emitter.on("add-to-cart", data => {
            this.count = this.count + data.quantity;
            this.products.push(data.product);
        })
    }
}
</script>
