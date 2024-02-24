// import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import '@fortawesome/fontawesome-free/css/all.css';
import '../css/app.css'
import MainLayout from '@/Layouts/MainLayout.vue'
import { setupCalendar } from 'v-calendar';

createInertiaApp({
    resolve: async (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue')
    
        const page = await pages[`./Pages/${name}.vue`]()
        page.default.layout = page.default.layout || MainLayout
    
        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(setupCalendar, {})
            .mount(el)
    },
})
