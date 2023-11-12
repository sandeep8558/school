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
                title: 'Language Manager',
                model: 'Language',
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
                        field:'language',
                        text:'Language',
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
                        field:'which',
                        text:'Which Language',
                        type:'select',
                        value:null,
                        values:[
                            { id: 'First Language', text: 'First Language' },
                            { id: 'Second Language', text: 'Second Language' },
                            { id: 'Third Language', text: 'Third Language' },
                        ],
                        validation:'required',
                        display:true,
                        isForm:true,
                        isSearch:true,
                        colWidth:'w-auto',
                        fieldWidth:'w-full md:w-1/2'
                    },
                    {
                        field:'is_available',
                        text:'Is Available',
                        type:'select',
                        value:null,
                        values:[
                            { id: 'Yes', text: 'Yes' },
                            { id: 'No', text: 'No' },
                        ],
                        validation:'required',
                        display:true,
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

    <Head title="Division" />

    <Administrator>

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
