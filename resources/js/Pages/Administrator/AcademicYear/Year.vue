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
                title: 'Academic Year',
                model: 'AcademicYear',
                files: '',
                data: null,
                rows: 10,
                orderBy: 'id',
                order: 'desc',
                with: 'branch',
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
                        field:'branch_id',
                        text:'Branch',
                        type:'select',
                        value:null,
                        values: [],
                        validation:'required',
                        display:false,
                        display_value: 'branch,name',
                        isForm:true,
                        isSearch:false,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2'
                    },
                    {
                        field:'name',
                        text:'Academic Year Name.',
                        type:'text',
                        value:'',
                        validation:'',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-28',
                        fieldWidth:'w-full md:w-1/2'
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
                        fieldWidth:'w-1/2'
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
                        fieldWidth:'w-1/2'
                    },

                    {
                        field:'is_admission_closed',
                        text:'Admission Closed',
                        type:'select',
                        value:null,
                        values:[
                            { id: 'Yes', text: 'Yes' },
                            { id: 'No', text: 'No' },
                        ],
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-1/2'
                    },

                    {
                        field:'is_academic_year_closed',
                        text:'Year Closed',
                        type:'select',
                        value:null,
                        values:[
                            { id: 'Yes', text: 'Yes' },
                            { id: 'No', text: 'No' },
                        ],
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-1/2'
                    },

                ],
            },

        };
    },

    methods: {
        init(){
            let gbranch = this.$page.props.gbranch;
            if(gbranch){
                this.crud.table[1].value = gbranch.id
                this.crud.table[1].values = [{
                    id: gbranch.id,
                    text: gbranch.name
                }];
                this.crud.where = 'branch_id,=,'+gbranch.id;
            }
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

    <Head title="Academic Year" />

    <Administrator>

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
