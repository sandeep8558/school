<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link } from '@inertiajs/vue3';

import CRUD from '@/Components/CRUD.vue';

export default {
    
    props: {
        errors: Object,
        sections: Object,
    },

    data: function () {
        return {

            crud : {
                title: 'Subject Book Manager',
                model: 'SubjectBook',
                files: '',
                data: null,
                rows: 10,
                orderBy: 'id',
                order: 'desc',
                with: 'grade,subject_group,subject',
                whereHas: null,
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
                        colWidth: 'w-20',
                        fieldWidth: 'w-full'
                    },
                    {
                        field:'section_id',
                        text:'Section name',
                        type:'select',
                        value:null,
                        values:this.sections,
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'grade_id',
                        text:'Grade',
                        type:'select',
                        value:null,
                        values:[],
                        validation:'required',
                        display:true,
                        display_value: 'grade,name',
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'subject_group_id',
                        text:'Subject Group',
                        type:'select',
                        value:null,
                        values:[],
                        validation:'required',
                        display:true,
                        display_value: 'subject_group,name',
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'subject_in_group_id',
                        text:'Subject',
                        type:'select',
                        value:null,
                        values:[],
                        validation:'required',
                        display:true,
                        display_value: 'subject,name',
                        isForm:true,
                        isSearch:false,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'publication',
                        text:'Publication',
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
                        field:'book_title',
                        text:'Book Title',
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
                        field:'status',
                        text:'Status',
                        type:'select',
                        value:null,
                        values:[{id: 'Active', text: 'Active'}, {id: 'Absolute', text: 'Absolute'},],
                        validation:'required',
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

        async change(e){
            if(e.key == 'section_id'){
                let a = await fetch('/grade_manager/fetch/grade/' + e.val);
                this.crud.table[2].values = await a.json();
                this.crud.table[2].value = null;
            }
            if(e.key == 'grade_id'){
                let a = await fetch('/grade_manager/fetch/subject_group/' + e.val);
                this.crud.table[3].values = await a.json();
                this.crud.table[3].value = null;
            }
            if(e.key == 'subject_group_id'){
                let a = await fetch('/grade_manager/fetch/subject_in_group/' + e.val);
                this.crud.table[4].values = await a.json();
                this.crud.table[4].value = null;
            }
        },

        init(){
            this.crud.whereHas = this.$page.props.gbranch ? 'section,branch_id,' + this.$page.props.gbranch.id : null;
        },

    },

    mounted: function() {
    },

    created: function() {
        this.init();
    },

    components: { Administrator, Head, Link, CRUD }
}
</script>

<template>

    <Head title="Grade Subject Books" />

    <Administrator>

        <CRUD :crud="crud" @onChange="change($event)"></CRUD>

    </Administrator>

</template>
