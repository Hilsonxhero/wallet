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

            <v-card class="mx-auto" max-width="900" style="margin-top: -64px">
                <v-toolbar flat>
                    <v-toolbar-title class="text-grey">
                        {{ wallet?.name }}
                    </v-toolbar-title>

                    <v-spacer></v-spacer>

                    <v-btn
                        class="me-2 text-none"
                        color="success"
                        prepend-icon="mdi-cash"
                        variant="flat"
                    >
                        موجودی : {{ wallet?.balance }}
                    </v-btn>

                    <v-btn
                        @click="recharge_wallet_visible = true"
                        class="me-2 text-none"
                        color="#4f545c"
                        prepend-icon="mdi-cash"
                        variant="flat"
                    >
                        افزایش
                    </v-btn>

                    <v-btn
                        class="me-2 text-none"
                        color="#4f545c"
                        prepend-icon="mdi-arrow-down-bold-box-outline"
                        variant="flat"
                        @click="withdraw_wallet_visible = true"
                    >
                        برداشت
                    </v-btn>

                    <v-btn
                        class="me-2 text-none"
                        color="#4f545c"
                        prepend-icon="mdi-export-variant"
                        variant="flat"
                        @click="transfer_wallet_visible = true"
                    >
                        انتقال
                    </v-btn>
                </v-toolbar>

                <v-divider></v-divider>

                <div>
                    <v-table theme="dark">
                        <thead>
                            <tr>
                                <th class="text-right">مبلغ</th>
                                <th class="text-right">از</th>
                                <th class="text-right">به</th>
                                <th class="text-right">نوع تراکنش</th>
                                <th class="text-right">تاریخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in tableData" :key="item.name">
                                <td>{{ item.amount }}</td>
                                <td>{{ item.from }}</td>
                                <td>{{ item.to }}</td>
                                <td>
                                    <template v-if="item.type == 'increment'">
                                        <v-chip color="green"> افزایشی </v-chip>
                                    </template>
                                    <template v-else>
                                        <v-chip color="error"> کاهشی </v-chip>
                                    </template>
                                </td>
                                <td>{{ item.created_at }}</td>
                            </tr>
                        </tbody>
                    </v-table>
                </div>
            </v-card>
        </v-card>

        <v-dialog v-model="transfer_wallet_visible" max-width="600">
            <v-card title="انتقال  موجودی">
                <v-card-text>
                    <div class="my-3">
                        <v-alert
                            border="start"
                            color="primary"
                            title="موجودی قابل انتقال"
                            variant="tonal"
                        >
                            {{ wallet?.balance }}
                        </v-alert>
                    </div>
                    <v-row dense>
                        <v-col cols="12" md="12" sm="12">
                            <v-text-field
                                required
                                class="text-center"
                                type="number"
                                min="1"
                                label="مقدار*"
                                v-model="form.transfer_amount"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" md="12" sm="12">
                            <v-text-field
                                type="email"
                                required
                                class="text-center"
                                label="ایمیل کاربر*"
                                v-model="form.transfer_email"
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
                            @click="handleTransfer"
                        ></v-btn>
                        <v-btn
                            text="لغو"
                            variant="plain"
                            @click="transfer_wallet_visible = false"
                        ></v-btn>
                    </div>
                    <div></div>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog v-model="withdraw_wallet_visible" max-width="600">
            <v-card title="برداشت از کیف پول">
                <v-card-text>
                    <div class="my-3">
                        <v-alert
                            border="start"
                            color="primary"
                            title="موجودی قابل برداشت"
                            variant="tonal"
                        >
                            {{ wallet?.balance }}
                        </v-alert>
                    </div>
                    <v-row dense>
                        <v-col cols="12" md="12" sm="12">
                            <v-text-field
                                required
                                class="text-center"
                                type="number"
                                min="1"
                                label="مقدار*"
                                v-model="form.withdraw_amount"
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
                            @click="handleWithdraw"
                        ></v-btn>
                        <v-btn
                            text="لغو"
                            variant="plain"
                            @click="withdraw_wallet_visible = false"
                        ></v-btn>
                    </div>
                    <div></div>
                </v-card-actions>
            </v-card>
        </v-dialog>

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
                                v-model="form.amount"
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

        <v-snackbar v-model="success_withdraw">
            برداشت از موجودی با موفقیت انجام شد

            <template v-slot:actions>
                <v-btn
                    color="pink"
                    variant="text"
                    @click="success_withdraw = false"
                >
                    بستن
                </v-btn>
            </template>
        </v-snackbar>
        <v-snackbar v-model="withdraw_alert">
            برداشت نامعتبر

            <template v-slot:actions>
                <v-btn
                    color="pink"
                    variant="text"
                    @click="success_withdraw = false"
                >
                    بستن
                </v-btn>
            </template>
        </v-snackbar>
        <v-snackbar v-model="user_exists_alert">
            کاربری با این مشخصات وجود ندارد

            <template v-slot:actions>
                <v-btn
                    color="pink"
                    variant="text"
                    @click="user_exists_alert = false"
                >
                    بستن
                </v-btn>
            </template>
        </v-snackbar>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import ApiService from "@/Core/services/ApiService";
import { useRoute } from "vue-router";
const tableData = ref([]);
const wallet = ref({});
const route = useRoute();
const fetchWalelt = async () => {
    const { data } = await ApiService.get(
        `application/user/wallets/${route.params.id}`
    );
    wallet.value = data.data;
    tableData.value = wallet.value.transactions;
};
const success_withdraw = ref(false);
const withdraw_alert = ref(false);
const user_exists_alert = ref(false);

const form = ref({
    amount: 0,
    withdraw_amount: null,
    transfer_amount: null,
    transfer_email: null,
});
const recharge_wallet_visible = ref(false);
const withdraw_wallet_visible = ref(false);
const transfer_wallet_visible = ref(false);

const handleCredit = async () => {
    const { data } = await ApiService.post(
        `application/user/wallets/credit/${route.params.id}`,
        {
            amount: form.value.amount,
        }
    );

    window.location.replace(data.data);
};
const handleWithdraw = async () => {
    if (Number(form.value.withdraw_amount) > Number(wallet.value.balance)) {
        withdraw_alert.value = true;
    } else {
        const { data } = await ApiService.post(
            `application/user/wallets/withdraw/${route.params.id}`,
            {
                amount: form.value.withdraw_amount,
            }
        );
        if (data.status == "200") {
            wallet.value = data.data;
            tableData.value = wallet.value.transactions;
            withdraw_wallet_visible.value = false;
            success_withdraw.value = true;
        } else {
        }
    }
};
const handleTransfer = async () => {
    if (Number(form.value.transfer_amount) > Number(wallet.value.balance)) {
        withdraw_alert.value = true;
    } else {
        const { data } = await ApiService.post(
            `application/user/wallets/transfer/${route.params.id}`,
            {
                amount: form.value.transfer_amount,
                email: form.value.transfer_email,
            }
        );
        if (data.status == "200" && data.data) {
            wallet.value = data.data;
            tableData.value = wallet.value.transactions;
            transfer_wallet_visible.value = false;
            success_withdraw.value = true;
        } else {
            user_exists_alert.value = true;
        }
    }
};

onMounted(() => {
    fetchWalelt();
});
</script>

<style scoped></style>
