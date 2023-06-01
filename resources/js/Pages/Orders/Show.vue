<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import LargeCard from '@/Pages/Orders/Partials/LargeCard.vue';

const props = defineProps({
    order: Object,
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Shopping Cart
            </h2>
        </template>

        <div v-if="order === null">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200" >
                <h1 class="mt-8 text-2xl font-medium text-gray-900">
                    Your cart is empty.
                </h1>
            </div>
        </div>
        <LargeCard :order="order" v-else/>     
        
    </AppLayout>
</template>
