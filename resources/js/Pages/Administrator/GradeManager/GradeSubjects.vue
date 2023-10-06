<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link } from '@inertiajs/vue3';

import CRUD from '@/Components/CRUD.vue';

export default {
    
    props: {
        errors: Object,
        grades: Object,
        subjects: Object,
    },

    data: function () {
        return {

            crud : {
                title: 'Grade Subject Manager',
                model: 'GradeSubject',
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
                        field:'lectures_per_week',
                        text:'Lectures per week',
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
                        field:'is_consecutive',
                        text:'Is Consecutive',
                        type:'select',
                        value:null,
                        values:[{id: 'Yes', text: 'Yes'}, {id: 'No', text: 'No'}, {id: 'Any', text: 'Any'},],
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
                        values:[{id: 'Yes', text: 'Yes'}, {id: 'No', text: 'No'},],
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

    <Head title="Grade Subjects" />

    <Administrator>

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
