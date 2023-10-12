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
                title: 'Student Parent',
                model: 'StudentParent',
                files: '',
                data: null,
                rows: 10,
                orderBy: 'id',
                order: 'desc',
                with: 'student',
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
                        display_value: 'student,full_name',
                        isForm:false,
                        isSearch:false,
                        colWidth:'w-28',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'student_id',
                        text:'Student ID',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2'
                    },

                    {
                        field:'relation',
                        text:'Relation',
                        type:'select',
                        value:null,
                        values:[
                            { id: 'Father', text: 'Father' },
                            { id: 'Mother', text: 'Mother' },
                            { id: 'Other', text: 'Other' },
                        ],
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2'
                    },

                    {
                        field:'first_name',
                        text:'First Name',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full lg:w-1/3'
                    },
                    {
                        field:'middle_name',
                        text:'Middle Name',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full lg:w-1/3'
                    },
                    {
                        field:'last_name',
                        text:'Last Name',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full lg:w-1/3'
                    },

                    {
                        field:'email',
                        text:'Email Address',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2'
                    },
                    {
                        field:'phone',
                        text:'Phone Number',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2'
                    },

                    {
                        field:'dob',
                        text:'Date of Birth',
                        type:'date',
                        value:null,
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2'
                    },

                    {
                        field:'company_name',
                        text:'Company Name',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2'
                    },

                    {
                        field:'company_address',
                        text:'Company Address',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full'
                    },

                    

                    {
                        field:'qualification',
                        text:'Qualification',
                        type:'select',
                        value:null,
                        values:[
                            { id: 'Primary School', text: 'Primary School' },
                            { id: 'Secondary School', text: 'Secondary School' },
                            { id: 'High School', text: 'High School' },
                            { id: 'Undergraduate', text: 'Undergraduate' },
                            { id: 'Graduate', text: 'Graduate' },
                            { id: 'Diploma', text: 'Diploma' },
                            { id: 'Masters', text: 'Masters' },
                            { id: 'Doctorate', text: 'Doctorate' },
                            { id: 'Other', text: 'Other' },
                        ],
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2'
                    },
                    {
                        field:'degree',
                        text:'Degree',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2'
                    },

                    {
                        field:'occupation',
                        text:'Occupation',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2'
                    },

                    {
                        field:'annual_income',
                        text:'Annual Income',
                        type:'select',
                        value:null,
                        values:[
                            { id: 'below 1 Lac', text: 'below 1 Lac' },
                            { id: '1 Lac to 5 Lac', text: '1 Lac to 5 Lac' },
                            { id: '5 Lac to 10 Lac', text: '5 Lac to 10 Lac' },
                            { id: '10 Lac and above', text: '10 Lac and above' },
                        ],
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-1/2'
                    },

                    {
                        field:'pan',
                        text:'PAN Number',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2'
                    },

                    {
                        field:'aadhar',
                        text:'Aadhar Number',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2'
                    },

                    
                    


                ],
            },
        };
    },

    methods: {
        init(){
            this.crud.whereHas = this.$page.props.gbranch ? 'student,branch_id,' + this.$page.props.gbranch.id : null;
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

    <Head title="Student Parents" />

    <Administrator>

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
