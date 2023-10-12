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
                title: 'Student Branch',
                model: 'StudentBranch',
                files: '',
                data: null,
                rows: 10,
                orderBy: 'id',
                order: 'desc',
                with: 'student,branch',
                table: [
                    {
                        field:'id',
                        text:'No.',
                        type:'text',
                        value:'',
                        validation:'',
                        display:true,
                        isForm:false,
                        isSearch:true,
                        colWidth:'w-28',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'full_name',
                        text:'Name.',
                        type:'text',
                        value:'',
                        validation:'',
                        display:true,
                        display_value: 'student,full_name',
                        isForm:false,
                        isSearch:false,
                        colWidth:'w-28',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'student_id',
                        text:'Student ID',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'branch_id',
                        text:'Branch',
                        type:'select',
                        value:null,
                        values: this.branches,
                        validation:'required',
                        display:true,
                        display_value: 'branch,name',
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'from',
                        text:'From Date',
                        type:'date',
                        value:null,
                        validation:'',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'to',
                        text:'To Date',
                        type:'date',
                        value:null,
                        validation:'',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },

                ],
            },

        };
    },

    methods: {
        init(){
            this.crud.whereHas = this.$page.props.gbranch ? 'student,branch_id,' + this.$page.props.gbranch.id : null;
        },
    },

    created: function() {
        this.init();
    },

    mounted: function() {
    },

    components: { Administrator, Head, Link, CRUD }
}
</script>

<template>

    <Head title="Student Branch" />

    <Administrator>

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
