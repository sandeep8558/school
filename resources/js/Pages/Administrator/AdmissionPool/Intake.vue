<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {
    
    props: {
        errors: Object,
        academic_years: Object,
        grades: Object,
    },

    data: function () {
        return {
            edit : {
                academic_year_id : null,
                grade_id : null,
                intake : 0,
            },
        };
    },

    methods: {

        checkIntake(academic_year_id, grade_id){
            let i = 0;
            this.academic_years.forEach(academic_year => {
                if(academic_year.id == academic_year_id){
                    academic_year.academic_year_intakes.forEach(intake => {
                        if(intake.grade_id == grade_id){
                            i = intake.intake;
                        }
                    });
                }
            });
            return i;
        },

        editIntake(academic_year_id, grade_id){
            this.edit.academic_year_id = academic_year_id;
            this.edit.grade_id = grade_id;
            this.edit.intake = this.checkIntake(academic_year_id, grade_id);
        },

        saveIntake(){
            let frm = new useForm(this.edit);
            frm.post('/admission_pool/save_intake', {
                onFinish: data => {
                    this.resetEdit();
                },
            });
        },

        resetEdit(){
            this.edit.academic_year_id = null;
            this.edit.grade_id = null;
            this.edit.intake = 0;
        },

    },

    mounted: function() {
    },

    components: { Administrator, Head, Link }
}
</script>

<template>

    <Head title="Intake" />

    <Administrator>

        <div v-for="academic_year in academic_years" :key="academic_year.id" class="box">
            <div class="w-full">
                
                <div class="">
                    <span class="inline-block mr-5 text-xl">{{ academic_year.name }}</span>
                    <span class="inline-block ml-5 float-right">{{ academic_year.from }} - {{ academic_year.to }}</span>
                </div>

                <hr class="my-5">

                <div v-for="grade in grades" :key="grade.id" class="w-full mb-5 last:mb-0">
                    <span class="inline-block w-32">{{ grade.name }}</span> - <span class="cursor-pointer" @dblclick="editIntake(academic_year.id, grade.id)">
                        <input @keyup.enter="saveIntake()" v-if="edit.academic_year_id == academic_year.id && edit.grade_id == grade.id" type="text" v-model="edit.intake">
                        <span v-if="edit.academic_year_id != academic_year.id || edit.grade_id != grade.id">{{ checkIntake(academic_year.id, grade.id) }}</span>
                        <span v-if="edit.academic_year_id == academic_year.id && edit.grade_id == grade.id" class="inline-block ml-5">Press Enter to update value</span>
                    </span>
                </div>

            </div>
            
        </div>

    </Administrator>

</template>