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
                title: 'Grade Manager',
                model: 'Grade',
                files: '',
                data: null,
                rows: 10,
                orderBy: 'id',
                order: 'desc',
                with: 'section',
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
                        display:true,
                        display_value: 'section,name',
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'name',
                        text:'Grade name',
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
                        field:'grade_index',
                        text:'Grade Index',
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
                        field:'lectures_per_day',
                        text:'Lectures per day',
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

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
