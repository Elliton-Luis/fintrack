import './bootstrap';
import '../css/app.css';
import 'primeicons/primeicons.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';

import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';

import { ZiggyVue } from 'ziggy-js';
import { Ziggy } from './ziggy';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./pages/**/*.vue', { eager: true });
    return pages[`./pages/${name}.vue`];
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(PrimeVue, { theme: { preset: Aura } })
      .use(ZiggyVue, Ziggy)
      .mount(el);
  },
});
