<template>
    <div>
        <v-card flat>
            <v-toolbar
                image="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg"
                color="primary"
                dark
                extended
                flat
            >
            </v-toolbar>

            <v-card class="mx-auto" max-width="700" style="margin-top: -64px">
                <v-toolbar flat>
                    <v-toolbar-title class="text-grey">
                        {{ wallet?.name }}
                    </v-toolbar-title>

                    <v-spacer></v-spacer>

                    <v-btn
                        @click="recharge_wallet_visible = true"
                        class="me-2 text-none"
                        color="#4f545c"
                        prepend-icon="mdi-cash"
                        variant="flat"
                    >
                        شارژ
                    </v-btn>

                    <v-btn
                        class="me-2 text-none"
                        color="#4f545c"
                        prepend-icon="mdi-arrow-down-bold-box-outline"
                        variant="flat"
                    >
                        برداشت
                    </v-btn>

                    <v-btn
                        class="me-2 text-none"
                        color="#4f545c"
                        prepend-icon="mdi-export-variant"
                        variant="flat"
                    >
                        انتقال
                    </v-btn>
                </v-toolbar>

                <v-divider></v-divider>

                <v-card-text style="height: 200px"></v-card-text>
            </v-card>
        </v-card>

        <v-dialog v-model="recharge_wallet_visible" max-width="600">
            <v-card title="شارژ کیف پول">
                <v-card-text>
                    <v-row dense>
                        <v-col cols="12" md="12" sm="12">
                            <v-text-field
                                required
                                class="text-center"
                                type="number"
                                label="مقدار*"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions class="flex justify-between items-center">
                    <div>
                        <v-btn
                            color="primary"
                            text="ادامه"
                            variant="tonal"
                            @click="handleCredit"
                        ></v-btn>
                        <v-btn
                            text="لغو"
                            variant="plain"
                            @click="recharge_wallet_visible = false"
                        ></v-btn>
                    </div>
                    <div></div>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import ApiService from "@/Core/services/ApiService";
import { useRoute } from "vue-router";
const wallet = ref({});
const route = useRoute();
const fetchWalelt = async () => {
    const { data } = await ApiService.get(
        `application/user/wallets/${route.params.id}`
    );
    wallet.value = data.data;
};
const recharge_wallet_visible = ref(false);

const handleCredit = async () => {
    const { data } = await ApiService.post(
        `application/user/wallets/credit/${route.params.id}`
    );

    window.location.replace(data.data);
};

onMounted(() => {
    fetchWalelt();
});
</script>

<style scoped></style>
