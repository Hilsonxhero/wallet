<template>
    <div>
        <v-sheet>
            <div class="mb-6">
                <h2 class="text-xl">ایجاد کیف پول</h2>
            </div>
            <v-form
                ref="formRef"
                validate-on="submit"
                @submit.prevent="handleCreate"
            >
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-6">
                        <v-text-field
                            v-model="form.name"
                            hint=""
                            label="نام"
                            single-line
                        ></v-text-field>
                    </div>

                    <div class="col-span-6">
                        <v-select
                            v-model="form.type"
                            label="انتخاب  نوع کیف پول"
                            :items="types"
                            item-title="state"
                            item-value="value"
                            single-line
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
                    >ایجاد</v-btn
                >
            </v-form>
        </v-sheet>
        <v-snackbar absolute v-model="visible_success_message" :timeout="20000">
            کیف پول با موفقیت ایجاد شد.
        </v-snackbar>
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from "vue";
import ApiService from "@/Core/services/ApiService";
import { useRoute, useRouter } from "vue-router";
const types = ref([
    { state: "paypal", value: "paypal" },
    { state: "webmoney", value: "webmoney" },
    { state: "perfectmoney", value: "perfectmoney" },
]);
const loading = ref(false);
const formRef = ref(null);
const form = ref({
    name: null,
    description: null,
    type: null,
});
const visible_success_message = ref(false);
const rules = ref([
    (value) => {
        if (value) return true;
        return "نام   کیف پول  الزامی می باشد";
    },
]);
const router = useRouter();

const route = useRoute();

const handleCreate = async (event) => {
    const { valid } = await formRef.value.validate();
    if (valid) {
        loading.value = true;
        const form_data = new FormData();
        form_data.append("name", form.value.name);
        form_data.append("description", form.value.description);
        form_data.append("type", form.value.type);
        const { data } = await ApiService.post(`management/wallets`, form_data);
        if (data.status == 200) {
            visible_success_message.value = true;
            router.push({ name: "management-wallets-index" });
        }
    }
};

const fetchData = async () => {};

onMounted(() => {
    fetchData();
});
</script>

<style scoped></style>
