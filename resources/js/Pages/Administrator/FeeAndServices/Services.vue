<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import Select from '@/Components/Form/Select.vue';
import Text from '@/Components/Form/Text.vue';
import Date from '@/Components/Form/Date.vue';

export default {
    
    props: {
        errors: Object,
        academic_years: Object,
        grades: Object,
    },

    data: function () {
        return {
            ays: [],
            grds: [],

            isForm: false,
            
            service: {
                id: null,
                academic_year_id: '',
                name: '',
                is_compulsory: '',
                service_items: [],
            },

            service_item: {
                name: '',
                code: '',
                description: '',
                amount: '',
                service_item_installments: [],
                service_item_grades: [],
            },
            service_item_installment: {
                name: '',
                amount: '',
                due_date: '',
            },
            service_item_grade: {
                grade_id: ''
            },
        };
    },

    methods: {

        saveService(){
            let frm = new useForm(this.service);

            frm.post('/fee_and_services/save_service', {
                onSuccess: res => {},
                onFinish: res => {
                    this.resetForm();
                    this.isForm = false;
                },
            });
        },

        resetForm(){
            this.service.id = null;
            this.service.academic_year_id = '';
            this.service.name = '';
            this.service.is_compulsory = '';
            this.service.service_items = [];
        },

        AddServiceItem(){
            let service_items = {
                name: this.service_item.name,
                code: this.service_item.code,
                description: this.service_item.description,
                amount: this.service_item.amount,
                service_item_installments: this.service_item.service_item_installments,
                service_item_grades: this.service_item.service_item_grades,
            };

            this.service.service_items.push(service_items);

            this.service_item.name = '';
            this.service_item.code = '';
            this.service_item.description = '';
            this.service_item.amount = '';
            this.service_item.service_item_installments = [];
            this.service_item.service_item_grades = [];

        },

        AddInstallment(){
            let sii = {
                name : this.service_item_installment.name,
                amount : this.service_item_installment.amount,
                due_date : this.service_item_installment.due_date,
            };
            this.service_item.service_item_installments.push(sii);

            this.service_item_installment.name = '';
            this.service_item_installment.amount = '';
            this.service_item_installment.due_date = '';
        },

        gradeChange(e){
            if(e.target.value != ''){

                let a = {
                    grade_id: e.target.value
                }
                let isExist = false;
                this.service_item.service_item_grades.forEach(grade => {
                    if(grade.grade_id == e.target.value){
                        isExist = true;
                    }
                });
                if(!isExist){
                    this.service_item.service_item_grades.push(a);
                }
                this.service_item_grade.grade_id = '';
            }
        },

        getGradeById(id){
            let g = null;
            this.grades.forEach(grade => {
                if(id == grade.id){
                    g = grade;
                }
            });
            return g;
        },

        removeInstallment(ind){
            this.service_item.service_item_installments.splice(ind, 1);
        },

        removeGrade(ind){
            this.service_item.service_item_grades.splice(ind, 1);
        },

        init(){
            this.getAYS();
            this.getGRDS();
        },

        getAYS(){
            let ays = [];
            this.academic_years.forEach(ay => {
                let a = {
                    key: ay.name,
                    val: ay.id
                };
                ays.push(a);
            });
            this.ays = ays;
        },

        getGRDS(){
            let grds = [];
            this.grades.forEach(grade => {
                let a = {
                    key: grade.name,
                    val: grade.id
                };
                grds.push(a);
            });
            this.grds = grds;
        },

    },

    created: function() {
        this.init();
    },

    components: { Administrator, Head, Link, Select, Text, Date },

    computed: {

        isAddInstallment(){
            let is = false;
            if(this.service_item_installment.name != '' & this.service_item_installment.amount != '' & this.service_item_installment.due_date != ''){
                is = true;
            }
            return is;
        },

        isAddServiceItem(){
            let is = false;
            if(this.service_item.name != '' & this.service_item.code != '' & this.service_item.amount != '' & this.service_item.description != '' & this.service_item.service_item_grades.length > 0 & this.service_item.service_item_installments.length > 0){
                is = true;
            }
            return is;
        },

        isSaveService(){
            let is = false;
            if(this.service.academic_year_id != '' & this.service.is_compulsory != '' & this.service.name != '' & this.service.service_items.length > 0){
                is = true;
            }
            return is;
        },

    },
}
</script>

