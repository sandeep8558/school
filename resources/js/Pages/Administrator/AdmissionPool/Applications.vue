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

    <div class="my-6 px-6 text-xl"><strong>{{ applications.length }}</strong> Applications Received</div>

    <Link v-for="app in applications" :key="app.id" class="box" target="_blank" :href="'/admission_pool/applications/'+app.id">
        <div class="w-28">
            <img :src="app.admission_photos[0].media" class="w-full">
        </div>
        <div class="w-full">
            <p>{{ app.first_name }} {{ app.middle_name }} {{ app.last_name }}</p>
            <p>{{ app.gender }}</p>
            <p>{{ app.phone }}</p>
            <p><strong>Rating: {{ app.total_rating }}</strong></p>
        </div>
    </Link>

</Administrator>

</template>