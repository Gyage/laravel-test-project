<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const confirmingOrderFinish = ref(false);

const props = defineProps({
    order: Object,
});

const form = useForm({
    is_finished: props.order.is_finished,
});

const confirmOrderFinish = () => {
    confirmingOrderFinish.value = true;
};

const finishOrder = () => {
    form.is_finished = true;

    form.post(route('orders_finish', props.order.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingOrderFinish.value = false;

    form.reset();
};
</script>

<template>
            <div class="m-1">
                <PrimaryButton @click="confirmOrderFinish">
                    Vásárlás véglegesítése
                </PrimaryButton>
            </div>

            <DialogModal :show="confirmingOrderFinish" @close="closeModal">
                <template #title>
                    Biztosan véglegesítési?
                </template>

                <template #footer>
                    <SecondaryButton @click="closeModal">
                        Mégse
                    </SecondaryButton>

                    <PrimaryButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="finishOrder"
                    >
                        Vásárlás véglegesítése
                    </PrimaryButton>
                </template>
            </DialogModal>
</template>
