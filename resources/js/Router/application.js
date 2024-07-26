export default {
    path: "/",
    redirect: "/auth/login",
    component: () => import("@/Layouts/App.vue"),
    children: [
        {
            path: "purchase/paypal/:id",
            name: "purchase-paypal",
            component: () => import("@/Pages/purchase/paypal.vue"),
        },

        {
            path: "purchase/perfect/:id",
            name: "purchase-perfect",
            component: () => import("@/Pages/purchase/perfect.vue"),
        },

        {
            path: "purchase/webmoney/:id",
            name: "purchase-webmoney",
            component: () => import("@/Pages/purchase/webmoney.vue"),
        },
        {
            path: "checkout/confirmation/payment/:id",
            name: "checkout-confirmation",
            component: () => import("@/Pages/checkout/confirmation.vue"),
        },
    ],
};
