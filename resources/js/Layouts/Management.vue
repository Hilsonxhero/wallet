<template>
    <v-layout>
        <v-navigation-drawer
            :temporary="mobile"
            :permanent="!mobile"
            v-model="drawer"
            location="right"
        >
            <template v-slot:prepend>
                <template v-if="!user?.is_partner">
                    <v-list-item
                        lines="two"
                        prepend-avatar="/panel/media/avatars/blank.png"
                        :title="user?.username"
                        subtitle="کاربر ادمین"
                    ></v-list-item>
                </template>
            </template>
            <template v-slot:append>
                <div class="pa-2">
                    <v-btn @click="signOut" block> خروج از حساب کاربری </v-btn>
                </div>
            </template>

            <v-divider></v-divider>

            <v-list density="compact" nav>
                <v-list-item
                    link
                    prepend-icon="mdi-home-city"
                    title="کیف پول ها"
                    :to="{ name: 'management-wallets-index' }"
                >
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar title="">
            <v-app-bar-nav-icon
                variant="text"
                @click.stop="drawer = !drawer"
            ></v-app-bar-nav-icon>
        </v-app-bar>
        <v-main>
            <div class="p-5">
                <router-view></router-view>
            </div>
        </v-main>
    </v-layout>
</template>
<script setup lang="ts">
import { onMounted, ref } from "vue";
import { useDisplay } from "vuetify";
import { useAuthStore, type User } from "@/stores/auth";
import { useRouter } from "vue-router";
import { storeToRefs } from "pinia";
const router = useRouter();
const store = useAuthStore();
const { user } = storeToRefs(store);

const { mobile, smAndDown, mdAndDown } = useDisplay();

const drawer = ref(true);
const signOut = () => {
    store.logout().then(() => {
        router.push({ name: "auth-login" });
    });
};
onMounted(() => {
    console.log("user", user);

    if (mobile.value) {
        drawer.value = false;
    }
});
</script>

<style></style>
