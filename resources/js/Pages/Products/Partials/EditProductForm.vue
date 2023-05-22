<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';

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
        onError: () => console.log(form),
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
                    <div class="mt-4">
                        <InputLabel for="name" value="Név" />
                        <TextInput
                            id="name"
                            v-model="form.name"
                            type="text"
                            class="mt-1 block w-full"
                            autocomplete="name"
                        />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="price_1" value="1 darab ára" />
                        <TextInput
                            id="price_1"
                            v-model="form.price_1"
                            type="text"
                            class="mt-1 block w-full"
                            autocomplete="price_1"
                        />
                        <InputError :message="form.errors.price_1" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="price_3" value="3 darab ára" />
                        <TextInput
                            id="price_3"
                            v-model="form.price_3"
                            type="text"
                            class="mt-1 block w-full"
                            autocomplete="price_3"
                        />
                        <InputError :message="form.errors.price_3" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="price_5" value="5 darab ára" />
                        <TextInput
                            id="price_5"
                            v-model="form.price_5"
                            type="text"
                            class="mt-1 block w-full"
                            autocomplete="price_5"
                        />
                        <InputError :message="form.errors.price_5" class="mt-2" />
                    </div>
                    
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
