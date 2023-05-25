<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ProductForm from './ProductForm.vue';

const confirmingProductEdit = ref(false);
const props = defineProps({
    product: Object,
});

const form = useForm({
    _method: 'PUT',
    name: props.product.name,
    price_1: props.product.price_1,
    price_3: props.product.price_3,
    price_5: props.product.price_5,
});
const openProductedit = () => {
    confirmingProductEdit.value = true;
};

const editProduct = () => {
    form.put(route('products_update', props.product.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingProductEdit.value = false;

    form.reset();
};
</script>

<template>
            <div class="m-2">
                <PrimaryButton @click="openProductedit">
                    Termék Módosítása
                </PrimaryButton>
            </div>
            
            <DialogModal :show="confirmingProductEdit" @close="closeModal">
                <template #title>
                    Termék Módosítása
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
                        @click="editProduct"
                    >
                        Termék Módosítása
                    </PrimaryButton>
                </template>
            </DialogModal>
</template>
