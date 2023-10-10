<script>
import { useForm, router } from '@inertiajs/vue3';
import {  Link } from '@inertiajs/vue3';

export default {
    
    props: {
        crud: Object,
        errors: Object,
    },

    data: function () {
        return {
            isForm: false,
            title: "CRUD",
            form: useForm ({}),
            data: [],
            search: {
                rows: this.crud.rows,
                kuthe: 'Anywhere',
                kay: 'id',
                shodha: '',
                order: this.crud.order,
                order_by: this.crud.orderBy,
            },
            next_page_url: null,
            prev_page_url: null,
            current_page: 1,
            buttons: [],
            where: '',
        };
    },

    methods: {

        getData(page = 1){
            let url = '/crud/index?model=' + this.crud.model + '&kuthe=' + this.search.kuthe + '&kay=' + this.search.kay + '&shodha=' + this.search.shodha + '&page=' + page + '&rows=' + this.search.rows + '&order_by=' + this.search.order_by + '&order=' + this.search.order + '&with=' + this.crud.with + '&where=' + this.where;
            fetch(url).then(data => {
                data.json().then((ddd) => {
                    this.next_page_url = ddd.next_page_url;
                    this.prev_page_url = ddd.prev_page_url;
                    this.current_page = ddd.current_page;
                    this.data = ddd.data;
                });
            })
        },

        changeOrder(order, elm){{

            if(elm.display_value == undefined){
                this.search.order_by = elm.field;
            } else {
                this.search.order_by = elm.display_value;
            }

            this.search.order = order;
            this.getData();
        }},

        setValue(row, val){
            let a = val.split(",")
            let b = row;
            a.forEach(d => {
                b = b != null ? b[d] : null;
            });
            return b;
        },

        save (){
            this.form.post('/crud/save', {
                onSuccess: (data) => {
                    this.isForm = this.form.id == null ? true : false;
                    this.reset();
                    this.getData();
                },
            });
        },

        editRow(item){
            this.isForm = true;
            this.setItem(item);
            this.$emit('onEdit', item);
        },

        deleteRow(item){
            this.$swal.fire({
                title: "Warning",
                text: "Do you want to delete this row?",
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
            }).then((e) => {
                if(e.isConfirmed){
                    this.setItem(item);
                    this.form.post('/crud/delete', {
                        onFinish: data => {
                            this.reset();
                            this.getData();
                        }
                    });
                }
            });
        },

        reset (){
            this.crud.table.forEach(data => {
                if(data.isForm){
                    this.form[data.field] = data.value;
                }
            });
            this.form.id = null;
        },

        setItem(item){
            this.form.id = item.id;
            this.crud.table.forEach(data => {
                if(data.isForm){
                    this.form[data.field] = item[data.field];
                }
            });
        },

        setItems () {
            let fdata = {
                id: null,
                model: this.crud.model,
                files: this.crud.files,
                table: this.crud.table,
            };
            this.crud.table.forEach(data => {
                if(data.isForm){
                    fdata[data.field] = data.value;
                }
            });
            this.form = useForm(fdata);
        },

        emitE(key, val){
            this.$emit('onChange', {key:key,val:val});
        },

        setFile(field, e){
            this.form[field] = e.target.files[0];
        },

        setURL(str, row){
            let a = str.match(/{([^}]+)}/);
            if(a != null){
                str = str.replaceAll(a[0], row[a[1]]);
            }
            
            return str;
        },

    },

    computed: {
        myData(){
            return this.data;
        },
    },

    created: function() {

        this.title = this.crud.title != null && this.crud.title;

        this.where = this.crud.where;

        this.setItems();

        this.getData();

    },

    mounted: function() {
        if (this.crud.buttons != undefined && this.crud.buttons != null && this.crud.buttons != ''){
            this.buttons = this.crud.buttons;
        }

        
    },

    components: { Link }
}
</script>


