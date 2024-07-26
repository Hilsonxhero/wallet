<template>
    <div>
        <div
            class="w-full min-h-screen h-screen flex items-center justify-center"
        >
            <v-card class="mx-auto" max-width="500" width="400">
                <v-card-text>
                    <div></div>

                    <p
                        class="text-xl text-center text-green-700 font-weight-black mt-3"
                    >
                        پرداخت موفقیت آمیز
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
                        :to="{
                            name: 'panel-wallets-detail',
                            params: { id: form?.invoice?.invoiceable_id },
                        }"
                        color="success"
                        text=" کیف پول"
                        variant="tonal"
                    ></v-btn>
                </v-card-actions>
            </v-card>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import ApiService from "@/Core/services/ApiService";
import { useRoute } from "vue-router";

const form = ref({});
const route = useRoute();
const fetchPayment = async () => {
    const { data } = await ApiService.get(
        `application/purchase/payment/confirmation/${route.params.id}`
    );
    form.value = data.data;
};

onMounted(() => {
    fetchPayment();
});
</script>

<style scoped></style>
