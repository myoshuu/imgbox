import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/",
    name: "home",
    component: () => import("../pages/Home.vue"),
  },
  {
    path: "/login",
    name: "login",
    component: () => import("../pages/auth/Login.vue"),
  },
  {
    path: "/register",
    name: "register",
    component: () => import("../pages/auth/Register.vue"),
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component: () => import("../pages/Dashboard.vue"),
  },
  {
    path: "/dashboard/edit/:id",
    name: "edit",
    component: () => import("../pages/EditData.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
