<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {
    
    props: {
        academic_years: Object,
        grades: Object,
    },

    computed: {

        batches(){
            let batches = [];
            if(this.search.academic_year_id != ''){
                this.academic_years.forEach(ay => {
                    if(ay.id == this.search.academic_year_id){
                        ay.batches.forEach(b => {
                            if(this.search.grade_id == b.grade_id){
                                if(this.search.batch_id == b.id || this.search.batch_id == ''){
                                    batches.push(b);
                                }
                            } else if(this.search.grade_id == ''){
                                if(this.search.batch_id == b.id || this.search.batch_id == ''){
                                    batches.push(b);
                                }
                            }
                        });
                    }
                });
            }
            return batches;
        },
        
        batchSelect(){
            let batches = [];
            if(this.search.academic_year_id != ''){
                this.academic_years.forEach(ay => {
                    if(ay.id == this.search.academic_year_id){
                        ay.batches.forEach(b => {
                            if(this.search.grade_id == b.grade_id){
                                batches.push(b);
                            } else if(this.search.grade_id == ''){
                                batches.push(b);
                            }
                        });
                    }
                });
            }
            return batches;
        },

        subjects(){
            let s = [];
            this.grades.forEach(grade => {
                if(grade.id == this.search.grade_id){
                    s = grade.subject_in_groups;
                }
            });
            return s;
        },

        isValid(){
            let is = false;
            is  = this.search.academic_year_id != '' ? true : false;
            return is;
        },

        isMon(){
            return this.setDayVal('Mon');
        },

        isTue(){
            return this.setDayVal('Tue');
        },

        isWed(){
            return this.setDayVal('Wed');
        },

        isThu(){
            return this.setDayVal('Thu');
        },

        isFri(){
            return this.setDayVal('Fri');
        },

        isSat(){
            return this.setDayVal('Sat');
        },

        isSun(){
            return this.setDayVal('Sun');
        },

    },

    data: function () {
        return {

            search: {
                academic_year_id: '',
                grade_id: '',
                batch_id: '',
            },

            days: [
                { is: false, short:'Mon', text: 'Monday' },
                { is: false, short:'Tue', text: 'Tuesday' },
                { is: false, short:'Wed', text: 'Wednesday' },
                { is: false, short:'Thu', text: 'Thursday' },
                { is: false, short:'Fri', text: 'Friday' },
                { is: false, short:'Sat', text: 'Saturday' },
                { is: false, short:'Sun', text: 'Sunday' },
            ],

            firstLectureByClassTeacher: true,
            deleteOldAndCreateNew: true,

        };
    },

    methods: {

        setDayVal(day){
            let is = false;
            this.batchSelect.forEach(batch => {
                batch.batch_timetables.forEach(btt => {
                    if(btt.day == day){
                        is = true;
                    }
                });
            });
            return is;
        },
        
        getStudents(){
            this.init();
        },

        createTimetable(){
            let url = '/batch_manager/create_timetable';
            let frm = useForm({
                first_lecture: this.firstLectureByClassTeacher,
                delete_old: this.deleteOldAndCreateNew,
                days: this.days,
                academic_year_id: this.search.academic_year_id,
                grade_id: this.search.grade_id,
                batch_id: this.search.batch_id
            });
            frm.post(url, {
                onSuccess: res => {
                    console.log(res);
                },
            });
        },

        init(){
            this.days[0].is = this.isMon;
            this.days[1].is = this.isTue;
            this.days[2].is = this.isWed;
            this.days[3].is = this.isThu;
            this.days[4].is = this.isFri;
            this.days[5].is = this.isSat;
            this.days[6].is = this.isSun;
        },

        getTimetableSlot(batch_id, student_shift_plan_id, day){
            let slot = null;
            this.batchSelect.forEach(batch => {
                if(batch.id == batch_id){
                    batch.batch_timetables.forEach(btt => {
                        if(btt.student_shift_plan_id == student_shift_plan_id && btt.day == day){
                            slot = btt.id;
                        }
                    });
                }
            });
            return slot;
        },

    },

    created: function() {
        this.init();
    },

    components: { Administrator, Head, Link }
}
</script>

