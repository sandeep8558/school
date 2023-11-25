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
            grade_id: 'All',
            academic_year_id: null,
            search: '',
            applications: [],
            isDownload : false,
            cols: ['ID','Name','Remark'],
            columns: [
                { key: 'id', text: 'ID' },
                { key: 'name', text: 'Name' },
                { key: 'grade', text: 'Grade' },
                { key: 'email', text: 'Email' },
                { key: 'phone', text: 'Mobile' },
                { key: 'dob', text: 'DOB' },
                { key: 'gender', text: 'Gender' },
                { key: 'blood_group', text: 'Blood Group' },
                { key: 'religion', text: 'Religion' },
                { key: 'cast', text: 'Cast' },
                { key: 'subcast', text: 'Sub-cast' },
                { key: 'cast_category', text: 'Cast Category' },
                { key: 'mothertongue', text: 'Mother Tongue' },
                { key: 'nationality', text: 'Nationality' },
                { key: 'aadhar', text: 'Aadhar' },
                { key: 'is_single_parent', text: 'Single Parent' },
                { key: 'single_what', text: 'Single' },
                { key: 'is_alumnus', text: 'Alumnus' },
                { key: 'special_need', text: 'Special Need' },
                { key: 'speaking_hearing', text: 'Speaking And Hearing' },
                { key: 'total_rating', text: 'Rating' },
                { key: 'status', text: 'Status' },
                { key: 'first_language', text: 'First Language' },
                { key: 'second_language', text: 'Second Language' },
                { key: 'third_language', text: 'Third Language' },
                { key: 'previous_school', text: 'Previous School' },
                { key: 'remark', text: 'Remark' },
            ],
        };
    },

    methods: {
        async getApplications(){
            let applications = [];
            if(this.academic_year_id != null){
                await fetch('/admission_pool/fetch_applications/' + this.academic_year_id + '?search=' + this.search + '&grade_id=' + this.grade_id + '&order_by=id&order=desc').then(res => {
                    applications = res.json();
                });
            }
            this.applications = await applications;
        },

        dobs(dt){
            let dte = '';
            dte = dt.split('-');
            return dte[2] + '-' + dte[1] + '-' + dte[0];
        },

        remarkKeelLast(){
            let ind = this.cols.indexOf('Remark');
            if(ind >= 0){
                this.cols.splice(ind, 1);
                this.cols.push('Remark');
            }
        }
    },

    computed: {
    },

    created: function() {
        if(this.academic_years.length > 0){
            this.academic_year_id = this.academic_years[0].id;
        }
        this.getApplications();
    },

    components: { Administrator, Head, Link }
}
</script>

<template>

<Head title="Applications" />

<Administrator>

    <div class="box">
        
        <div class="w-auto">
            <select class="" v-model="academic_year_id" @change="getApplications()">
                <option v-for="(ay) in academic_years" :key="ay.id" :value="ay.id">{{ ay.name }}</option>
            </select>
        </div>

        <div class="w-auto">
            <select class="" v-model="grade_id" @change="getApplications()">
                <option value="All">All</option>
                <option v-for="(ay) in grades" :key="ay.id" :value="ay.id">{{ ay.name }}</option>
            </select>
        </div>

        <div class="w-full">
            <input v-model="search" type="text" class="w-full" placeholder="Application ID or Mobile or Email Address" @change="getApplications()">
        </div>
    </div>

    <div class="box">
        <div class="w-full">

            <div class="">
                <button @click="isDownload = !isDownload" class="btn btn-orange">Download Applications</button>
            </div>

            <div v-if="isDownload" class="mt-5">
                <div class="w-full flex flex-wrap">
                    <div v-for="col in columns" :key="col" class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-1">
                        <input @change="remarkKeelLast()" type="checkbox" :id="col.key" :value="col.text" class="mr-3" name="cols" v-model="cols">
                        <label :for="col.key">{{ col.text }}</label>
                    </div>
                </div>

                <div class="mt-5">
                    <a :href="'/pdf/applications/'+academic_year_id+'/' + grade_id + '?cols='+cols.toString()" target="_blank" class="btn btn-purple">Applications</a>
                </div>
            </div>

        </div>
    </div>

    <div class="my-6 px-6 text-xl">
        <strong>{{ applications.length }}</strong> Applications Received
    </div>

    <Link v-for="app in applications" :key="app.id" class="box" target="_blank" :href="'/admission_pool/applications/'+app.id">
        <div class="w-28">
            <img :src="app.admission_photos[0].media" class="w-full">
        </div>
        <div class="w-full">
            <p>Application ID: {{ app.id }} <span class="inline-block float-right">Rating: {{ app.total_rating }}</span></p>
            <p>{{ app.first_name }} {{ app.middle_name }} {{ app.last_name }} - {{ app.gender }}</p>
            <p>Grade - {{ app.grade }} | Date of Birth - {{ dobs(app.dob) }}</p>
            <p>{{ app.phone }} - {{ app.email }}</p>
        </div>
    </Link>

</Administrator>

</template>