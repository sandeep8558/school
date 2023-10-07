<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link } from '@inertiajs/vue3';

import CRUD from '@/Components/CRUD.vue';

export default {
    
    props: {
        errors: Object,
        grades: Object,
    },

    data: function () {
        return {

            crud : {
                title: 'Grade Subject Remarks',
                model: 'GradeSubjectRemark',
                files: '',
                data: null,
                rows: 10,
                orderBy: 'id',
                order: 'desc',
                with: 'grade,subject',
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
                        field:'grade_id',
                        text:'Grade',
                        type:'select',
                        value:null,
                        values:this.grades,
                        validation:'required',
                        display:true,
                        display_value: 'grade,name',
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },
                    {
                        field: 'subject',
                        text: 'Subject.',
                        type: 'text',
                        value: '',
                        validation: '',
                        display: true,
                        display_value: 'subject,name',
                        isForm: false,
                        isSearch: true,
                        colWidth: 'w-auto',
                        fieldWidth: 'w-full' 
                    },
                    {
                        field:'grade_subject_id',
                        text:'Grade Subject',
                        type:'select',
                        value:null,
                        values:[],
                        validation:'required',
                        display:false,
                        display_value: 'grade_subject,subject_text',
                        isForm:true,
                        isSearch:false,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'code',
                        text:'Remark Code',
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
                        field:'remark',
                        text:'Remark',
                        type:'text',
                        value:null,
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
            if(e.key == 'grade_id'){
                const response = await fetch('/grade_manager/fetch/grade_subject/' + e.val);
                this.crud.table[2].values = await response.json();
            }
        },

        async edit(e){
            console.log(e.grade.id);
            this.crud.table[1].value = e.grade.id;
        }

    },

    mounted: function() {
    },

    components: { Administrator, Head, Link, CRUD }
}
</script>

<template>

    <Head title="Grade Subject Remark" />

    <Administrator>

        <CRUD :crud="crud" @onChange="change($event)" @onEdit="edit($event)"></CRUD>

    </Administrator>

</template>
