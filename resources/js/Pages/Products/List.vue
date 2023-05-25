<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import LargeCard from '@/Pages/Products/Partials/LargeCard.vue';
import CreateProductForm from '@/Pages/Products/Partials/CreateProductForm.vue';

const props = defineProps({
    products: Object,
});

</script>

<template>
    <AppLayout title="Termékek">
        <template #header>
            <div class="w-5/6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Termékek
                </h2>
            </div>
            <div class="w-1/6">
                <CreateProductForm/>
            </div>
        </template>

        <LargeCard :product="product" v-for="product in products"/>
        
    </AppLayout>
</template>
