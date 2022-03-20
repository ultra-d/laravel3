require('./bootstrap');

import { createApp } from 'vue'
import AddProductButton from './components/cart/AddProductButton'
import CartButton from './components/cart/CartButton'
import mitt from 'mitt'

const emitter = mitt()
const app = createApp({})
app.config.globalProperties.emitter = emitter;

app.component('add-product-button', AddProductButton)
app.component('cart-button', CartButton)
app.mount('#app')
