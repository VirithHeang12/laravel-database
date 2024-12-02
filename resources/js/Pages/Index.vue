<template>
    <div>
        <h1>Index Page</h1>
        <p>{{ title }}</p>
    </div>
</template>


<script setup>

    import { defineProps } from 'vue';

    defineProps({
        title: {
            type: String,
            required: true,
        },
    });

</script>
