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
            status: '',
            applications: [],
        };
    },

    methods: {

        migrateToStudent(id){
            let frm = new useForm({id:id});
            frm.post('/admission_pool/migrate_to_students', {
                onFinish: res => {
                    console.log(res);
                },
            });
        },

        async getApplications(){
            let applications = [];
            if(this.academic_year_id != null){
                await fetch('/admission_pool/fetch_applications/' + this.academic_year_id + '?search=' + this.search + '&grade_id=' + this.grade_id + '&status=' + this.status + '&order_by=total_rating&order=desc').then(res => {
                    applications = res.json();
                });
            }
            this.applications = await applications;
        },

        updateApplications(id, col, val){
            this.applications.forEach(app => {
                if(app.id == id){
                    app[col] = val;
                }
            });
        },

        getStatus(status){
            let bg = 'bg-gray-50';
            switch(status){
                case 'Pending':
                bg = 'bg-gray-50';
                break;
                case 'Accepted':
                bg = 'bg-green-50';
                break;
                case 'Hold':
                bg = 'bg-orange-50';
                break;
                case 'Cancelled':
                bg = 'bg-red-100';
                break;
                case 'Rejected':
                bg = 'bg-red-50';
                break;
                case 'Confirmed':
                bg = 'bg-green-200';
                break;
            }
            return bg;
        },

        updateStatus(e, obj){
            this.updateApplications(obj.id, 'status', e.target.value);

            let data = {
                _token: this.$page.props.csrf_token,
                id: obj.id,
                status: e.target.value
            };

            const options = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(data)
            };

            fetch('/admission_pool/update_admission', options)
            .then(res => {
                let a = res.json();
            });
        },

        getStatus(status){
            return (status == '' || status == null) ? 'All' : status;
        },

        dobs(dt){
            let dte = '';
            dte = dt.split('-');
            return dte[2] + '-' + dte[1] + '-' + dte[0];
        },
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

    <Head title="Merit List" />

    <Administrator>

        <div class="box space-x-3">
            
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

            <div class="w-auto">
                <select class="" v-model="status" @change="getApplications()">
                    <option value="">All</option>
                    <option value="Accepted">Accepted</option>
                    <option value="Rejected">Rejected</option>
                    <option value="Hold">Hold</option>
                    <option value="Cancelled">Cancelled</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>

            <div class="w-full">
                <input v-model="search" type="text" class="w-full" placeholder="Application ID or Mobile or Email Address" @change="getApplications()">
            </div>
        </div>

        <div class="my-6 px-6 text-xl">
            <strong>{{ applications.length }}</strong> Applications Received
            <a :href="'/pdf/merit_list/'+academic_year_id+'/'+grade_id+'/'+ getStatus(status)" class="btn btn-purple float-right text-sm" target="_blank">Download Merit List</a>
        </div>

        <div v-for="app in applications" :key="app.id" class="box" :class="getStatus(app.status)">
            <div class="w-28">
                <a :href="'/admission_pool/applications/'+app.id" target="_blank">
                    <img :src="app.admission_photos[0].media" class="w-full">
                </a>
            </div>
            <div class="w-full">
                <p>Application ID: {{ app.id }}</p>
                <p>{{ app.first_name }} {{ app.middle_name }} {{ app.last_name }} - {{ app.gender }}</p>
                <p>Grade - {{ app.grade }} | Date of Birth - {{ dobs(app.dob) }}</p>
                <p>{{ app.phone }} - {{ app.email }}</p>
                <p v-if="app.status == 'Accepted'" >
                    <button v-if="app.student_id == null" @click="migrateToStudent(app.id)" class="btn btn-orange py-1 px-2">Migrate</button>
                    <span v-if="app.student_id != null" class="">Migrated to Student ID {{ app.student_id }}</span>
                </p>
            </div>
            <div>
                <span class="block mb-1">Rating: {{ app.total_rating }}</span>
                <select @change="updateStatus($event, app)" :value="app.status" class="">
                    <option value="Accepted">Accepted</option>
                    <option value="Rejected">Rejected</option>
                    <option value="Hold">Hold</option>
                    <option value="Cancelled">Cancelled</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Pending">Pending</option>
                </select>
                <span class="inline-block text-xl mt-2 text-gray-500">{{ app.payment_at == null ? 'Unpaid' : '&#9989; Paid' }}</span>
            </div>
        </div>

    </Administrator>

</template>