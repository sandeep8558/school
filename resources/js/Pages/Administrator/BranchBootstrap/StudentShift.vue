<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {
    props: {
        errors: Object,
        student_shifts: Object,
    },

    data: function () {
        return {
            isForm: false,
            form: useForm({
                branch_id: this.$page.props.gbranch ? this.$page.props.gbranch.id : null,
                id: null,
                name: null,
                from: null,
                to: null,
            }),
            planForm: useForm({
                id: null,
                student_shift_id: null,
                period_index: null,
                from: null,
                to: null,
                slot: null,
            }),
        };
    },

    methods: {

        save(){
            this.form.post('/branch_bootstrap/save_student_shift', {
                onSuccess: data => {
                    if(this.form.id != null){
                        this.isForm = false;
                    }
                    this.form.reset();
                }
            });
        },

        editRow(student_shift){
            this.form.id = student_shift.id;
            this.form.name = student_shift.name;
            this.form.from = student_shift.from;
            this.form.to = student_shift.to;
            this.isForm = true;
        },

        deleteRow(student_shift){

            this.$swal.fire({
                title: "Warning",
                text: "Do you want to delete this student shift?",
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
            }).then((e) => {
                if(e.isConfirmed){

                    this.form.id = student_shift.id;
                    this.form.name = student_shift.name;
                    this.form.from = student_shift.from;
                    this.form.to = student_shift.to;

                    this.form.post('/branch_bootstrap/delete_student_shift', {
                        onSuccess: data => {
                            this.form.reset();
                        }
                    });

                }
            });

        },

        deletePlan(plan){
            this.$swal.fire({
                title: "Warning",
                text: "Do you want to delete this student shift plan?",
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
            }).then((e) => {
                if(e.isConfirmed){

                    this.planForm.id = plan.id;

                    this.planForm.post('/branch_bootstrap/delete_student_shift_plan', {
                        onSuccess: data => {
                            this.planForm.reset();
                        }
                    });

                }
            });
        },

        shodStudentShiftPlanForm(student_shift){
            this.$swal.fire({
                title: student_shift.name,
                html:
                '<div class="py-5">'+
                '<div class="relative">'+
                
                '<div for="from" class="w-full text-left mb-1">From</div>'+
                '<input type="time" id="from" placeholder="" class="inp mb-5" />'+

                '<div for="to" class="w-full text-left mb-1">To</div>'+
                '<input type="time" id="to" placeholder="" class="inp mb-5" />'+

                '<div for="period_index" class="w-full text-left mb-1">Period Index</div>'+
                '<input type="text" id="period_index" placeholder="" class="inp mb-5" />'+

                '<div for="slot" class="w-full text-left mb-1">Slot</div>'+
                '<select type="text" id="slot" placeholder="" class="inp mb-5">'+
                '<option value="">Select Slot</option>'+
                '<option value="Lecture">Lecture</option>'+
                '<option value="Short Break">Short Break</option>'+
                '<option value="Long Break">Long Break</option>'+
                '<option value="Interation Time">Interation Time</option>'+
                '<option value="Prayer">Prayer</option>'+
                '<option value="Assembly">Assembly</option>'+
                '</select>'+

                '</div>'+
                '</div>',
                confirmButtonText: 'Save Slot',
                showCancelButton: true,
                preConfirm: () => {

                    this.planForm.student_shift_id = student_shift.id;
                    this.planForm.from = document.getElementById('from').value;
                    this.planForm.to = document.getElementById('to').value;
                    this.planForm.period_index = document.getElementById('period_index').value;
                    this.planForm.slot = document.getElementById('slot').value;

                    this.$swal.showLoading();

                    this.planForm.post('/branch_bootstrap/save_student_shift_plan',{
                        onSuccess: data => {
                            this.$swal.close();
                        },
                        onError: err => {
                            //this.$swal.hideLoading();
                            this.$swal.showValidationMessage('Validation Failed');
                            throw new Error("Validation Failed");
                        }
                    });

                    return false;

                }

            });
        }

    },

    mounted: function() {
    },

    components: { Administrator, Head, Link }
}
</script>

