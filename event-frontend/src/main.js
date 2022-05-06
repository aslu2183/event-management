import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { CIcon } from '@coreui/icons-vue';
import * as icon from '@coreui/icons';
import store from './store'

import '@coreui/coreui/dist/css/coreui.min.css'
createApp(App).use(router).use(store).provide('icons',icon).component('CIcon',CIcon).mount('#app')
