<script setup>
import { Link } from '@inertiajs/vue3';
import AddToOrderForm from './AddToOrderForm.vue';
import DeleteProductForm from './DeleteProductForm.vue';
import EditProductForm from './EditProductForm.vue';
import PriceTag from './PriceTag.vue';
import Card from '@/Components/Card.vue';


const props = defineProps({
    product: Object,
});

</script>

<template>
    <Card :rowClass="'md:grid-cols-3'">
        <template #header>
            <h2 class="w-1/3 text-xl font-semibold text-gray-900">
                <Link :href="route('products_show', {id: product.id})">
                    {{product.name}}
                </Link>
            </h2>
            <h2 class="mx-1 text-xl font-semibold text-gray-900">
                <AddToOrderForm :product="product" :href="route('orders_update')" class="inline-flex items-center font-semibold text-indigo-700">
                    Vásárlás
                </AddToOrderForm>
            </h2>
            <h2 class="mx-1 text-xl font-semibold text-gray-900" v-if="$page.props.auth.user.id == product.user_id">
                <DeleteProductForm :product="product"/>
            </h2>
            <h2 class="mx-1 text-xl font-semibold text-gray-900" v-if="$page.props.auth.user.id == product.user_id">
                <EditProductForm :product="product"/>
            </h2>
        </template>
        <template #rows>
            <PriceTag>1 db ára: {{product.price_1}} HUF</PriceTag>
            <PriceTag>3 db ára: {{product.price_3}} HUF</PriceTag>
            <PriceTag>5 db ára: {{product.price_5}} HUF</PriceTag> 
        </template>
    </Card>
</template>
