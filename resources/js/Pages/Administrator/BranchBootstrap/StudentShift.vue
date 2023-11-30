<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {openModal, closeModal} from "jenesius-vue-modal";
import ShiftPlanForm from '@/Pages/Administrator/BranchBootstrap/ShiftPlanForm.vue';

export default {

    components: { Administrator, Head, Link, ShiftPlanForm, },

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

                    let frm = useForm({
                        id: plan.id
                    });

                    frm.post('/branch_bootstrap/delete_student_shift_plan', {
                        onSuccess: data => {
                        }
                    });

                }
            });
        },

        async shodStudentShiftPlanForm(student_shift){

            let frm = await openModal(ShiftPlanForm, {
                student_shift : student_shift,
            });

            frm.on('close', e => {
                closeModal();
            });

            frm.on('save', e => {
                let frm = useForm(e);
                frm.post('/branch_bootstrap/save_student_shift_plan', {
                    onFinish: res => {
                        closeModal();
                    },
                });
            });
        },

        async editPlan(plan){
            
            let frm = await openModal(ShiftPlanForm, {
                plan : plan,
            });

            frm.on('close', e => {
                closeModal();
            });

            frm.on('save', e => {
                let frm = useForm(e);
                frm.post('/branch_bootstrap/save_student_shift_plan', {
                    onFinish: res => {
                        closeModal();
                    },
                });
            });
        },

    },

    mounted: function() {
    },
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

                    <div class="flex flex-wrap">
                        <div v-for="plan in student_shift.student_shift_plans" :key="plan.id" class="w-auto mt-3 mr-3 text-sm border border-gray-600 shadow-sm rounded-md">
                            <div class="flex relative group cursor-pointer">

                                <div class="bg-gray-600 text-white flex items-center text-2xl rounded-l-md">
                                    <div class="px-4">
                                        <p class="text-center">{{ plan.period_index }}</p>
                                        <p class="text-sm text-center">{{ plan.is_in_halfday[0] }}</p>
                                    </div>
                                </div>

                                <div class="flex flex-col space-y-1 py-2 px-3">
                                    <div class="uppercase text-xs">{{plan.slot}}</div>
                                    <div>{{plan.from}}</div>
                                    <hr class="border border-gray-600">
                                    <div>{{plan.to}}</div>
                                </div>

                                <button @click="editPlan(plan)" class="btn btn-orange absolute -top-3 p-2 hidden group-hover:block">
                                    <svg class="w-4 h-4 stroke-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279"/>
                                    </svg>
                                </button>

                                <button @click="deletePlan(plan)" class="btn btn-red absolute -top-3 right-0 p-2 hidden group-hover:block">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                    </svg>
                                </button>

                            </div>

                        </div>

                        <div class="w-auto mt-3 text-sm border border-gray-600 shadow-sm rounded-md">
                            <div class="flex relative group h-full">

                                <div class="flex items-center text-2xl rounded-l-md h-full">
                                    <button @click="shodStudentShiftPlanForm(student_shift)" class="btn btn-purple px-2 py-5 h-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>

                                    </button>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


    </Administrator>

</template>
