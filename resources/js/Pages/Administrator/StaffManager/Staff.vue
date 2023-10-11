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
                title: 'Staff Manager',
                model: 'Staff',
                files: '',
                data: null,
                rows: 10,
                orderBy: 'id',
                order: 'desc',
                with: '',
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
                        colWidth:'w-20',
                        fieldWidth:'w-full'
                    },
                    {
                        field:'branch_id',
                        text:'Branch',
                        type:'select',
                        value:'',
                        values: [],
                        validation:'',
                        display:false,
                        isForm:true,
                        isSearch:false,
                        colWidth:'w-20',
                        fieldWidth:'w-full'
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
                        fieldWidth:'w-1/3'
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
                        fieldWidth:'w-1/3'
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
                        fieldWidth:'w-1/3'
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
                        fieldWidth:'w-1/2'
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
                        fieldWidth:'w-1/2'
                    },
                    {
                        field:'gender',
                        text:'Gender',
                        type:'select',
                        value:null,
                        values:[
                            { id: 'Male', text: 'Male' },
                            { id: 'Female', text: 'Female' },
                            { id: 'Other', text: 'Other' },
                        ],
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-1/2'
                    },
                    {
                        field:'blood_group',
                        text:'Blood Group',
                        type:'select',
                        value:null,
                        values:[
                            { id: 'O +ve', text: 'O +ve' },
                            { id: 'O -ve', text: 'O -ve' },
                            { id: 'A +ve', text: 'A +ve' },
                            { id: 'A -ve', text: 'A -ve' },
                            { id: 'B +ve', text: 'B +ve' },
                            { id: 'B -ve', text: 'B -ve' },
                            { id: 'AB +ve', text: 'AB +ve' },
                            { id: 'AB -ve', text: 'AB -ve' },
                            { id: 'HH', text: 'HH' },
                            { id: 'Other', text: 'Other' },
                        ],
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-1/2'
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
                        fieldWidth:'w-1/2'
                    },
                    {
                        field:'pan',
                        text:'PAN',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-1/2'
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
                        fieldWidth:'w-1/3'
                    },
                    {
                        field:'doj',
                        text:'Joining Date',
                        type:'date',
                        value:null,
                        validation:'',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-1/3'
                    },
                    {
                        field:'doe',
                        text:'Exit Date',
                        type:'date',
                        value:null,
                        validation:'',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-1/3'
                    },
                    

                    {
                        field:'religion',
                        text:'Religion',
                        type:'select',
                        value:null,
                        values:[
                            { id: 'Hindu', text: 'Hindu' },
                            { id: 'Muslim', text: 'Muslim' },
                            { id: 'Christian', text: 'Christian' },
                            { id: 'Sikh', text: 'Sikh' },
                            { id: 'Buddhist', text: 'Buddhist' },
                            { id: 'Jain', text: 'Jain' },
                            { id: 'Atheist', text: 'Atheist' },
                            { id: 'Other', text: 'Other' },
                        ],
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-1/3'
                    },
                    {
                        field:'cast',
                        text:'Cast',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-1/3'
                    },
                    {
                        field:'subcast',
                        text:'Subcast',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-1/3'
                    },
                    
                    {
                        field:'marital_status',
                        text:'Marital Status',
                        type:'select',
                        value:null,
                        values:[
                            { id: 'Married', text: 'Married' },
                            { id: 'Widowed', text: 'Widowed' },
                            { id: 'Separated', text: 'Separated' },
                            { id: 'Divorced', text: 'Divorced' },
                            { id: 'Single', text: 'Single' },
                            { id: 'Other', text: 'Other' },
                        ],
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2 lg:w-1/3'
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
                        fieldWidth:'w-full md:w-1/2 lg:w-1/3'
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
                        fieldWidth:'w-full md:w-1/2 lg:w-1/3'
                    },

                    {
                        field:'mothertongue',
                        text:'Mothertongue',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2 lg:w-1/3'
                    },
                    {
                        field:'nationality',
                        text:'Nationality',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:false,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2 lg:w-1/3'
                    },
                    {
                        field:'employee_code',
                        text:'Employee Code',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2 lg:w-1/3'
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

    mounted: function() {
    },

    created: function() {
        this.init();
    },

    components: { Administrator, Head, Link, CRUD }
}
</script>

<template>

    <Head title="Staff" />

    <Administrator>

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
