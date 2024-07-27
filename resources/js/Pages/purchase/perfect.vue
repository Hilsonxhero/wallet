<template>
    <div class="w-full min-h-screen h-screen flex items-center justify-center">
        <v-card class="mx-auto" max-width="500" width="400">
            <v-card-text>
                <div>درگاه پرداخت</div>

                <p class="text-xl font-weight-black mt-3">
                    درگاه پرداخت perfectmoney
                </p>

                <div class="d-flex justify-space-between py-3 mt-3">
                    <span class="text-medium-emphasis"> کد پیگیری‌ </span>
                    <span class="text-green-darken-3 font-weight-medium">
                        {{ form?.reference_code }}
                    </span>
                </div>
                <div class="d-flex justify-space-between py-3 mt-3">
                    <span class="text-medium-emphasis"> مبلغ </span>
                    <span class="text-green-darken-3 font-weight-medium">
                        {{ form?.amount }}
                    </span>
                </div>
            </v-card-text>

            <v-card-actions>
                <v-btn
                    color="success"
                    text="پرداخت موفق"
                    variant="tonal"
                    @click="handleCallbackStatus(true)"
                ></v-btn>
                <v-btn
                    color="error"
                    text="پرداخت ناموفق"
                    variant="tonal"
                    @click="handleCallbackStatus(false)"
                ></v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import ApiService from "@/Core/services/ApiService";
import { useRoute } from "vue-router";

const form = ref({});
const route = useRoute();
const fetchWalelt = async () => {
    const { data } = await ApiService.get(
        `application/gateway/detail/${route.params.id}`
    );

    form.value = data.data;
};

const handleCallbackStatus = async (status) => {
    const { data } = await ApiService.post(
        `application/gateway/detail/purchase/status/${route.params.id}`,
        {
            success: status,
        }
    );

    window.location.replace(data.data);
};

onMounted(() => {
    console.log("hereee");

    fetchWalelt();
});
</script>

<style scoped></style>
