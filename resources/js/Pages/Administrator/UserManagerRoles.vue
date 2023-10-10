<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link } from '@inertiajs/vue3';

import CRUD from '@/Components/CRUD.vue';

export default {
    
    props: {
        errors: Object,
        roles: Object,
        user: Object,
    },

    data: function () {
        return {
            crud : {
                title: this.user.name,
                model: 'UserRole',
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
                        field: 'user_id',
                        text: 'User ID',
                        type: 'text',
                        value: this.user.id,
                        validation: '',
                        display: true,
                        display_value: 'user,name',
                        isForm: true,
                        isSearch: true,
                        colWidth: 'w-auto',
                        fieldWidth: 'w-full' 
                    },
                    {
                        field: 'role',
                        text: 'Role',
                        type: 'select',
                        value: '',
                        values: [
                            {id: 'Accountant', text: 'Accountant'},
                            {id: 'Administrator', text: 'Administrator'},
                            {id: 'Branch Administrator', text: 'Branch Administrator'},
                            {id: 'Head', text: 'Head'},
                            {id: 'Principal', text: 'Principal'},
                            {id: 'Student', text: 'Student'},
                            {id: 'Teacher', text: 'Teacher'},
                        ],
                        validation: '',
                        display: true,
                        isForm: true,
                        isSearch: true,
                        colWidth: 'w-auto',
                        fieldWidth: 'w-full' 
                    },
                ],
                orderBy: 'id',
                order: 'desc',
                with: 'user',
                where: 'user_id,=,'+this.user.id,
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

    <Head title="User Manager Roles" />

    <Administrator>

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
