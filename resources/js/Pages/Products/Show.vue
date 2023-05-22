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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{product.name}}
            </h2>
            <div class="ml-3 relative">
                <CreateProductForm/>
            </div>
        </template>

            <div class="pt-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <LargeCard :product="product"/>
                    </div>
                </div>
            </div>
            <div class="py-6" v-if="$page.props.auth.user.id == product.user_id">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        
                    </div>
                </div>
            </div>
        
    </AppLayout>
</template>
