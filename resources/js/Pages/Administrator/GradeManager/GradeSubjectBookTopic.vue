<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import CRUD from '@/Components/CRUD.vue';

export default {
    
    props: {
        errors: Object,
        grades: Object,
    },

    data: function () {
        return {

            crud : {
                title: 'Grade Subject Book Topic Manager',
                model: 'GradeSubjectBookTopic',
                files: '',
                data: null,
                rows: 10,
                orderBy: 'id',
                order: 'desc',
                with: 'grade_subject_book,grade,subject',
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
                        display:false,
                        isForm:true,
                        isSearch:false,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'grade_subject_id',
                        text:'Grade Subject',
                        type:'select',
                        value:null,
                        values: [],
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:false,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'grade_subject_book_id',
                        text:'Grade Subject Book',
                        type:'select',
                        value:null,
                        values:[],
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:false,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },

                    {
                        field: 'grade',
                        text: 'Grade.',
                        type: 'text',
                        value: '',
                        validation: '',
                        display: true,
                        display_value: 'grade,name',
                        isForm: false,
                        isSearch: true,
                        colWidth: 'w-20',
                        fieldWidth: 'w-full' 
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
                        colWidth: 'w-20',
                        fieldWidth: 'w-full' 
                    },
                    {
                        field: 'book_title',
                        text: 'Book Title',
                        type: 'text',
                        value: '',
                        validation: '',
                        display: true,
                        display_value: 'grade_subject_book,book_title',
                        isForm: false,
                        isSearch: true,
                        colWidth: 'w-auto',
                        fieldWidth: 'w-full' 
                    },
                    {
                        field:'topic_index',
                        text:'Topic Index No',
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
                        field:'topic',
                        text:'Topic Name',
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

        async crudChange(e){
            if(e.key == 'grade_id'){
                const response = await fetch('/grade_manager/fetch/grade_subject/' + e.val);
                this.crud.table[2].values = await response.json();
            }

            if(e.key == 'grade_subject_id'){
                const response = await fetch('/grade_manager/fetch/grade_subject_book/' + e.val);
                this.crud.table[3].values = await response.json();
            }
        }
    },

    mounted: function() {
    },

    components: { Administrator, Head, Link, CRUD }
}
</script>

<template>

    <Head title="Bookk Topics" />

    <Administrator>

        <CRUD @onChange="crudChange($event)" :crud="crud"></CRUD>

    </Administrator>

</template>
