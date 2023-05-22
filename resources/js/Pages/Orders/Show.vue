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
                Kosár
            </h2>
        </template>

            <div class="pt-12" v-if="order.length > 0">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <LargeCard :order="order[0]"/>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200" >
                    <h1 class="mt-8 text-2xl font-medium text-gray-900">
                        A kosara üres
                    </h1>
                </div>
            </div>

        
    </AppLayout>
</template>
