<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link } from '@inertiajs/vue3';

import CRUD from '@/Components/CRUD.vue';

export default {
    
    props: {
        errors: Object,
    },

    data: function () {
        return {
            crud : {
                title: 'Section Manager',
                model: 'Section',
                files: '',
                data: null,
                rows: 10,
                table: [
                    { field: 'id', text: 'No.', type: 'text', value: '', validation: '', display: true, isForm: false, isSearch: true, colWidth: 'w-20', fieldWidth: 'w-full' },
                    { field: 'name', text: 'Section name', type: 'text', value: null, validation: 'required', display: true, isForm: true, isSearch: true, colWidth: 'w-auto', fieldWidth: 'w-full' },
                ],
                orderBy: 'id',
                order: 'asc',
                with: '',
            },
        };
    },

    methods: {
    },

    mounted: function() {
    },

    components: { Administrator, Head, Link, CRUD }
}
</script>

<template>

    <Head title="Sections" />

    <Administrator>

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
