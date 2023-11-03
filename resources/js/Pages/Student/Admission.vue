<script>
import Student from '@/Layouts/Student.vue';
import { Head } from '@inertiajs/vue3';


export default {

    components: { Head, Student },

    props: {
        isAdmission: String,
        branches: Object,
    },

    data: function () {
        return {
            formData: {
                academic_year_id: '',
                branch_id: '',
                grade_id: '',
            },
        };
    },

    computed: {

        academic_years(){
            let academic_years = [];
            if(this.formData.branch_id != ''){
                this.branches.forEach(branch => {
                    if(this.formData.branch_id == branch.id){
                        academic_years = branch.open_academic_years;
                    }
                });
            }
            return academic_years;
        },

        grades (){
            let grades = [];
            if(this.formData.academic_year_id != ''){
                this.academic_years.forEach(academic_year => {
                    if(academic_year.id == this.formData.academic_year_id){
                        grades = academic_year.academic_year_intakes;
                    }
                });
            }
            return grades;
        },

    },

    methods: {
    },

    mounted: function() {
    },

}

</script>

<template>
    <Head title="Dashboard" />

    <Student>

        <!-- When admissions are closed this block get displayed -->
        <div v-if="isAdmission == 'No'" class="box">
            Admissions are closed!
        </div>

        <!-- When admissions are open -->
        <div v-if="isAdmission == 'Yes'" class="box">
            
            <div class="w-full">

                <div class="w-full mb-5">
                    <label for="">Branch</label>
                    <select v-model="formData.branch_id" name="" id="" class="block w-full">
                        <option value="">Select Branch</option>
                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{ branch.name }}</option>
                    </select>
                </div>

                <div class="w-full mb-5">
                    <label for="">Academic Year</label>
                    <select v-model="formData.academic_year_id" name="" id="" class="block w-full">
                        <option value="">Select Academic Year</option>
                        <option v-for="academic_year in academic_years" :key="academic_year.id" :value="academic_year.id">{{ academic_year.name }}</option>
                    </select>
                </div>

                <div class="w-full mb-5">
                    <label for="">Grade</label>
                    <select name="" id="" class="block w-full">
                        <option value="">Select Grade</option>
                        <option v-for="grade in grades" :key="grade.id" :value="grade.grade.id">{{ grade.grade.name }}</option>
                    </select>
                </div>

            </div>
            
        </div>

        

    </Student>
</template>