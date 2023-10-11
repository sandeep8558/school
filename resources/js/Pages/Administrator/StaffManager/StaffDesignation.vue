<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link } from '@inertiajs/vue3';

import CRUD from '@/Components/CRUD.vue';

export default {
    
    props: {
        errors: Object,
        designations: Object,
    },

    data: function () {
        return {

            crud : {
                title: 'Staff Designations',
                model: 'StaffDesignation',
                files: '',
                data: null,
                rows: 10,
                orderBy: 'id',
                order: 'desc',
                with: 'staff,designation',
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
                        display_value: 'staff,full_name',
                        isForm:false,
                        isSearch:false,
                        colWidth:'w-28',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'staff_id',
                        text:'Staff ID',
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
                        field:'designation_id',
                        text:'Designation',
                        type:'select',
                        value:null,
                        values: this.designations,
                        validation:'required',
                        display:true,
                        display_value: 'designation,designation',
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
            this.crud.whereHas = this.$page.props.gbranch ? 'staff,branch_id,' + this.$page.props.gbranch.id : null;
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

    <Head title="Staff Designation" />

    <Administrator>

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
