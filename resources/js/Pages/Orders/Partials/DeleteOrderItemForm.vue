<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const confirmingOrderItemDeletion = ref(false);

const props = defineProps({
    orderitem: Object,
    order: Object,
});

const form = useForm({
    password: '',
});

const confirmOrderItemDeletion = () => {
    confirmingOrderItemDeletion.value = true;
};

const deleteOrderItem = () => {
    form.delete(route('order_items_destroy',{order: props.order.id, orderitem: props.orderitem.id}), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingOrderItemDeletion.value = false;

    form.reset();
};
</script>

<template>
            <div class="m-2">
                <DangerButton @click="confirmOrderItemDeletion">
                    Delete Item
                </DangerButton>
            </div>

            <DialogModal :show="confirmingOrderItemDeletion" @close="closeModal">
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
                        @click="deleteOrderItem"
                    >
                        Delete Item
                    </DangerButton>
                </template>
            </DialogModal>
</template>
