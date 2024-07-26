<template>
    <div>
        <div class="grid grid-cols-12 gap-2">
            <div
                class="col-span-4"
                v-for="(wallet, index) in wallets"
                :key="index"
            >
                <v-card class="mx-auto" max-width="344">
                    <v-card-text>
                        <p class="text-xl font-weight-black">
                            {{ wallet?.name }}
                        </p>

                        <div class="text-medium-emphasis mt-2">
                            {{ wallet?.description }}
                        </div>

                        <div class="d-flex justify-space-between py-3 mt-3">
                            <span class="text-medium-emphasis"> موجودی </span>
                            <span
                                class="text-green-darken-3 font-weight-medium"
                            >
                                {{ wallet?.balance }}
                            </span>
                        </div>
                    </v-card-text>

                    <v-card-actions class="flex justify-between items-center">
                        <v-btn
                            :to="{
                                name: 'panel-wallets-detail',
                                params: { id: wallet?.id },
                            }"
                            text="مدیریت کیف پول"
                            variant="text"
                        ></v-btn>
                        <v-btn variant="elevated" color="#5865f2">
                            {{ wallet?.type }}
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import ApiService from "@/Core/services/ApiService";

const wallets = ref([]);

const fetchWalelts = async () => {
    const { data } = await ApiService.get("application/user/wallets");
    wallets.value = data.data;
};

onMounted(() => {
    fetchWalelts();
});
</script>

<style scoped></style>
