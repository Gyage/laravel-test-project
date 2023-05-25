<script setup>
import DeleteOrderForm from './DeleteOrderForm.vue';
import FinishOrderForm from './FinishOrderForm.vue';
import OrderItem from './OrderItem.vue';
import Card from '@/Components/Card.vue';

const props = defineProps({
    order: Object,
});

</script>

<template>
    <Card>
        <template #header>
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
        </template>
        <template #rows>
            <OrderItem 
                v-for="orderitem in order.orderitems"
                :orderitem="orderitem"  
                :order="order"  
                />
        </template>
    </Card>
</template>
