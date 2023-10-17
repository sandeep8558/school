<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import Calendar from '@/Components/Calendar.vue';

export default {
    
    props: {
        academic_years: Object,
        grades: Object,
    },

    data: function () {
        return {

            days : ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'],

            isForm: false,

            academic_year: null,

            form: useForm({
                id: null,
                grade: [],
                from: null,
                to: null,
                note: null,
            }),

            holidays: [],

            e: {
                academic_year_id: null,
                grade_id: null,
            },

        };
    },

    methods: {

        submit(){

            this.form.post('/academic_year/save_holiday', {
                onFinish: data => {
                    this.optionsChanged(this.e);
                },
                onSuccess: data => {
                    this.form.reset();
                    this.setAcademicYear();
                },
            });

        },

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

                this.academic_year = academic_year;
                this.form.id = academic_year.id;

            }
        },

        getHolidays(academic_year_id, grade_id){
            fetch('/academic_year/fetch/holiday/'+academic_year_id+'/'+grade_id)
            .then(data => data.json())
            .then(res => {
                this.holidays = res;
            });
        },

        optionsChanged(e){
            this.e = e;
            this.getHolidays(e.academic_year_id, e.grade_id);
        },

        async dblClick(e){
            const options = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ on_date: e.on_date, grade_id: e.grade_id, academic_year_id: e.academic_year_id, _token: this.$page.props.csrf_token })
            };

            await fetch('/academic_year/add_remove_holiday', options)
            .then(response => response.json())
            .then(data => {
            });
            this.optionsChanged(e);
        },

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

    created: function() {
        this.setAcademicYear();
    },

    mounted: function() {
    },

    components: { Administrator, Head, Link, Calendar }
}
</script>

<template>

    <Head title="Holiday" />

    <Administrator>

        <div class="box">

            <div class="w-full">

                <div class="flex items-center">
                    <h2 class="text-2xl font-bold w-full">Holiday for {{ academic_year ? academic_year.name : '' }}</h2>
                    <div class="w-80">
                        <button class="btn float-right" :class="isForm ? 'btn-red' : 'btn-orange'" @click="isForm = !isForm;">
                            <span>{{ isForm ? 'Close Form' : 'Set Holiday' }}</span>
                        </button>
                    </div>
                </div>

                <div v-if="isForm" class="form-box mt-6 bg-white" id="branchForm">

                    <form @submit.prevent="submit" class="w-full">

                        <div class="w-full mb-4">
                            <label class="block mb-1" for="ay">Select Academic Year</label>
                            <select @change="setAcademicYear(form.id)" class="w-full rounded" name="ay" id="ay" v-model="form.id">
                                <option v-for="ay in academic_years" :key="ay.id" :value="ay.id">{{ ay.name }} | {{ ay.from }} - {{ ay.to }}</option>
                            </select>
                        </div>

                        <div class="flex space-x-5">

                            <!-- Grades -->
                            <div class="py-2">
                                <p class="mb-1">Please select grades</p>
                                <div v-for="grade in grades" :key="grade.id" class="mb-2">
                                    <input :id="'grade'+grade.id" name="grade_id" :value="grade.id" v-model="form.grade" type="checkbox" class="mr-2 cursor-pointer">
                                    <label :for="'grade'+grade.id" class="cursor-pointer">{{ grade.name }}</label>
                                </div>
                            </div>

                        </div>

                        <div class="flex space-x-5">

                            <div class="w-1/2 mb-4">
                                <label class="block mb-1" for="from">From Date</label>
                                <input type="date" class="w-full rounded" name="from" id="from" v-model="form.from">
                            </div>

                            <div class="w-1/2 mb-4">
                                <label class="block mb-1" for="to">To Date</label>
                                <input type="date" class="w-full rounded" name="to" id="to" v-model="form.to">
                            </div>

                        </div>

                        <div class="w-full mb-4">
                            <label class="block mb-1" for="note">Note</label>
                            <input type="text" class="w-full rounded" name="note" id="note" v-model="form.note">
                        </div>

                        


                        <div class="">
                            <input class="btn btn-purple cursor-pointer" type="submit" value="Save">
                        </div>

                    </form>

                </div>

            </div>

        </div>

        <Calendar @onOptionsChange="optionsChanged($event)" @onDblClick="dblClick($event)" :holidays="holidays"></Calendar>

    </Administrator>

</template>
