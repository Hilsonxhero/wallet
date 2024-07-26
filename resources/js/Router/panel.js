export default {
    path: "/panel",
    meta: {
        middleware: "auth",
    },
    component: () => import("@/Layouts/Panel.vue"),
    children: [
        {
            path: "dashboard",
            name: "panel-dashboard",
            component: () => import("@/Pages/panel/dashboard.vue"),
        },

        {
            path: "wallets/:id",
            name: "panel-wallets-detail",
            component: () => import("@/Pages/panel/wallets/detail.vue"),
        },
    ],
};