<template>

    <Head title="Student Shift" />

    <Administrator>

        <div class="box">

            <div class="w-full">

                <div class="mb-6 flex items-center">
                    <h2 class="text-2xl font-bold w-full">Student Shift Manager</h2>
                    <div class="w-80">
                        <button class="btn float-right" :class="isForm ? 'btn-red' : 'btn-orange'" @click="isForm = !isForm;">
                            <span class="inline-block mr-3"> {{ isForm ? 'X' : '+' }} </span>
                            <span>{{ isForm ? 'Close Form' : 'Add Student Shift' }}</span>
                        </button>
                    </div>
                </div>

                <div v-if="isForm" class="form-box bg-white" id="branchForm">

                    <div class="w-full mb-5">
                        <h2 class="text-2xl font-bold uppercase py-6 text-left">Add Student Shift Here!</h2>
                    </div>

                    <div class="w-full mb-5">
                        <div class="relative">
                            <select id="floating_outlined" class="peer floating-inp" v-model="form.branch_id" placeholder="" :readonly="true">
                                <template v-if="$page.props.gbranch != null">
                                    <option :value="$page.props.gbranch.id">{{ $page.props.gbranch.name }}</option>
                                </template>
                            </select>
                            <label for="floating_outlined" class="floating-lbl">Branch</label>
                        </div>
                        <span v-if="errors" class="text-sm text-red-500">{{ errors.branch_id }}</span>
                    </div>

                    <div class="w-full mb-5">
                        <div class="relative">
                            <input type="text" id="floating_outlined" class="peer floating-inp" v-model="form.name" placeholder="" />
                            <label for="floating_outlined" class="floating-lbl">Student Shift Name</label>
                        </div>
                        <span v-if="errors" class="text-sm text-red-500">{{ errors.name }}</span>
                    </div>

                    <div class="w-full mb-5">
                        <div class="relative">
                            <input type="time" id="floating_outlined" class="peer floating-inp" v-model="form.from" placeholder="" />
                            <label for="floating_outlined" class="floating-lbl">From Time</label>
                        </div>
                        <span v-if="errors" class="text-sm text-red-500">{{ errors.from }}</span>
                    </div>

                    <div class="w-full mb-5">
                        <div class="relative">
                            <input type="time" id="floating_outlined" class="peer floating-inp" v-model="form.to" placeholder="" />
                            <label for="floating_outlined" class="floating-lbl">To Time</label>
                        </div>
                        <span v-if="errors" class="text-sm text-red-500">{{ errors.to }}</span>
                    </div>

                    <div class="w-full">
                        <button :disabled="form.processing" @click="save()" class="btn btn-purple disabled:btn-red">
                            {{ form.id == null ? 'Add Student Shift' : 'Update Student Shift' }}
                        </button>
                    </div>

                </div>

                <hr class="">

                <div v-for="student_shift in student_shifts" :key="student_shift.id" class="w-full p-6 odd:bg-gray-200 border rounded-md shadow-sm">

                    <div  class="flex space-x-10 items-center">
                        <div class="w-full">
                            <h1 class="text-xl font-bold">{{student_shift.name}}: {{ student_shift.from }} - {{ student_shift.to }}</h1>
                        </div>
                        <div class="w-80 text-right">

                            <button @click="shodStudentShiftPlanForm(student_shift)" class="btn btn-purple px-2 mr-1">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                                    <path fill="currentColor" d="M11.045 7.514a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Zm-4.572 3.072L3.857 15.92h7.949l-1.811-3.37-1.61 2.716-1.912-4.679Z"/>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 1v4a1 1 0 0 1-1 1H1m14 12a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2v16ZM11.045 7.514a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM3.857 15.92l2.616-5.333 1.912 4.68 1.61-2.717 1.81 3.37H3.858Z"/>
                                </svg>
                            </button>

                            <button @click="editRow(student_shift)" class="btn btn-orange px-2 mr-1">
                                <svg class="w-4 h-4 stroke-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279"/>
                                </svg>
                            </button>

                            <button @click="deleteRow(student_shift)" class="btn btn-red px-2">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                </svg>
                            </button>
                        </div>
                        
                    </div>

                    <div class="flex flex-wrap space-x-3">
                        <div v-for="plan in student_shift.student_shift_plans" :key="plan.id" class="w-auto mt-3 text-sm border border-gray-600 shadow-sm rounded-md">
                            <div class="flex relative group cursor-pointer">

                                <div class="bg-gray-600 text-white flex items-center text-2xl rounded-l-md">
                                    <div class="px-4">
                                        {{ plan.period_index }}
                                    </div>
                                </div>
                                <div class="flex flex-col space-y-1 py-2 px-3">
                                    <div class="uppercase text-xs">{{plan.slot}}</div>
                                    <div>{{plan.from}}</div>
                                    <hr class="border border-gray-600">
                                    <div>{{plan.to}}</div>
                                </div>

                                <button @click="deletePlan(plan)" class="btn btn-red absolute -top-3 -right-3 p-2 hidden group-hover:block">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                    </svg>
                                </button>


                            </div>
                            
                        </div>
                    </div>

                </div>

            </div>

        </div>


    </Administrator>

</template>
