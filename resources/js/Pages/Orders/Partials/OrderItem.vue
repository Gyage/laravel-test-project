<script setup>
import DeleteOrderItemForm from './DeleteOrderItemForm.vue';
import EditOrderItemForm from './EditOrderItemForm.vue';
import { Link } from '@inertiajs/vue3';


const props = defineProps({
    orderitem: Object,
    order: Object,
});

</script>
<template>
    <div class="flex items-stretch">
        <h2 class="w-1/6 text-xl font-semibold text-gray-900">
            {{ orderitem.count }} pieces 
        </h2>
        <h2 class="w-1/6 text-xl font-semibold text-gray-900">
            <Link :href="route('products_show', {id: orderitem.product.id})">
                {{ orderitem.product.name}}
            </Link>
        </h2>
        <h2 class="w-1/6 text-xl font-semibold text-gray-900 items-end">
            Subtotal: {{ orderitem.subtotal }}
        </h2>
        <h2 class="mx-3 text-xl font-semibold text-gray-900" v-if="!order.is_finished">
            <DeleteOrderItemForm :orderitem="orderitem" :order="order"/>
        </h2>
        <h2 class="mx-3 text-xl font-semibold text-gray-900" v-if="!order.is_finished">
            <EditOrderItemForm :orderitem="orderitem" :order="order" class="inline-flex items-center font-semibold text-indigo-700"/>
        </h2>
    </div>                 
</template>
