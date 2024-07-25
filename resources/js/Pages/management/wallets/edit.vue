<template>
    <div>
        <base-skeleton animated :loading="loader">
            <template #template>
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 lg:col-span-12">
                        <base-skeleton-item
                            variant="card"
                            class="h-[500px]"
                        ></base-skeleton-item>
                    </div>
                </div>
            </template>
            <template #default>
                <v-sheet>
                    <div class="mb-6">
                        <h2 class="text-xl">ویرایش کیف پول</h2>
                    </div>
                    <Form ref="formRef" @submit="handleUpdate">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-4">
                                <v-text-field
                                    v-model="form.name"
                                    hint=""
                                    label="نام"
                                    single-line
                                ></v-text-field>
                            </div>

                            <div class="col-span-4">
                                <v-select
                                    v-model="form.type"
                                    label="انتخاب  نوع کیف پول"
                                    :items="types"
                                    item-title="state"
                                    item-value="value"
                                ></v-select>
                            </div>

                            <div class="col-span-4">
                                <v-select
                                    v-model="form.status"
                                    label="وضعیت"
                                    :items="statuses"
                                    item-title="state"
                                    item-value="value"
                                ></v-select>
                            </div>

                            <div class="col-span-12">
                                <v-text-field
                                    v-model="form.description"
                                    label="توضیحات"
                                    density="compact"
                                    single-line
                                    persistent-hint
                                    hint=" "
                                ></v-text-field>
                            </div>
                        </div>

                        <v-btn
                            :loading="loading"
                            color="light-blue-accent-4"
                            type="submit"
                            block
                            class="mt-2"
                            >ویرایش</v-btn
                        >
                    </Form>
                </v-sheet>
            </template>
        </base-skeleton>

        <v-snackbar absolute v-model="visible_success_message" :timeout="20000">
            کیف پول با موفقیت ویرایش شد.
        </v-snackbar>
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref, watchEffect } from "vue";
import ApiService from "@/Core/services/ApiService";
import { useRoute, useRouter } from "vue-router";
import { ErrorMessage, Field, Form } from "vee-validate";
import { BaseSkeleton, BaseSkeletonItem } from "@/Components/skeleton";
const loader = ref(true);
const loading = ref(false);
const formRef = ref(null);
const form = ref({
    name: null,
    description: null,
    type: null,
    status: null,
});
const types = ref([
    { state: "paypal", value: "paypal" },
    { state: "webmoney", value: "webmoney" },
    { state: "perfectmoney", value: "perfectmoney" },
]);
const statuses = ref([
    { state: "فعال", value: "active" },
    { state: "غیرفعال", value: "inactive" },
]);

const visible_success_message = ref(false);
const rules = ref([
    (value) => {
        if (value) return true;
        return "نام   کیف  پول  الزامی می باشد";
    },
]);
const router = useRouter();
const route = useRoute();
const handleUpdate = async (event) => {
    const { valid } = await formRef.value.validate();
    if (valid) {
        loading.value = true;
        const form_data = new FormData();
        form_data.append("name", form.value.name);
        form_data.append("description", form.value.description);
        form_data.append("type", form.value.type);
        form_data.append("status", form.value.status);

        const { data } = await ApiService.put(
            `management/wallets/${route.params.id}`,
            form_data
        );
        if (data.status == 200) {
            visible_success_message.value = true;
            router.push({ name: "management-wallets-index" });
        }
    }
};

const fetchData = async () => {
    const { data } = await ApiService.get(
        `management/wallets/${route.params.id}`
    );
    form.value.name = data.data.name;
    form.value.description = data.data.description;
    form.value.status = data.data.status;
    form.value.type = data.data.type;
    loader.value = false;
};

watchEffect(() => {
    if (formRef.value) {
        formRef.value.setValues({
            ...form.value,
        });
    }
});

onMounted(() => {
    fetchData();
});
</script>

<style scoped></style>
