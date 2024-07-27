<template>
    <div class="login-card">
        <v-img
            class="mx-auto my-6"
            max-width="128"
            src="/panel/media/logo.jpg"
        ></v-img>

        <v-card
            class="mx-auto pa-12 pb-8"
            elevation="8"
            max-width="448"
            rounded="lg"
        >
            <div class="text-subtitle-1 text-medium-emphasis">ایمیل</div>

            <v-text-field
                v-model="form.email"
                density="compact"
                placeholder="ایمیل را وارد کنید"
                prepend-inner-icon="mdi-email-outline"
                variant="outlined"
            ></v-text-field>

            <div
                class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
            >
                رمز عبور
            </div>

            <v-text-field
                v-model="form.password"
                :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                :type="visible ? 'text' : 'password'"
                density="compact"
                placeholder="رمز عبور خود را وارد کنید"
                prepend-inner-icon="mdi-lock-outline"
                variant="outlined"
                @click:append-inner="visible = !visible"
            ></v-text-field>

            <div
                class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
            >
                تکرار رمز عبور
            </div>

            <v-text-field
                v-model="form.password_confirmation"
                :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                :type="visible ? 'text' : 'password_confirmation'"
                density="compact"
                placeholder="رمز عبور خود را وارد کنید"
                prepend-inner-icon="mdi-lock-outline"
                variant="outlined"
                @click:append-inner="visible = !visible"
            ></v-text-field>

            <v-btn
                @click="submit"
                block
                class="mt-8"
                color="blue"
                size="large"
                variant="tonal"
            >
                ادامه
            </v-btn>

            <v-card-text class="text-center">
                <router-link
                    :to="{ name: 'auth-login' }"
                    class="text-blue text-decoration-none"
                >
                    <v-icon icon="mdi-chevron-right"></v-icon> ورود
                </router-link>
            </v-card-text>
        </v-card>
        <v-snackbar :timeout="2000" v-model="snackbar_message">
            ایمیل و یا رمز عبور نادرست است.
        </v-snackbar>
    </div>
</template>
<script setup lang="ts">
import { useAuthStore, type User } from "@/stores/auth";
import { ref } from "vue";
import { useRouter } from "vue-router";
const snackbar_message = ref(false);
const store = useAuthStore();
const router = useRouter();
const form = ref({
    email: "",
    password: "",
    password_confirmation: "",
});
const visible = ref(false);
const submit = async () => {
    const data = {
        email: form.value.email,
        password: form.value.password,
        password_confirmation: form.value.password_confirmation,
    };
    try {
        const response = await store.register(data);
        console.log("response data", response);

        if (response.status == "200") {
            router.push({ name: "panel-dashboard" });
        } else {
            snackbar_message.value = true;
        }
    } catch (error) {
        snackbar_message.value = true;
    }
};
</script>
