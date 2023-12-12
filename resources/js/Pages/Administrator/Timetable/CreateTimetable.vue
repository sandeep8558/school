<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {

    components: { 
        Administrator,
        Head,
        Link,
    },
    
    props: {
        academic_years: Object,
        grades: Object,
    },

    computed: {

        batches(){
            let batches = [];
            if(this.frm.academic_year_id != ''){
                this.academic_years.forEach(ay => {
                    if(ay.id == this.frm.academic_year_id){
                        ay.batches.forEach(b => {
                            if(this.frm.grade_id == b.grade_id){
                                if(this.frm.batch_id == b.id || this.frm.batch_id == ''){
                                    batches.push(b);
                                }
                            } else if(this.frm.grade_id == ''){
                                if(this.frm.batch_id == b.id || this.frm.batch_id == ''){
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
            if(this.frm.academic_year_id != ''){
                this.academic_years.forEach(ay => {
                    if(ay.id == this.frm.academic_year_id){
                        ay.batches.forEach(b => {
                            if(this.frm.grade_id == b.grade_id){
                                batches.push(b);
                            } else if(this.frm.grade_id == ''){
                                batches.push(b);
                            }
                        });
                    }
                });
            }
            return batches;
        },

        isValid(){
            let is = false;
            if(this.frm.academic_year_id != '' && this.frm.name != ''){
                is = true;
            }
            return is;
        },

    },

    data: function () {
        return {

            isForm: true,

            frm: {
                academic_year_id: '',
                grade_id: '',
                batch_id: '',
                name: '',
                first_lecture: false,
            },

        };
    },

    methods: {

        onFilter(){
            this.init();
        },

        init(){
        },

        createTimetable(){
            console.log(this.frm);
            let url = '/timetable/save_timetable';
            let frm = useForm(this.frm);
            frm.post(url, {
                onSuccess: res => {
                    //console.log(res);
                },
            });
        },

    },

    created: function() {
    },

}
</script>

<template>
<Head title="Create timetable" />
<Administrator>

    <!-- Filter -->
    <div class="box space-x-3">
        <div class="w-full">
            <select @change="onFilter()" class="w-full" v-model="frm.academic_year_id">
                <option value="">Select Academic Year</option>
                <option v-for="ay in academic_years" :key="ay.id" :value="ay.id">{{ ay.name }}</option>
            </select>
        </div>
        <div class="w-full">
            <select @change="onFilter()" class="w-full" v-model="frm.grade_id">
                <option value="">All Grades</option>
                <option v-for="gr in grades" :key="gr.id" :value="gr.id">{{ gr.name }}</option>
            </select>
        </div>
        <div class="w-full">
            <select @change="onFilter()" class="w-full" v-model="frm.batch_id">
                <option value="">All Batches</option>
                <option v-for="ba in batchSelect" :key="ba.id" :value="ba.id">{{ ba.grade.name }} - {{ ba.division.name }}</option>
            </select>
        </div>
    </div>

    <!-- Timetable list -->
    <div class="box">
        <div class="w-full">
            <button class="btn btn-blue mr-2 last:mr-0">Jesus</button>
        </div>
        <div>
            <button @click="isForm = !isForm"  class="btn whitespace-nowrap" :class="isForm ? 'btn-red' : 'btn-orange'">
                {{ isForm ? 'Close Form' : 'Create New Timetable' }}
            </button>
        </div>
    </div>

    <!-- Timetable creating form -->
    <div v-if="isForm" class="box">

        <div class="w-full">

            <div class="w-full">
                <label for="" class="block">Name the timetable</label>
                <input type="text" name="days" id="" class="w-full" v-model="frm.name">
            </div>

            <div>
                <span class="inline-block mt-4">
                    <input type="checkbox" name="first_lecture" id="first_lecture" class="mr-2" v-model="frm.first_lecture">
                    <label for="first_lecture">Is first lecture by class teacher?</label>
                </span>
            </div>

            <div class="mt-4">
                <button @click="createTimetable()" :disabled="!isValid" class="btn" :class="isValid ? 'btn-orange' : 'btn-disabled'">Create Timetable</button>
            </div>

        </div>

    </div>

</Administrator>
</template>
