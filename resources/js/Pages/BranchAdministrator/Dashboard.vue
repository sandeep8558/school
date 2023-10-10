<script setup>
import BranchAdministrator from '@/Layouts/BranchAdministrator.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue'

defineProps({
    name: String,
});

onMounted(() => {
})
</script>

<template>

    <Head title="Branch Administrator Dashboard" />

    <BranchAdministrator>




    </BranchAdministrator>

</template>
