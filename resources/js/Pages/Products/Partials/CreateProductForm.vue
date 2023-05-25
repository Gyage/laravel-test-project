<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ProductForm from './ProductForm.vue';

const confirmingProductEdit = ref(false);

const form = useForm({
    name: '',
    price_1: '',
    price_3: '',
    price_5: '',
});

const storeProduct = () => {
    form.post(route('products_store'), {
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const openProductedit = () => {
    confirmingProductEdit.value = true;
};

const closeModal = () => {
    confirmingProductEdit.value = false;

    form.reset();
};
</script>

<template>
            <div class="">
                <PrimaryButton @click="openProductedit">
                    Új Termék
                </PrimaryButton>
            </div>

            <DialogModal :show="confirmingProductEdit" @close="closeModal">
                <template #title>
                    Új Termék
                </template>

                <template #content>
                    <ProductForm :form="form" />
                </template>

                <template #footer>
                    <SecondaryButton @click="closeModal">
                        Mégse
                    </SecondaryButton>

                    <PrimaryButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="storeProduct"
                    >
                        Új Termék
                    </PrimaryButton>
                </template>
            </DialogModal>
</template>
