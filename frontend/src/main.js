import './assets/main.css'

import { createApp, markRaw } from 'vue'
import App from './App.vue'
import router from './router'
import './axios'
import { createPinia } from 'pinia'

const app = createApp(App)
const pinia = createPinia()
pinia.use(({ store }) => {
    store.router = markRaw(router)
})

app.use(pinia)
app.use(router)

app.mount('#app')