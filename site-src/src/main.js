import 'primevue/resources/themes/bootstrap4-dark-purple/theme.css'
import 'primevue/resources/primevue.min.css'
import 'primeicons/primeicons.css'
import 'primeflex/primeflex.css';
import "sweetalert2/dist/sweetalert2.min.css"; 
 


import { createApp } from 'vue'
import { createStore } from 'vuex';
import PrimeVue from 'primevue/config';
import Checkbox from 'primevue/checkbox';
import SweetAlert from "vue-sweetalert2";

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faDroplet, faPlus, faTag, faPen, faTrash} from '@fortawesome/free-solid-svg-icons'

library.add(faDroplet, faPlus, faTag, faPen, faTrash)

const store = createStore({
    state() {
        return {
            searchBarText: "",
        }
    },
});

import App from './App.vue'

import './assets/main.css'

const app = createApp(App)

app.component('font-awesome-icon', FontAwesomeIcon)
app.use(store);
app.use(PrimeVue, Checkbox)
app.use(SweetAlert)
app.mount('#app')

