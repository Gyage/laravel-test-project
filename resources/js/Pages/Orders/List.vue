<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import LargeCard from '@/Pages/Orders/Partials/LargeCard.vue';

const props = defineProps({
    orders: Object,
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Orders
            </h2>
        </template>

        <LargeCard :order="order" v-for="order in orders"/>     

    </AppLayout>
</template>
