<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link } from '@inertiajs/vue3';

import CRUD from '@/Components/CRUD.vue';

export default {
    
    props: {
        errors: Object,
        sections: Object,
        subjects: Object,
    },

    data: function () {
        return {
            crud : {
                title: 'Subject In Group Manager',
                model: 'SubjectInGroup',
                files: '',
                data: null,
                rows: 10,
                orderBy: 'id',
                order: 'desc',
                with: 'section,grade,subject_group,subject',
                whereHas: '',
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
                        display:true,
                        display_value: 'section,name',
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
                        field:'subject_id',
                        text:'Subject',
                        type:'select',
                        value:null,
                        values:this.subjects,
                        validation:'required',
                        display:true,
                        display_value: 'subject,name',
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },
                    {
                        field: 'lectures_per_week',
                        text: 'Lectures per week',
                        type: 'text',
                        value: '',
                        validation: '',
                        display: true,
                        isForm: true,
                        isSearch: true,
                        colWidth: 'w-20',
                        fieldWidth: 'w-full' 
                    },
                    {
                        field:'is_consecutive',
                        text:'Is Cosecutive',
                        type:'select',
                        value:null,
                        values:[
                            {id: 'Yes', text: 'Yes'},
                            {id: 'No', text: 'No'},
                            {id: 'Any', text: 'Any'},
                        ],
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },

                    {
                        field:'is_graded',
                        text:'Is Graded',
                        type:'select',
                        value:null,
                        values:[
                            {id: 'Yes', text: 'Yes'},
                            {id: 'No', text: 'No'},
                        ],
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },

                    {
                        field:'min_lect_per_day',
                        text:'Minimumm Lectures per Day',
                        type:'select',
                        value:null,
                        values:[
                            {id: '0', text: '0'},
                            {id: '1', text: '1'},
                            {id: '2', text: '2'},
                            {id: '3', text: '3'},
                            {id: '4', text: '4'},
                            {id: '5', text: '5'},
                            {id: '6', text: '6'},
                            {id: '7', text: '7'},
                            {id: '8', text: '8'},
                            {id: '9', text: '9'},
                        ],
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'max_lect_per_day',
                        text:'Maximun Lectures per Day',
                        type:'select',
                        value:null,
                        values:[
                            {id: '0', text: '0'},
                            {id: '1', text: '1'},
                            {id: '2', text: '2'},
                            {id: '3', text: '3'},
                            {id: '4', text: '4'},
                            {id: '5', text: '5'},
                            {id: '6', text: '6'},
                            {id: '7', text: '7'},
                            {id: '8', text: '8'},
                            {id: '9', text: '9'},
                        ],
                        validation:'required',
                        display:false,
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

    <Head title="Grades" />

    <Administrator>

        <CRUD :crud="crud" @onChange="change($event)"></CRUD>

    </Administrator>

</template>
