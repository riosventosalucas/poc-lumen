import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

// Importa Bootstrap CSS desde el CDN
import 'bootstrap/dist/css/bootstrap.min.css';

// Inicializa la aplicación Vue
createApp(App).use(router).mount('#app');
