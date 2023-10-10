<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link } from '@inertiajs/vue3';

import CRUD from '@/Components/CRUD.vue';

export default {
    
    props: {
        errors: Object,
        branches: Object,
    },

    data: function () {
        return {
            crud : {
                title: 'User Manager',
                model: 'User',
                files: '',
                data: null,
                rows: 10,
                table: [
                    {
                        field: 'id',
                        text: 'No.',
                        type: 'text',
                        value: '',
                        validation: '',
                        display: true,
                        isForm: false,
                        isSearch: true,
                        colWidth: 'w-28',
                        fieldWidth: 'w-full' 
                    },
                    {
                        field: 'name',
                        text: 'Name.',
                        type: 'text',
                        value: '',
                        validation: '',
                        display: true,
                        isForm: true,
                        isSearch: true,
                        colWidth: 'w-auto',
                        fieldWidth: 'w-full' 
                    },
                    {
                        field: 'mobile',
                        text: 'Mobile.',
                        type: 'text',
                        value: '',
                        validation: '',
                        display: true,
                        isForm: true,
                        isSearch: true,
                        colWidth: 'w-auto',
                        fieldWidth: 'w-full' 
                    },
                    {
                        field: 'email',
                        text: 'Email.',
                        type: 'text',
                        value: '',
                        validation: '',
                        display: true,
                        isForm: true,
                        isSearch: true,
                        colWidth: 'w-auto',
                        fieldWidth: 'w-full' 
                    },
                    {
                        field: 'branch_id',
                        text: 'Branch.',
                        type: 'select',
                        value: '',
                        values: this.branches,
                        validation: '',
                        display: true,
                        display_value: 'branch,name',
                        isForm: true,
                        isSearch: true,
                        colWidth: 'w-auto',
                        fieldWidth: 'w-full' 
                    },
                    {
                        field: 'roles',
                        text: 'Roles.',
                        type: 'select',
                        value: '',
                        values: this.branches,
                        validation: '',
                        display: true,
                        isForm: false,
                        isSearch: false,
                        colWidth: 'w-auto',
                        fieldWidth: 'w-full' 
                    },
                ],
                orderBy: 'id',
                order: 'desc',
                with: 'branch',
                buttons: [{route: '/user_manager/roles/{id}', text: 'Roles'}],
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

    <Head title="User Manager" />

    <Administrator>

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
