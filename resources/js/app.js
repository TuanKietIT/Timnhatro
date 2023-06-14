import './bootstrap';


import { createApp } from 'vue'
import App from './app.vue'
import Router from './router.js'
import CKEditor from '@ckeditor/ckeditor5-vue';

const app = createApp(App)
app.use( CKEditor );
app.use(Router);
app.mount('#app');