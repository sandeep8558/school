<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {
    
    props: {
        errors: Object,
        students: Object,
        grades: Object,
        academic_years: Object,
        admission_academic_year_id: String,
        admission_grade_id : String,
    },

    data: function () {
        return {
            frm : {
                admission_academic_year_id: this.admission_academic_year_id,
                admission_grade_id : this.admission_grade_id,
            },
            formation: {
                prefix: '',
                seperator: '',
                suffix: '',
                start: 1,
            },
        };
    },

    methods: {
        openWith(){
            this.$refs.myForm.submit();
        },
        saveGRN(){
            let a = Object.assign(this.frm, this.formation);
            let frm = useForm(a);
            frm.post('/student_manager/save_grn');
        },
    },

    mounted: function() {
    },

    components: { Administrator, Head, Link }
}
</script>

<template>
<Head title="GRN Allotment" />
<Administrator>

    <form class="box space-x-3" action="/student_manager/grn_allotment" method="get" ref="myForm">

        <div class="w-1/2">
            <select class="w-full" name="admission_academic_year_id" id="admission_academic_year_id" @change="openWith()" v-model="frm.admission_academic_year_id">
                <option value="All">All</option>
                <option v-for="ay in academic_years" :key="ay.id" :value="ay.id">{{ ay.name }}</option>
            </select>
        </div>

        <div class="w-1/2">
            <select class="w-full" name="admission_grade_id" id="admission_grade_id" @change="openWith()" v-model="frm.admission_grade_id">
                <option value="All">All</option>
                <option v-for="grade in grades" :key="grade.id" :value="grade.id">{{ grade.name }}</option>
            </select>
        </div>

    </form>

    <div class="box space-x-3">

        <div class="w-1/2">
            <input class="w-full" type="text" placeholder="Start with" v-model="formation.start">
        </div>

        <div class="w-1/2">
            <input class="w-full" type="text" placeholder="Prefix" v-model="formation.prefix">
        </div>

        <div class="w-1/2">
            <input class="w-full" type="text" placeholder="Seperator" v-model="formation.seperator">
        </div>

        <div class="w-1/2">
            <input class="w-full" type="text" placeholder="Suffix" v-model="formation.suffix">
        </div>

        <div class="">
            <button @click="saveGRN()" class="btn btn-orange">Save</button>
        </div>

    </div>

    <div class="box">
        <div class="w-full">

            <table class="w-full">

                <thead>
                    <tr>
                        <th class="border border-gray-400 px-2 py-3">ID</th>
                        <th class="border border-gray-400 px-2 py-3">Index</th>
                        <th class="border border-gray-400 px-2 py-3">GRN</th>
                        <th class="border border-gray-400 px-2 py-3">Form</th>
                        <th class="border border-gray-400 px-2 py-3 text-left">Name</th>
                        <th class="border border-gray-400 px-2 py-3">AY</th>
                        <th class="border border-gray-400 px-2 py-3">Grade</th>
                        <th class="border border-gray-400 px-2 py-3">Gender</th>
                        <th class="border border-gray-400 px-2 py-3">DOB</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(student, ind) in students" :key="student.id">
                        <td class="border border-gray-400 p-2 text-center w-24">{{ student.id }}</td>
                        <td class="border border-gray-400 p-2 text-center w-24">{{ ind }}</td>
                        <td class="border border-gray-400 p-2 text-center w-24">{{ student.gr_number }}</td>
                        <td class="border border-gray-400 p-2 text-center w-24">
                            {{ formation.prefix }}{{ formation.seperator }}{{ (Number(ind) + Number(formation.start)) }}{{ formation.seperator }}{{ formation.suffix }}
                        </td>
                        <td class="border border-gray-400 p-2">{{ student.first_name }} {{ student.middle_name }} {{ student.last_name }}</td>
                        <td class="border border-gray-400 p-2 text-center w-32">{{ student.academic_year.name }}</td>
                        <td class="border border-gray-400 p-2 text-center w-24">{{ student.grade.name }}</td>
                        <td class="border border-gray-400 p-2 text-center w-24">{{ student.gender }}</td>
                        <td class="border border-gray-400 p-2 text-center w-32">{{ student.dob }}</td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>

</Administrator>
</template>
