<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const confirmingOrderDeletion = ref(false);

const props = defineProps({
    order: Object,
});

const form = useForm({
    password: '',
});

const confirmOrderDeletion = () => {
    confirmingOrderDeletion.value = true;
};

const deleteOrder = () => {
    form.delete(route('orders_destroy', props.order.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingOrderDeletion.value = false;

    form.reset();
};
</script>

<template>
            <div class="m-1">
                <DangerButton @click="confirmOrderDeletion">
                    Delete Order
                </DangerButton>
            </div>

            <DialogModal :show="confirmingOrderDeletion" @close="closeModal">
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
                        @click="deleteOrder"
                    >
                        Delete Order
                    </DangerButton>
                </template>
            </DialogModal>
</template>
