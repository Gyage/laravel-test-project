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
                Vásárlások
            </h2>
        </template>


        <div v-for="order in orders">
            <div class="pt-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <LargeCard :order="order"/>
                    </div>
                </div>
            </div>
        </div>
        
    </AppLayout>
</template>
