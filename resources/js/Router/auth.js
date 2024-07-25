export default {
    path: "/auth",
    meta: {
        middleware: "guest",
    },
    component: () => import("@/Layouts/Auth.vue"),
    children: [
        {
            path: "login",
            name: "auth-login",
            component: () => import("@/Pages/auth/login.vue"),
        },
        {
            path: "register",
            name: "auth-register",
            component: () => import("@/Pages/auth/register.vue"),
        },
    ],
};
