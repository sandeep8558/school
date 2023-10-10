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
                title: 'Subject Group Manager',
                model: 'SubjectGroup',
                files: '',
                data: null,
                rows: 10,
                orderBy: 'id',
                order: 'desc',
                with: 'section,grade',
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
                        field: 'name',
                        text: 'Subject Group Name.',
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
                        field:'least',
                        text:'Least',
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
                            {id: '10', text: '10'},
                            {id: '11', text: '11'},
                            {id: '12', text: '12'},
                            {id: '13', text: '13'},
                            {id: '14', text: '14'},
                            {id: '15', text: '15'},
                            {id: '16', text: '16'},
                            {id: '17', text: '17'},
                            {id: '18', text: '18'},
                            {id: '19', text: '19'},
                            {id: '20', text: '20'},
                        ],
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