<template>

    <div class="flex flex-col">

        <div class="mb-4 shadow border rounded-md">

            <div class="w-full p-3 flex items-center">
                <div class="w-full">
                    <h2 class="text-xl uppercase font-semibold">{{title}}</h2>
                </div>
                <div class="w-auto">
                    <button @click="isForm = !isForm; reset()" class="btn transition-all duration-200" :class="isForm ? 'btn-red' : 'btn-purple'">{{ isForm ? 'Close' : 'Add' }}</button>
                </div>
            </div>


            <form @submit.prevent="save" method="post">
                <div v-if="isForm" class="w-full p-5 border-t flex flex-wrap items-center bg-white rounded-b-md">

                    <template v-for="elm in crud.table" :key="elm">
                        <template v-if="elm.isForm">

                            <!-- File -->
                            <div v-if="elm.type == 'file'" class="mb-5" :class="elm.fieldWidth">
                                <div class="relative">
                                    <label for="floating_outlined" class="">{{ elm.text }}</label>
                                    <input @change="setFile(elm.field, $event)" type="file" id="floating_outlined" class="peer inp inp-file" placeholder="" />
                                </div>
                                <span v-if="$page.props.errors" class="text-sm text-red-500">{{ $page.props.errors[elm.field] }}</span>
                            </div>

                            <!-- Text -->
                            <div v-if="elm.type == 'text'" class="mb-5" :class="elm.fieldWidth">
                                <div class="relative">
                                    <input @change="emitE(elm.field, form[elm.field])" type="text" id="floating_outlined" class="peer floating-inp" v-model="form[elm.field]" placeholder="" />
                                    <label for="floating_outlined" class="floating-lbl">{{ elm.text }}</label>
                                </div>
                                <span v-if="$page.props.errors" class="text-sm text-red-500">{{ $page.props.errors[elm.field] }}</span>
                            </div>

                            <!-- Date -->
                            <div v-if="elm.type == 'date'" class="mb-5" :class="elm.fieldWidth">
                                <div class="relative">
                                    <input @change="emitE(elm.field, form[elm.field])" type="date" id="floating_outlined" class="peer floating-inp" v-model="form[elm.field]" placeholder="" />
                                    <label for="floating_outlined" class="floating-lbl">{{ elm.text }}</label>
                                </div>
                                <span v-if="$page.props.errors" class="text-sm text-red-500">{{ $page.props.errors[elm.field] }}</span>
                            </div>

                            <!-- Select -->
                            <div v-if="elm.type == 'select'" class="mb-5" :class="elm.fieldWidth">
                                <div class="relative">
                                    <select @change="emitE(elm.field, form[elm.field])" id="floating_outlined" class="peer floating-inp" v-model="form[elm.field]" placeholder="">
                                        <option v-for="option in elm.values" :key="option.id" :value="option.id">{{ option.text }}</option>
                                    </select>
                                    <label for="floating_outlined" class="floating-lbl">{{ elm.text }}</label>
                                </div>
                                <span v-if="$page.props.errors" class="text-sm text-red-500">{{ $page.props.errors[elm.field] }}</span>
                            </div>

                        </template>
                    </template>

                    <div class="w-full">
                        <button :disabled="form.processing" type="submit" class="btn btn-purple disabled:btn-red">
                            {{ form.id == null ? 'Save' : 'Update' }}
                        </button>
                    </div>

                </div>
            </form>

        </div>
        

        

        

        <div class="rounded-md">

            <!-- Search Console -->
            <div class="w-full mb-4 shadow border rounded-md flex items-center">

                <select name="rows" id="rows" v-model="search.rows" class="rounded-l-md focus:ring-0">
                    <option value="1">1</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                
                <select name="kuthe" id="kuthe" v-model="search.kuthe" class="focus:ring-0">
                    <option value="Anywhere">Anywhere</option>
                    <option value="Exact">Exact</option>
                </select>
                
                <select name="kay" id="kay" v-model="search.kay" class="focus:ring-0">
                    <template v-for="col in crud.table" :key="col.field">
                        <option v-if="col.isSearch" :value="col.display_value != undefined ? col.display_value : col.field">{{ col.text }}</option>
                    </template>
                </select>

                <input name="shodha" id="shodha" type="search" v-model="search.shodha" class="w-full focus:ring-0">

                <button @click="getData()" class="btn btn-purple rounded-none rounded-r-md">Search</button>

            </div>


            <!-- Result Table -->
            <div class="box rounded-md overflow-auto p-0 scrollbar-thin">

                <table class="w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr class="w-full">
                            <template v-for="col in crud.table" :key="col.field">
                                <th v-if="col.display" class="p-3 text-sm font-semibold tracking-wide text-left">
                                    <div class="items-center flex space-x-2">
                                        <div class="flex flex-col">

                                            <button @click="changeOrder('asc', col)" class="btn shadow-none p-0 rounded-none rounded-b rotate-180" :class="(search.order == 'asc' & (search.order_by == col.field || search.order_by == col.display_value)) ? 'btn-red' : 'btn-order'">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-3">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>

                                            <button @click="changeOrder('desc', col)" class="btn shadow-none p-0 rounded-none rounded-b" :class="(search.order == 'desc' & (search.order_by == col.field || search.order_by == col.display_value)) ? 'btn-red' : 'btn-order'">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-3">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                            
                                        </div>
                                        
                                        <span class="whitespace-nowrap">{{ col.text }}</span>
                                    </div>
                                </th>
                            </template>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        <tr v-for="row in myData" :key="row.id" class="odd:bg-white even:bg-gray-50">
                            
                            <template v-for="col in crud.table" :key="col.field">
                                <td v-if="col.display" class="p-3 text-sm text-gray-700 whitespace-nowrap" :class="col.colWidth">
                                    <template v-if="col.type == 'file'">
                                        <img :src="col.display_value != undefined ? setValue(row, col.display_value) : row[col.field]" class="h-16">
                                    </template>
                                    <template v-if="col.type != 'file'">
                                        {{ col.display_value != undefined ? setValue(row, col.display_value) : row[col.field] }}
                                    </template>
                                </td>
                            </template>

                            <td class="p-3 text-right text-sm text-gray-700 whitespace-nowrap items-start relative">

                                <template v-for="btn in buttons" :key="btn.text">
                                    <Link :href="setURL(btn.route, row)" class="btn btn-purple px-2 py-2 text-xs mr-1 relative"><span>{{ btn.text }}</span></Link>
                                </template>
                                
                                
                                <button @click="editRow(row)" class="btn btn-orange px-2 mr-1 relative">
                                    <svg class="w-4 h-4 stroke-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279"/>
                                    </svg>
                                </button>

                                <button @click="deleteRow(row)" class="btn btn-red px-2">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                    </svg>
                                </button>

                            </td>
                        </tr>
                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            <div>
                <button @click="getData(current_page - 1)" :disabled="prev_page_url == null" :class="prev_page_url == null ? 'btn-disabled' : 'btn-purple'" class="btn">Previous</button>
                <button @click="getData(current_page + 1)" :disabled="next_page_url == null" :class="next_page_url == null ? 'btn-disabled' : 'btn-purple'" class="btn float-right">Next</button>
            </div>


        </div>

        

    </div>

</template>

