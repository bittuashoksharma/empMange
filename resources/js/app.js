import './bootstrap';
import './theme_file.js';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import router from './router/index.js';
import store from	'./store'
import axios from 'axios';

import AppComponent from './layout/App.vue';
import HeaderComponent from './components/HeaderComponent.vue';
import RouterComponent from './components/RouterComponent.vue';
import SidebarComponent from './layout/SidebarComponent.vue';
import Pagination from './components/Pagination.vue';
//import ProgressbarComponent from "@/components/employee/form_progress_bar.vue"

//check for page refresh and refresh token 
import { useStore } from 'vuex'
const restore = useStore()
if(localStorage.token){
	axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.token;
}else{
	delete axios.defaults.headers.Authorization;
}
const app = createApp({}); 
app.use(router,axios);
app.use(store)
app.component('AppComponent', AppComponent);
app.component('HeaderComponent', HeaderComponent);
app.component('SidebarComponent', SidebarComponent);
app.component('Pagination', Pagination);
//app.component('ProgressbarComponent', ProgressbarComponent);
app.mount('#app');