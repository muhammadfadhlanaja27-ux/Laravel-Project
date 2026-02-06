import { createRouter, createWebHistory } from "vue-router";

import Login from "../views/login.vue";
import ListBerita from "../pages/ListBerita.vue";
import FormBerita from "../pages/FormBerita.vue";

const routes = [
  {
    path: "/",
    component: Login,
  },
  {
    path: "/tambah",
    component: FormBerita,
    meta: { requiresAuth: true },
  },
  {
    path: "/list-berita",
    component: ListBerita,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem("token");

  if (to.meta.requiresAuth && !token) {
    next("/login");
  } else {
    next();
  }
});

export default router;
