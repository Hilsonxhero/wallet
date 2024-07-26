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
            path: "checkout/confirmation/payment/:id",
            name: "checkout-confirmation",
            component: () => import("@/Pages/checkout/confirmation.vue"),
        },
    ],
};
