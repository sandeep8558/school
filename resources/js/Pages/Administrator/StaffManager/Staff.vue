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
                        field:'first_name',
                        text:'First Name',
                        type:'text',
                        value:null,
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-full',
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
                        colWidth:'w-full',
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
                        colWidth:'w-full',
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
                        colWidth:'w-full',
                        fieldWidth:'w-full'
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
                        colWidth:'w-full',
                        fieldWidth:'w-full'
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
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-full',
                        fieldWidth:'w-full'
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
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-full',
                        fieldWidth:'w-full'
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
                        colWidth:'w-full',
                        fieldWidth:'w-full'
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
                        colWidth:'w-full',
                        fieldWidth:'w-full'
                    },

                    {
                        field:'dob',
                        text:'Date of Birth',
                        type:'date',
                        value:null,
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-full',
                        fieldWidth:'w-full'
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
                        colWidth:'w-full',
                        fieldWidth:'w-full'
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
                        colWidth:'w-full',
                        fieldWidth:'w-full'
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
                        colWidth:'w-full',
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

    <Head title="Staff" />

    <Administrator>

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
