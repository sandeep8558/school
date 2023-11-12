<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {
    
    props: {
        errors: Object,
    },

    data: function () {
        return {
        };
    },

    methods: {
    },

    mounted: function() {
    },

    components: { Administrator, Head, Link }
}
</script>

<template>

    <Head title="Applications" />

    <Administrator>
    </Administrator>

</template>