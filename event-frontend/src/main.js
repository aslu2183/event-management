import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { CIcon } from '@coreui/icons-vue';
import * as icon from '@coreui/icons';
import store from './store'
import CoreuiVue from '@coreui/vue'

import '@coreui/coreui/dist/css/coreui.min.css'
createApp(App)
.use(store)
.use(router)
.use(CoreuiVue)
.provide('icons',icon)
.component('CIcon',CIcon)
.mount('#app')
