<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link } from '@inertiajs/vue3';

import CRUD from '@/Components/CRUD.vue';

export default {
    
    props: {
        errors: Object,
        grade_subjects: Object,
    },

    data: function () {
        return {

            crud : {
                title: 'Grade Subject Book Manager',
                model: 'GradeSubjectBook',
                files: '',
                data: null,
                rows: 10,
                orderBy: 'id',
                order: 'desc',
                with: 'grade_subject,grade,subject',
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
                        field:'grade_subject_id',
                        text:'Grade Subject',
                        type:'select',
                        value:null,
                        values:this.grade_subjects,
                        validation:'required',
                        display:false,
                        display_value: 'grade_subject,subject_text',
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
    },

    mounted: function() {
    },

    components: { Administrator, Head, Link, CRUD }
}
</script>

<template>

    <Head title="Grade Subject Books" />

    <Administrator>

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