<template>
<Head title="Timetable" />
<Administrator>

    <!-- Filter -->
    <div class="box space-x-3">
        <div class="w-full">
            <select @change="getStudents()" class="w-full" v-model="search.academic_year_id">
                <option value="">Select Academic Year</option>
                <option v-for="ay in academic_years" :key="ay.id" :value="ay.id">{{ ay.name }}</option>
            </select>
        </div>
        <div class="w-full">
            <select @change="getStudents()" class="w-full" v-model="search.grade_id">
                <option value="">All Grades</option>
                <option v-for="gr in grades" :key="gr.id" :value="gr.id">{{ gr.name }}</option>
            </select>
        </div>
        <div class="w-full">
            <select @change="getStudents()" class="w-full" v-model="search.batch_id">
                <option value="">All Batches</option>
                <option v-for="ba in batchSelect" :key="ba.id" :value="ba.id">{{ ba.grade.name }} - {{ ba.division.name }}</option>
            </select>
        </div>
    </div>

    <!-- Timetable settings -->
    <div class="box">
        <div class="w-full">

            <div>
                <span v-for="day in days" :key="day" class="inline-block mr-5">
                    <input type="checkbox" name="days" :id="'days' + day.short" class="mr-2" v-model="day.is">
                    <label :for="'days' + day.short">{{ day.text }}</label>
                </span>
            </div>

            <div>
                <span class="inline-block mt-4">
                    <input type="checkbox" name="days" id="" class="mr-2" v-model="firstLectureByClassTeacher">
                    <label for="">Is first lecture by class teacher?</label>
                </span>
            </div>

            <div>
                <span class="inline-block mt-4">
                    <input type="checkbox" name="days" id="" class="mr-2" v-model="deleteOldAndCreateNew">
                    <label for="">Do you want to delete old and create new timetable?</label>
                </span>
            </div>

            <div class="mt-4">
                <button @click="createTimetable()" :disabled="!isValid" class="btn" :class="isValid ? 'btn-orange' : 'btn-disabled'">Create Timetable</button>
            </div>

        </div>
    </div>

    <!-- Timetables -->
    <div class="box">
        <div class="w-full">
            <!-- <div v-for="tt in batches"></div> -->
        </div>
    </div>

    <!-- Batch wise timetable -->
    <div class="box space-x-0" v-for="batch in batches" :key="batch.id">

        <div class="w-full">

            <h1 class="font-bold text-center text-xl uppercase">{{ batch.grade.name }} - {{ batch.division.name }}</h1>
            <p class="text-center mb-4">{{ batch.student_shift.name }} ({{ batch.student_shift.from.substring(0,5) }}-{{ batch.student_shift.to.substring(0,5) }})</p>

            <p v-for="bt in batch.batch_teachers" :key="bt.id">{{ bt.staff.full_name }}</p>

            <table class="w-full">

                <thead>
                    <tr>
                        <template v-for="day in days" :key="day">
                            <th v-if="day.is" class="border-2 border-gray-500 text-center uppercase font-bold">{{ day.short }}</th>
                        </template>
                    </tr>
                </thead>

                <tbody v-for="ssp in batch.student_shift.student_shift_plans" :key="ssp.id">
                    <tr>
                        <template v-for="day in days" :key="day">
                            <td v-if="day.is" class="border-2 border-gray-500 text-center uppercase">
                                <p>{{ ssp.from.substring(0,5) }} - {{ ssp.to.substring(0,5) }}</p>
                                {{ ssp.slot }} - {{ getTimetableSlot(batch.id, ssp.id, day.short) }}
                            </td>
                        </template>
                    </tr>
                </tbody>

            </table>

        </div>

    </div>

</Administrator>
</template>
