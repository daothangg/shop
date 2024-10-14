import { createWebHistory,createRouter } from "vue-router";
import test from './test.vue'
import index from "./frontend/index.vue";
const routes=[
    {
        name:'index',
        path:'/',
        component:index,
    },
];
const router = createRouter({
    history:createWebHistory(),
    routes,
});
export default router;