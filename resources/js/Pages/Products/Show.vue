<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import LargeCard from '@/Pages/Products/Partials/LargeCard.vue';
import CreateProductForm from './Partials/CreateProductForm.vue';

const props = defineProps({
    product: Object,
});

</script>

<template>
    <AppLayout :title="product.name">
        <template #header>
            <div class="w-5/6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ product.name }}
                </h2>
            </div>
            <div class="ml-3 relative">
                <CreateProductForm/>
            </div>
        </template>

        <LargeCard :product="product"/>
        
    </AppLayout>
</template>
