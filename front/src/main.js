import { createApp } from 'vue'
import '@mdi/font/css/materialdesignicons.css';

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import router from './router'

// Components
import App from './App.vue'
import './http/axios';

const vuetify = createVuetify({
  components,
  directives,
})

createApp(App)
    .use(vuetify)    
    .use(router)
    .mount('#app')