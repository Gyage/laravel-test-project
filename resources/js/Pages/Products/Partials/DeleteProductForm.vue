<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const confirmingProductDeletion = ref(false);

const props = defineProps({
    product: Object,
});

const form = useForm({
    password: '',
});

const confirmProductDeletion = () => {
    confirmingProductDeletion.value = true;
};

const deleteProduct = () => {
    form.delete(route('products_destroy', props.product.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingProductDeletion.value = false;

    form.reset();
};
</script>

<template>
            <div class="m-2">
                <DangerButton @click="confirmProductDeletion">
                    Delete Product
                </DangerButton>
            </div>

            <DialogModal :show="confirmingProductDeletion" @close="closeModal">
                <template #title>
                    Are you sure you want to delete?
                </template>

                <template #footer>
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteProduct"
                    >
                        Delete Product
                    </DangerButton>
                </template>
            </DialogModal>
</template>
