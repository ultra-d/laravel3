<template>
    <input type="number" v-model="quantity"
        class="text-sm sm:text-base px-2 pr-2 rounded-lg border 
        border-gray-400 py-1 focus:outline-none focus:border-blue-300"
        style="width: 50px">
    <button class="btn border btn-sm fa fa-shopping-cart" @click="add"> Agregar</button>
</template>

<script>
export default {
    props: {
        product: {
            type: Object
        }
    },
    data(){
        return {
            quantity: 1
        }
    },
    watch: {
        quantity(){
            if (this.quantity < 1) {
                this.quantity = 1
            }

            if (this.quantity > this.product.quantity) {
                this.quantity = this.product.quantity
            }
        }
    },
    methods: {
        add(){
            axios
                .post('/cart', {
                    product_id: this.product.id,
                    quantity: this.quantity
                })
                .then(response => {
                    this.emitter.emit('add-to-cart', {
                        product: response.data.cartItem,
                        quantity: this.quantity
                    })
                })
        }
    }
}
</script>
