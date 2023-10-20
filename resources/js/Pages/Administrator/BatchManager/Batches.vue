<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import {openModal, closeModal} from "jenesius-vue-modal";
import BatchForm from '@/Pages/Administrator/BatchManager/BatchForm.vue';

export default {
    
    props: {
        errors: Object,
        academic_years: Object,
        grades: Object,
        divisions: Object,
        classrooms: Object,
        student_shifts: Object,
    },

    data: function () {
        return {
            navigation: {
                academic_year_id: null,
                grade_id : 0,
            },
        };
    },

    methods: {

        setAcademicYear(id=null){
            let academic_year = null;
            if(this.academic_years.length > 0){
                this.academic_years.forEach(ay => {
                    if(id == null){
                        if(new Date(this.today) >= new Date(ay.from) && new Date(this.today) <= new Date(ay.to)){
                            academic_year =  ay;
                        }
                    } else {
                        if(id == ay.id){
                            academic_year =  ay;
                        }
                    }
                });
                if(academic_year == null){
                    academic_year = this.academic_years[0];
                }
                /* this.academic_year = academic_year; */
                this.navigation.academic_year_id = academic_year.id;
            }
        },

        isBatch(grade_id, division_id){
            let batch = null;
            this.academic_years.forEach(ay => {
                if(ay.id == this.navigation.academic_year_id){
                    ay.batches.forEach(bat => {
                        if(bat.grade_id == grade_id & bat.division_id == division_id){
                            batch = bat;
                        }
                    });
                }
            });
            return batch;
        },

        async createBatch(academic_year_id, grade, division){
            
            let frm = await openModal(BatchForm, {
                title : grade.name + ' - ' + division.name,
                classrooms: this.classrooms,
                student_shifts: this.student_shifts,
            });

            frm.on('close', e => {
                closeModal();
            });

            await frm.on('save', e => {
                let a = new useForm({
                    academic_year_id: academic_year_id,
                    grade_id: grade.id,
                    division_id: division.id,
                    classroom_id: e.classroom_id,
                    student_shift_id: e.student_shift_id,
                });

                a.post('/batch_manager/create_batch');

                closeModal();
            });

        },

    },

    created: function() {
        this.setAcademicYear();
    },

    mounted: function() {
    },

    computed: {

        today(){
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0');
            let yyyy = today.getFullYear();
            return yyyy + '-' + mm + '-' + dd;
        },

    },

    components: { Administrator, Head, Link }
}
</script>

<template>

    <Head title="Batches" />

    <template id="hello">
        <div>

            Jesus loves you
            
        </div>
    </template>

    <Administrator>

        <div>

            <div class="box">
                <div class="flex w-full">
                    <div class="w-1/2">
                        <select name="academic_year_id" id="academic_year_id" v-model="navigation.academic_year_id" class="w-full">
                            <option v-for="academic_year in academic_years" :key="academic_year.id" :value="academic_year.id">{{ academic_year.name }}</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <select name="grade_id" id="grade_id" v-model="navigation.grade_id" class="w-full">
                            <option value="0">All</option>
                            <option v-for="grade in grades" :key="grade.id" :value="grade.id">{{ grade.name }}</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="py-5">
                <template v-for="grade in grades" :key="grade.id">
                    <template v-if="navigation.grade_id == grade.id || navigation.grade_id == 0">
                        <h2 class="mb-5 text-center text-xl">{{ grade.name }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-5 w-full mb-10">
                            <div v-for="division in divisions" :key="grade.id + '_' + division.id" class="shadow border rounded-lg bg-white">
                                

                                <!-- Batch Card Title -->
                                <div class="px-6 py-3 btn-purple rounded-t-lg text-white">{{ grade.name + ' - ' +  division.name }}</div>

                                <!-- If Batch is null -->
                                <div v-if="isBatch(grade.id, division.id) == null" class="bg-white p-6 border rounded-b-lg">
                                    <button @click="createBatch(navigation.academic_year_id, grade, division)" class="btn btn-orange w-full">Create {{ grade.name }} - {{ division.name }} Batch</button>
                                </div>

                                <!-- If batch exists -->
                                <div v-if="isBatch(grade.id, division.id) != null" :set="batch = isBatch(grade.id, division.id)">
                                    <div class="p-6">
                                        <ul>
                                            <li v-for="subject in batch.grade.subject_in_groups" :key="subject.id" class="border-b last:border-b-0 py-2 text-sm"><span class="inline-block w-7">{{ subject.lectures_per_week }}</span> {{ subject.subject.name }}</li>
                                        </ul>
                                    </div>
                                    <div class="px-6 py-3 bg-purple-100 rounded-b-lg text-gray-500">


                                        <span :set="shift = batch.student_shift">{{ shift.name }}: {{ (shift.from).split(':')[0] + ':' + (shift.from).split(':')[1] }} - {{ (shift.to).split(':')[0] + ':' + (shift.to).split(':')[1] }}</span>
                                        <span class="float-right">{{ batch.classroom.name }}</span>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </template>
                </template>
            </div>


        </div>

    </Administrator>

</template>
