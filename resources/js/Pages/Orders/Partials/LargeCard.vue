<script setup>
import { Link } from '@inertiajs/vue3';
import DeleteOrderForm from './DeleteOrderForm.vue';
import FinishOrderForm from './FinishOrderForm.vue';
import DeleteOrderItemForm from './DeleteOrderItemForm.vue';
import EditOrderItemForm from './EditOrderItemForm.vue';


const props = defineProps({
    order: Object,
});

</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200" >
               
                <div class="flex items-start">
                    <h2 class="w-1/4 text-xl font-semibold text-gray-900">
                        Rendelésszám: {{ order.id }}
                    </h2>
                    <h2 class="w-1/4 text-xl font-semibold text-gray-900">
                        Véglegesített: {{ order.is_finished ? 'igen' :  'nem' }}
                    </h2>
                    <h2 class="w-1/4 text-xl font-semibold text-gray-900">
                        Összesen: {{ order.total }}
                    </h2>
                    <h2 class="w-1/8 text-xl font-semibold text-gray-900" 
                        v-if="$page.props.auth.user.id == order.user_id && !order.is_finished">
                        <DeleteOrderForm :order="order"/>
                    </h2>
                    <h2 class="w-1/8 text-xl font-semibold text-gray-900" v-if="$page.props.auth.user.id == order.user_id && !order.is_finished">
                        <FinishOrderForm :order="order"/>
                    </h2>
                </div> 
        </div>
        
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-8" v-for="orderitem in order.orderitems">
                <div class="flex items-stretch">
                    <h2 class="w-1/6 text-xl font-semibold text-gray-900">
                        {{ orderitem.count }} db 
                    </h2>
                    <h2 class="w-1/6 text-xl font-semibold text-gray-900">
                        <Link :href="route('products_show', {id: orderitem.product.id})">
                            {{ orderitem.product.name}}
                        </Link>
                    </h2>
                    <h2 class="w-1/6 text-xl font-semibold text-gray-900 items-end">
                        Részösszesen: {{ orderitem.subtotal }}
                    </h2>
                    <h2 class="mx-3 text-xl font-semibold text-gray-900" v-if="!order.is_finished">
                        <DeleteOrderItemForm :orderitem="orderitem" :order="order"/>
                    </h2>
                    <h2 class="mx-3 text-xl font-semibold text-gray-900" v-if="!order.is_finished">
                        <EditOrderItemForm :orderitem="orderitem" :order="order" class="inline-flex items-center font-semibold text-indigo-700"/>
                    </h2>
                </div>                 
        </div>
    </div>
    
    
</template>
