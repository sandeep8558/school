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
        all_fee_groups: Object,
    },

    data: function () {
        return {
            ays: [],
            grds: [],

            isForm: false,
            fee_groups: {
                id: null,
                academic_year_id: '',
                name: '',
                application_fee: 0,
                admission_fee: 0,
                deposit: 0,
                fee_group_grades: [],
                fee_group_installments: [],
                fee_group_parameters: [],
                fee_group_late_fee: {
                    amount: 0,
                    per: '',
                },
            },
            grade_id: '',
            fee_group_parameter: {
                param: '',
                per_year_fee: 0,
                per_month_fee: 0
            },
            fee_group_installment: {
                ind: 0,
                name: '',
                amount: 0,
                due_date: '',
                payable_at_admission: '',
            },

            step: 1,
        };
    },

    methods: {

        deleteClicked(obj){
            this.$swal.fire({
                title: "Warning",
                text: "Do you want to delete this Fee Group?",
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
            }).then((e) => {
                if(e.isConfirmed){
                    let frm = useForm({id:obj.id});
                    frm.post('/fee_and_services/delete_fee', {
                        onFinish: data => {
                        }
                    });
                }
            });
        },

        editClicked(obj){
            
            /* Form opened */
            this.isForm = true;
            
            /* Fee Group Data linked */
            this.fee_groups.id = obj.id;
            this.fee_groups.academic_year_id = obj.academic_year_id;
            this.fee_groups.name = obj.name;
            this.fee_groups.application_fee = obj.application_fee;
            this.fee_groups.admission_fee = obj.admission_fee;
            this.fee_groups.deposit = obj.deposit;

            /* Grades Data Linked */
            obj.fee_group_grades.forEach(grade =>{
                this.fee_groups.fee_group_grades.push(grade);
            });

            /* Parameters Data Linked */
            obj.fee_group_parameters.forEach(param => {
                this.fee_groups.fee_group_parameters.push(param);
            });

            /* Installments Data Linked */
            obj.fee_group_installments.forEach(emi => {
                this.fee_groups.fee_group_installments.push(emi);
            });
            /* this.fee_groups.fee_group_installments = obj.fee_group_installments; */

            /* Late Fee Data Linked */
            this.fee_groups.fee_group_late_fee.amount = obj.fee_group__late_fee.amount;
            this.fee_groups.fee_group_late_fee.per = obj.fee_group__late_fee.per;
        },

        resetForm(){
            this.step = 1;
            this.fee_groups.id = null;
            this.fee_groups.academic_year_id = '';
            this.fee_groups.name = '';
            this.fee_groups.application_fee = 0;
            this.fee_groups.admission_fee = 0;
            this.fee_groups.deposit = 0;
            this.fee_groups.fee_group_grades = [];
            this.fee_groups.fee_group_installments = [];
            this.fee_groups.fee_group_parameters = [];
            this.fee_groups.fee_group_late_fee.amount = 0;
            this.fee_groups.fee_group_late_fee.per = '';
            this.isForm = false;
        },

        addInstallment(){
            if(this.fee_group_installment.ind != '' & this.fee_group_installment.name != '' & this.fee_group_installment.amount != '' & this.fee_group_installment.due_date != '' & this.fee_group_installment.payable_at_admission != ''){
                const a = {
                    ind: this.fee_group_installment.ind,
                    name: this.fee_group_installment.name,
                    amount: this.fee_group_installment.amount,
                    due_date: this.fee_group_installment.due_date,
                    payable_at_admission: this.fee_group_installment.payable_at_admission,
                };
                this.fee_groups.fee_group_installments.push(a);
                this.resetFeeGroupInstallmentForm();
            }
        },

        addFeeParam(){
            if(this.fee_group_parameter.param != '' & this.fee_group_parameter.per_month_fee > 0 & this.fee_group_parameter.per_year_fee > 0){
                const a = {
                    param: this.fee_group_parameter.param,
                    per_year_fee: this.fee_group_parameter.per_year_fee,
                    per_month_fee: this.fee_group_parameter.per_month_fee,
                };
                this.fee_groups.fee_group_parameters.push(a);
                this.resetFeeGroupParameterForm();
            }
        },

        resetFeeGroupInstallmentForm(){
            this.fee_group_installment.ind = 0;
            this.fee_group_installment.name = '';
            this.fee_group_installment.amount = 0;
            this.fee_group_installment.due_date = '';
        },

        resetFeeGroupParameterForm(){
            this.fee_group_parameter.param = '';
            this.fee_group_parameter.per_year_fee = 0;
            this.fee_group_parameter.per_month_fee = 0;
        },

        gradeChange(e){
            if(e.target.value != ''){

                let a = {
                    grade_id: e.target.value
                }
                let isExist = false;
                this.fee_groups.fee_group_grades.forEach(grade => {
                    if(grade.grade_id == e.target.value){
                        isExist = true;
                    }
                });
                if(!isExist){
                    this.fee_groups.fee_group_grades.push(a);
                }

                this.grade_id = '';

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
            this.fee_groups.fee_group_installments.splice(ind, 1);
        },

        removeFeeParam(ind){
            this.fee_groups.fee_group_parameters.splice(ind, 1);
        },

        removeGrade(ind){
            this.fee_groups.fee_group_grades.splice(ind, 1);
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

        saveFee(){
            let frm = new useForm(this.fee_groups);

            frm.post('/fee_and_services/save_fee', {
                onSuccess: res => {},
                onFinish: res => {
                    this.resetForm();
                },
            });
        },

    },

    created: function() {
        this.init();
    },

    components: { Administrator, Head, Link, Select, Text, Date },

    computed: {
        
        isFirst(){
            let is = false;
            if(this.fee_groups.academic_year_id != '' & this.fee_groups.name != '' & this.fee_groups.application_fee != '' & this.fee_groups.admission_fee != '' & this.fee_groups.deposit != ''){
                is = true;
            }
            return is;
        },

        isSecond(){
            let is = false;
            if(this.fee_groups.fee_group_grades.length > 0){
                is = true;
            }
            return is;
        },

        isThird(){
            let is = false;
            if(this.fee_groups.fee_group_parameters.length > 0){
                is = true;
            }
            return is;
        },

        isFourth(){
            let is = false;
            if(this.fee_groups.fee_group_installments.length > 0){
                is = true;
            }
            return is;
        },

        isFifth(){
            let is = false;
            if(this.fee_groups.fee_group_late_fee.amount != '' & this.fee_groups.fee_group_late_fee.per != ''){
                is = true;
            }
            return is;
        },

    },
}

</script>

<template>

    <Head title="Fee Bootstrap" />

    <Administrator>

        <div class="box">
            <div class="w-48"><span class="text-xl font-bold">Fee Bootstrap</span></div>
            <div class="w-full items-center">
                <button class="btn btn-purple inline-block float-right" @click="isForm = !isForm">Add Fee</button>
            </div>
        </div>

        <div v-if="isForm" class="box pt-8">
            <div class="w-full">
                
                
                <!-- Step 1 -->
                <div v-if="step == 1" class="flex flex-wrap">
                    <div class="w-full text-lg font-bold underline mb-6">Fee Group & Basic Fee</div>

                    <Select label="Academic Year" width="w-full md:w-1/2" :options="ays" v-model="fee_groups.academic_year_id"></Select>

                    <Text label="Fee Group Name" width="w-full md:w-1/2" v-model="fee_groups.name"></Text>

                    <Text label="Application Fee" width="w-full md:w-1/3" v-model="fee_groups.application_fee"></Text>

                    <Text label="Admission Fee" width="w-full md:w-1/3" v-model="fee_groups.admission_fee"></Text>

                    <Text label="Security Deposit" width="w-full md:w-1/3" v-model="fee_groups.deposit"></Text>

                    <button :disabled="!isFirst" @click="step=2" class="btn" :class="isFirst ? 'btn-purple' : 'btn-disabled'">Next</button>
                </div>

                <!-- Step 2 -->
                <div v-if="step == 2" class="flex flex-wrap">

                    <div class="w-full text-lg font-bold underline mt-6">Grades for the Fee Group</div>

                    <div v-if="fee_groups.fee_group_grades.length > 0" class="w-full mb-5">
                        <div v-for="(item, ind) in fee_groups.fee_group_grades" :key="item" class="w-full mb-3 border-b last:border-none py-3 group">
                            {{ getGradeById(item.grade_id).name }} - {{ item.grade_id }}  <button class="btn btn-red float-right text-sm py-1 hidden group-hover:block" @click="removeGrade(ind)">Delete</button>
                        </div>
                    </div>

                    <div v-if="fee_groups.fee_group_grades.length <= 0" class="w-full mb-5 py-3">
                        Grades not selected.
                    </div>
                    
                    <Select label="Grade" width="w-full" @change="gradeChange($event)" :options="grds" v-model="grade_id"></Select>

                    <button :disabled="!isFirst" @click="step=1" class="btn mr-3" :class="isFirst ? 'btn-purple' : 'btn-disabled'">Back</button>
                    <button :disabled="!isSecond" @click="step=3" class="btn" :class="isSecond ? 'btn-purple' : 'btn-disabled'">Next</button>

                </div>

                <!-- Step 3 -->
                <div v-if="step == 3" class="flex flex-wrap">
                    
                    <div class="w-full text-lg font-bold underline mt-6">Fee Parameters</div>

                    <div v-if="fee_groups.fee_group_parameters.length > 0" class="w-full mb-5">
                        <div v-for="(item, ind) in fee_groups.fee_group_parameters" :key="item" class="w-full mb-3 border-b last:border-none py-3 group">
                            <span class="inline-block w-48">{{ item.param }}</span>
                            <span class="inline-block w-28">{{ item.per_month_fee }}/-</span>
                            <span class="inline-block w-28">{{ item.per_year_fee }}/-</span>
                            <button class="btn btn-red float-right text-sm py-1 hidden group-hover:block" @click="removeFeeParam(ind)">Delete</button>
                        </div>
                    </div>

                    <div v-if="fee_groups.fee_group_parameters.length <= 0" class="w-full mb-5 py-3">
                        Parameters are not added!
                    </div>

                    <Text label="Parameter" width="w-full md:w-1/3" v-model="fee_group_parameter.param"></Text>

                    <Text label="Per Month Fee" width="w-full md:w-1/3" v-model="fee_group_parameter.per_month_fee"></Text>

                    <Text label="Per Year Fee" width="w-full md:w-1/3" v-model="fee_group_parameter.per_year_fee"></Text>

                    <button @click="addFeeParam()" class="btn btn-orange mb-5">Add Fee Parameter</button>

                    <div class="w-full"></div>

                    <button :disabled="!isSecond" @click="step=2" class="btn mr-3" :class="isSecond ? 'btn-purple' : 'btn-disabled'">Back</button>
                    <button :disabled="!isThird" @click="step=4" class="btn" :class="isThird ? 'btn-purple' : 'btn-disabled'">Next</button>

                </div>

                <!-- Step 4 -->
                <div v-if="step == 4" class="flex flex-wrap">

                    <div class="w-full text-lg font-bold underline mt-6">Installments</div>

                    <div v-if="fee_groups.fee_group_installments.length > 0" class="w-full mb-5">
                        <div v-for="(item, ind) in fee_groups.fee_group_installments" :key="item" class="w-full mb-3 border-b last:border-none py-3 group">
                            <span class="inline-block w-16">{{ item.payable_at_admission }}</span>
                            <span class="inline-block w-16">{{ item.ind }}</span>
                            <span class="inline-block w-48">{{ item.name }}</span>
                            <span class="inline-block w-28">{{ item.amount }}/-</span>
                            <span class="inline-block w-28">{{ item.due_date }}</span>
                            <button class="btn btn-red float-right text-sm py-1 hidden group-hover:block" @click="removeInstallment(ind)">Delete</button>
                        </div>
                    </div>

                    <div v-if="fee_groups.fee_group_installments.length <= 0" class="w-full mb-5 py-3">
                        Installments are not added!
                    </div>

                    <Select label="Payable at Admission" width="w-1/2 md:w-1/6" :options="[{key:'Yes',val:'Yes'},{key:'No',val:'No'}]" v-model="fee_group_installment.payable_at_admission"></Select>

                    <Text label="Installment Index" width="w-1/2 md:w-1/6" v-model="fee_group_installment.ind"></Text>

                    <Date label="Due Date" width="w-full md:w-1/6" v-model="fee_group_installment.due_date"></Date>

                    <Text label="Installment Title" width="w-full md:w-1/4" v-model="fee_group_installment.name"></Text>

                    <Text label="Amount" width="w-full md:w-1/4" v-model="fee_group_installment.amount"></Text>


                    <button @click="addInstallment()" class="btn btn-orange mb-5">Add Installment</button>

                    <div class="w-full"></div>

                    <button :disabled="!isThird" @click="step=3" class="btn mr-3" :class="isThird ? 'btn-purple' : 'btn-disabled'">Back</button>
                    <button :disabled="!isFourth" @click="step=5" class="btn" :class="isFourth ? 'btn-purple' : 'btn-disabled'">Next</button>

                </div>

                <!-- Step 5 -->
                <div v-if="step == 5" class="flex flex-wrap">

                    <div class="w-full text-lg font-bold underline mt-6 mb-6">Late Fee</div>

                    <Text label="Amount" width="w-full md:w-1/2" v-model="fee_groups.fee_group_late_fee.amount"></Text>

                    <Select label="Duration" width="w-full md:w-1/2" :options="[{key:'Day',val:'Day'},{key:'Week',val:'Week'},{key:'Month',val:'Month'}]" v-model="fee_groups.fee_group_late_fee.per"></Select>

                    <button :disabled="!isThird" @click="step=4" class="btn mr-3" :class="isThird ? 'btn-purple' : 'btn-disabled'">Back</button>
                    <button :disabled="!isFifth" @click="saveFee()" class="btn" :class="isFifth ? 'btn-purple' : 'btn-disabled'">Save Fee</button>

                </div>

                <!--  -->

            </div>
        </div>

        <div class="box">
            <div class="w-full">

                <p class="p-10 text-center text-lg" v-if="all_fee_groups.length <= 0">Fee groups are not added yet!</p>

                <table v-for="fg in all_fee_groups" :key="fg.id" class="w-full mb-10 last:mb-0">
                    <tbody>
                        <tr>
                            <td class="border border-gray-400 p-2 text-center text-lg font-bold" colspan="2">{{ fg.name }} for Academic Year {{ fg.academic_year.name }}</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-1" colspan="2">
                                Grades - 
                                <span class="mr-1" v-for="(grade, i) in fg.fee_group_grades" :key="grade.id">
                                    {{ grade.grade.name }}{{ fg.fee_group_grades.length == (i + 1) ? '' : ',' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-1">Application Fee</td>
                            <td class="border border-gray-400 p-1 w-48">Rs. {{ fg.application_fee }}/-</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-1">Admission Fee</td>
                            <td class="border border-gray-400 p-1">Rs. {{ fg.admission_fee }}/-</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-1">Security Deposit</td>
                            <td class="border border-gray-400 p-1">Rs. {{ fg.deposit }}/-</td>
                        </tr>

                        <tr v-for="param in fg.fee_group_parameters" :key="param.id">
                            <td class="border border-gray-400 p-1">{{ param.param }} (Rs. {{ param.per_month_fee }}/Month)</td>
                            <td class="border border-gray-400 p-1">Rs. {{ param.per_year_fee }}/-</td>
                        </tr>

                        <tr v-for="emi in fg.fee_group_installments" :key="emi.id">
                            <td class="border border-gray-400 p-1">{{ emi.name }} payable on or before {{ emi.due_date }}</td>
                            <td class="border border-gray-400 p-1">Rs. {{ emi.amount }}/-</td>
                        </tr>

                        <tr>
                            <td class="border border-gray-400 p-1">Late Fee</td>
                            <td class="border border-gray-400 p-1">Rs. {{ fg.fee_group__late_fee.amount }} per {{ fg.fee_group__late_fee.per }}</td>
                        </tr>

                        <tr>
                            <td colspan="2" class="text-center pt-3">
                                <a class="btn btn-purple p-2 leading-5 mx-1" :href="'/pdf/fee_group/'+fg.id" target="_blank">Download</a>
                                <button class="btn btn-orange p-2 leading-5 mx-1" @click="editClicked(fg)">Edit</button>
                                <button class="btn btn-red p-2 leading-5 mx-1" @click="deleteClicked(fg)">Delete</button>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>

    </Administrator>

</template>
