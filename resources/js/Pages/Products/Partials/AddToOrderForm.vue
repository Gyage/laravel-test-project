<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


const props = defineProps({
    product: Object,
    count: Number,
});

const form = useForm({
    count: props.count,
    product_id: props.product.id,
});

const submit = () => {
    form.put(route('orders_update'), {
        preserveScroll: true,
        onFinish: () => form.reset(),
    });
};


</script>

<template>
<form @submit.prevent="submit">
            <div>
                <TextInput
                    id="count"
                    v-model="form.count"
                    type="number"
                    class=""
                    required
                    autofocus
                    autocomplete="count"
                    min="1"
                />
                <InputError class="mt-2" :message="form.errors.count" />
            </div>
                <PrimaryButton class="m-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Vásárlás
                </PrimaryButton>
        </form>
</template>
