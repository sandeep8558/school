<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import CRUD from '@/Components/CRUD.vue';

export default {
    
    props: {
        errors: Object,
    },

    data: function () {
        return {
            crud : {
                title: 'Subject Manager',
                model: 'Subject',
                files: '',
                data: null,
                rows: 10,
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
                        field:'name',
                        text:'Subject',
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
                        field:'acronym',
                        text:'Acronym',
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
                        field:'note',
                        text:'Note',
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
                orderBy: 'id',
                order: 'desc',
                with: '',
                where: null,
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

    computed: {
    },

    updated: function(){
    },

    created: function() {
        this.init();
    },

    components: { Administrator, Head, Link, CRUD }
}
</script>

<template>

    <Head title="Subjects" />

    <Administrator>

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
