<script setup>
import Form from './Form.vue';
const props = defineProps({
    artists:{type:Object},
    concert:{type:Object},
    artistsOfConcert:{type:Object},
});
</script>

<template>
    <Form :artists="artists" :concert="concert" 
    :artistsOfConcert="artistsOfConcert" />
</template>