<script setup>
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import NumberInput from '@/Components/NumberInput.vue';

const props = defineProps({
    form: Object
});

</script>

<template>
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
        <NumberInput
            id="price_1"
            v-model="form.price_1"
            class="mt-1 block w-full"
            autocomplete="price_1"
        />
        <InputError :message="form.errors.price_1" class="mt-2" />
    </div>
    <div class="mt-4">
        <InputLabel for="price_3" value="3 darab ára" />
        <NumberInput
            id="price_3"
            v-model="form.price_3"
            class="mt-1 block w-full"
            autocomplete="price_3"
        />
        <InputError :message="form.errors.price_3" class="mt-2" />
    </div>
    <div class="mt-4">
        <InputLabel for="price_5" value="5 darab ára" />
        <NumberInput
            id="price_5"
            v-model="form.price_5"
            class="mt-1 block w-full"
            autocomplete="price_5"
        />
        <InputError :message="form.errors.price_5" class="mt-2" />
    </div>
</template>