<template>

    <Head title="Services" />

    <Administrator>

        <div class="box">
            <div class="w-48"><span class="text-xl font-bold">Services</span></div>
            <div class="w-full items-center">
                <button class="btn btn-purple inline-block float-right" @click="isForm = !isForm">Add Service</button>
            </div>
        </div>

        <div v-if="isForm" class="box pt-8">
            <div class="w-full">


                <div class="flex flex-wrap mb-6">

                    <div class="w-full text-lg font-bold underline mb-6">Service</div>

                    <Select label="Academic Year" width="w-full md:w-1/3" :options="ays" v-model="service.academic_year_id"></Select>

                    <Select label="Is Service Compulsory" width="w-full md:w-1/3" :options="[{key:'Yes',val:'Yes'},{key:'No',val:'No'}]" v-model="service.is_compulsory"></Select>

                    <Text label="Service Name" width="w-full md:w-1/3" v-model="service.name"></Text>

                </div>


                <div class="flex flex-wrap mb-6">

                    <div class="w-full text-lg font-bold underline mb-5">Service Item</div>

                    <Text label="Service Item Name" width="w-full md:w-1/3" v-model="service_item.name"></Text>

                    <Text label="Item Code" width="w-full md:w-1/3" v-model="service_item.code"></Text>

                    <Text label="Item Amount" width="w-full md:w-1/3" v-model="service_item.amount"></Text>

                    <Text label="Item Description" width="w-full" v-model="service_item.description"></Text>

                </div>



                <div class="flex flex-wrap mb-6">

                    <div class="w-full text-lg font-bold underline mb-5">Grades</div>

                    <Select label="Grade" width="w-full md:w-1/4" @change="gradeChange($event)" :options="grds" v-model="service_item_grade.grade_id"></Select>

                    <div v-if="service_item.service_item_grades.length > 0" class="w-full md:w-3/4 px-3 py-1">

                        <span v-for="(item, ind) in service_item.service_item_grades" :key="item" class="btn bg-black inline-block text-gray-200 mr-2 group relative">
                            {{ getGradeById(item.grade_id).name }}
                            <button @click="removeGrade(ind)" class="btn btn-red hidden group-hover:inline-block absolute py-1 px-3 z-10 -top-4">X</button>
                        </span>

                    </div>

                </div>


                <div class="flex flex-wrap">

                    <div class="w-full text-lg font-bold underline mb-6">Installments</div>

                    <template v-for="(emi, ind) in service_item.service_item_installments" :key="emi">
                        <Text label="Installment Name" width="w-full md:w-1/4" v-model="emi.name"></Text>
                        <Text label="Installment Amount" width="w-full md:w-1/4" v-model="emi.amount"></Text>
                        <Date label="Due Date" width="w-full md:w-1/4" v-model="emi.due_date"></Date>
                        <div class="w-full md:w-1/4 px-5">
                            <button @click="removeInstallment(ind)" class="btn btn-red">Remove</button>
                        </div>
                    </template>

                    <Text label="Installment Name" width="w-full md:w-1/4" v-model="service_item_installment.name"></Text>

                    <Text label="Installment Amount" width="w-full md:w-1/4" v-model="service_item_installment.amount"></Text>

                    <Date label="Due Date" width="w-full md:w-1/4" v-model="service_item_installment.due_date"></Date>

                    <div class="w-full md:w-1/4 py-1 px-5">
                        <button @click="AddInstallment()" :disabled="!isAddInstallment" class="btn" :class="isAddInstallment ? 'btn-green' : 'btn-disabled'">Add</button>
                    </div>

                </div>

                <div class="w-full mb-6">
                    <button @click="AddServiceItem()" :disabled="!isAddServiceItem" class="btn" :class="isAddServiceItem ? 'btn-red' : 'btn-disabled'">Add Service Item</button>
                </div>


                <div v-for="item in service.service_items" :key="item" class="flex flex-wrap mb-6">
                    <table class="w-full">
                        <tbody>
                            <tr>
                                <td class="border border-gray-400 p-1 font-bold">{{ item.name }} - {{ item.code }}</td>
                                <td class="border border-gray-400 p-1 w-48 text-right">Rs. {{ item.amount }}/-</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="border border-gray-400 p-1">{{ item.description }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="border border-gray-400 p-1">Grades: <span v-for="(grade,ind) in item.service_item_grades" :key="grade">{{ getGradeById(grade.grade_id).name }}{{ item.service_item_grades.length ==  (ind + 1) ? '' : ', '}}</span></td>
                            </tr>
                            <tr v-for="emi in item.service_item_installments" :key="emi">
                                <td class="border border-gray-400 p-1">{{ emi.name }} - {{ emi.due_date }}</td>
                                <td class="border border-gray-400 p-1 w-48 text-right">Rs. {{ emi.amount }}/-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div v-if="isSaveService" class="w-full">
                    <button @click="saveService()" :disabled="!isSaveService" class="btn" :class="isSaveService ? 'btn-red' : 'btn-disabled'">Save Service</button>
                </div>

            </div>
        </div>

    </Administrator>

</template>
