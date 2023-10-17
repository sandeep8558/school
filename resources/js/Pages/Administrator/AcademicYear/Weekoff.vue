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
                sunday: { is:false,all:false,first:false,second:false,third:false,fourth:false,fifth:false },
                monday: { is:false,all:false,first:false,second:false,third:false,fourth:false,fifth:false },
                tuesday: { is:false,all:false,first:false,second:false,third:false,fourth:false,fifth:false },
                wednesday: { is:false,all:false,first:false,second:false,third:false,fourth:false,fifth:false },
                thursday: { is:false,all:false,first:false,second:false,third:false,fourth:false,fifth:false },
                friday: { is:false,all:false,first:false,second:false,third:false,fourth:false,fifth:false },
                saturday: { is:false,all:false,first:false,second:false,third:false,fourth:false,fifth:false },
            }),

            weekoffs: [],

            e: {
                academic_year_id: null,
                grade_id: null,
            },

        };
    },

    methods: {

        submit(){

            this.form.post('/academic_year/save_weekoff', {
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

        checkAll(day){
            this.form[day].all = (this.form[day].first && this.form[day].second &&  this.form[day].third && this.form[day].fourth && this.form[day].fifth) ? true : false;
        },

        checkForm(day){
            let a = this.form[day].all;
            this.form[day].first = a;
            this.form[day].second = a;
            this.form[day].third = a;
            this.form[day].fourth = a;
            this.form[day].fifth = a;
        },

        changeAllValues(day){
            let val = day.is;
            day.all = day.first = day.second = day.third = day.fourth = day.fifth = val;
        },

        getWeekoffs(academic_year_id, grade_id){
            fetch('/academic_year/fetch/weekoff/'+academic_year_id+'/'+grade_id)
            .then(data => data.json())
            .then(res => {
                this.weekoffs = res;
            });
        },

        optionsChanged(e){
            this.e = e;
            this.getWeekoffs(e.academic_year_id, e.grade_id);
        },

        async dblClick(e){

            const options = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ on_date: e.on_date, grade_id: e.grade_id, academic_year_id: e.academic_year_id, note: 'Week Off', _token: this.$page.props.csrf_token })
            };
            
            await fetch('/academic_year/add_remove_weekoff', options)
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

    <Head title="Week off" />

    <Administrator>

        <div class="box">

            <div class="w-full">

                <div class="flex items-center">
                    <h2 class="text-2xl font-bold w-full">Week Off for {{ academic_year ? academic_year.name : '' }}</h2>
                    <div class="w-80">
                        <button class="btn float-right" :class="isForm ? 'btn-red' : 'btn-orange'" @click="isForm = !isForm;">
                            <span>{{ isForm ? 'Close Form' : 'Set Week Off' }}</span>
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
                            <div class="py-2 px-3">
                                <p class="mb-1">Please select grades</p>
                                <div v-for="grade in grades" :key="grade.id" class="mb-2">
                                    <input :id="'grade'+grade.id" name="grade_id" :value="grade.id" v-model="form.grade" type="checkbox" class="mr-2 cursor-pointer">
                                    <label :for="'grade'+grade.id" class="cursor-pointer">{{ grade.name }}</label>
                                </div>
                            </div>


                            <!-- Days -->
                            <div class="py-2">
                                <p class="mb-1">Please select week offs</p>

                                <div v-for="day in days" :key="day" class="mb-2">
                                    <input v-model="form[day].is" :id="day" name="days" :value="day" type="checkbox" class="mr-2 cursor-pointer" @change="changeAllValues(form[day])">
                                    <label class="cursor-pointer capitalize" :for="day">{{ day }}</label>
                                    
                                    <!-- Sunday Checkboxes -->
                                    <div v-if="form[day].is" class="flex space-x-5 ml-6 mb-5">
                                        <div>
                                            <input @change="checkForm(day)" v-model="form[day].all" type="checkbox" :id="day+'all'" value="all" class="mr-2 cursor-pointer">
                                            <label class="cursor-pointer" :for="day+'all'">All</label>
                                        </div>
                                        <div>
                                            <input @change="checkAll(day)" v-model="form[day].first" type="checkbox" :id="day+'1'" value="1" class="mr-2 cursor-pointer">
                                            <label class="cursor-pointer" :for="day+'1'">1st</label>
                                        </div>
                                        <div>
                                            <input @change="checkAll(day)" v-model="form[day].second" type="checkbox" :id="day+'2'" value="2" class="mr-2 cursor-pointer">
                                            <label class="cursor-pointer" :for="day+'2'">2nd</label>
                                        </div>
                                        <div>
                                            <input @change="checkAll(day)" v-model="form[day].third" type="checkbox" :id="day+'3'" value="3" class="mr-2 cursor-pointer">
                                            <label class="cursor-pointer" :for="day+'3'">3rd</label>
                                        </div>
                                        <div>
                                            <input @change="checkAll(day)" v-model="form[day].fourth" type="checkbox" :id="day+'4'" value="4" class="mr-2 cursor-pointer">
                                            <label class="cursor-pointer" :for="day+'4'">4th</label>
                                        </div>
                                        <div>
                                            <input @change="checkAll(day)" v-model="form[day].fifth" type="checkbox" :id="day+'5'" value="5" class="mr-2 cursor-pointer">
                                            <label class="cursor-pointer" :for="day+'5'">5th</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        

                        <div class="">
                            <input class="btn btn-purple cursor-pointer" type="submit" value="Save">
                        </div>
                        

                    </form>

                </div>


            </div>

        </div>

        <Calendar @onOptionsChange="optionsChanged($event)" @onDblClick="dblClick($event)" :weekoffs="weekoffs"></Calendar>

    </Administrator>

</template>
