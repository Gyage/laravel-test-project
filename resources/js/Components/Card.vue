<script setup>
import { computed } from 'vue';
const props = defineProps({
    rowClass: {
        type: String,
        default: ''
    },
});

const classes = computed(() => {
    return props.rowClass.concat(" bg-gray-200 bg-opacity-25 grid grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-8"); 
});
</script>

<template>
    <div class="py-6 pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200" >
                    <div class="flex items-start">
                        <slot name="header" />
                    </div> 
                </div>
                <div :class="classes">
                    <slot name="rows" />
                </div>
            </div>
        </div>
    </div>
</template>
