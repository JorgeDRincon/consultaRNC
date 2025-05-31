import './bootstrap';

import { createApp } from 'vue';

import Layout from './components/Layout.vue';

import router from './router';

const app = createApp(Layout);

app.use(router);

app.mount('#app');