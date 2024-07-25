export default {
    path: "/panel/management",
    // meta: {
    //     middleware: "guest",
    // },
    component: () => import("@/Layouts/Management.vue"),
    children: [
        {
            path: "wallets",
            name: "management-wallets-index",
            component: () => import("@/Pages/management/wallets/index.vue"),
        },

        {
            path: "wallets/create",
            name: "management-wallets-create",
            component: () => import("@/Pages/management/wallets/create.vue"),
        },

        {
            path: "wallets/edit/:id",
            name: "management-wallets-edit",
            component: () => import("@/Pages/management/wallets/edit.vue"),
        },
    ],
};
