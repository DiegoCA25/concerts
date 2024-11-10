<script setup>
import Form from './Form.vue';
const props = defineProps({
    artists:{type:Object}
});
</script>

<template>
    <Form :artists="artists" />
</template>