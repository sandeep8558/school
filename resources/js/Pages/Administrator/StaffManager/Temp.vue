<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link } from '@inertiajs/vue3';

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

    <Head title="Template" />

    <Administrator>
    </Administrator>

</template>
