<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {
    
    props: {
        errors: Object,
        academic_years: Object,
        grades: Object,
        rating_names: Object,
    },

    data: function () {
        return {
            grade_id: 'All',
            academic_year_id: null,
            search: '',
            applications: [],
            focus_value : 0,
        };
    },

    methods: {

        async getApplications(){
            let applications = [];
            if(this.academic_year_id != null){
                await fetch('/admission_pool/fetch_applications/' + this.academic_year_id + '?search=' + this.search + '&grade_id=' + this.grade_id).then(res => {
                    applications = res.json();
                });
            }
            this.applications = await applications;
        },

        getTotalRating(obj){
            return Number(obj.rating_1) + Number(obj.rating_2 )+ Number(obj.rating_3 )+ Number(obj.rating_4 )+ Number(obj.rating_5 )+ Number(obj.rating_6 )+ Number(obj.rating_7 )+ Number(obj.rating_8 )+ Number(obj.rating_9 )+ Number(obj.rating_10) + Number(obj.rating_11) + Number(obj.rating_12);
        },

        updateApplications(id, col, val){
            this.applications.forEach(app => {
                if(app.id == id){
                    app[col] = val;
                    app.rating_total = this.getTotalRating(app);
                }
            });
        },

        getSetting(col){
            let name = 'Rating';
            this.rating_names.forEach(setting => {
                if(setting.key == col){
                    name = setting.val;
                }
            });
            return name;
        },

        isCol(n){
            let is = this.getSetting('Rating ' + n) == '0' ? false : true;
            return is;
        },

        updateRating(e, id, col, obj){
            if(this.focus_value != e.target.value){

                this.updateApplications(id, col, e.target.value);

                let data = {
                    _token: this.$page.props.csrf_token,
                    id: id,
                };
                data[col] = e.target.value;
                data['total_rating'] = this.getTotalRating(obj)

                const options = {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(data)
                };

                fetch('/admission_pool/update_admission', options)
                .then(res => {
                    let a = res.json();
                });
            }
        },

        setFocusValue(rating){
            this.focus_value = rating;
        }

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

    <Head title="Rating" />

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

<div class="">

    <div class="w-full">

        <table class="w-full">
    
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3 whitespace-nowrap">Rating</th>
                    <th class="p-3 whitespace-nowrap text-left">Student</th>
                    <th v-if="isCol(1)" class="p-3 whitespace-nowrap">{{ getSetting('Rating 1') }}</th>
                    <th v-if="isCol(2)" class="p-3 whitespace-nowrap">{{ getSetting('Rating 2') }}</th>
                    <th v-if="isCol(3)" class="p-3 whitespace-nowrap">{{ getSetting('Rating 3') }}</th>
                    <th v-if="isCol(4)" class="p-3 whitespace-nowrap">{{ getSetting('Rating 4') }}</th>
                    <th v-if="isCol(5)" class="p-3 whitespace-nowrap">{{ getSetting('Rating 5') }}</th>
                    <th v-if="isCol(6)" class="p-3 whitespace-nowrap">{{ getSetting('Rating 6') }}</th>
                    <th v-if="isCol(7)" class="p-3 whitespace-nowrap">{{ getSetting('Rating 7') }}</th>
                    <th v-if="isCol(8)" class="p-3 whitespace-nowrap">{{ getSetting('Rating 8') }}</th>
                    <th v-if="isCol(9)" class="p-3 whitespace-nowrap">{{ getSetting('Rating 9') }}</th>
                    <th v-if="isCol(10)" class="p-3 whitespace-nowrap">{{ getSetting('Rating 10') }}</th>
                    <th v-if="isCol(11)" class="p-3 whitespace-nowrap">{{ getSetting('Rating 11') }}</th>
                    <th v-if="isCol(12)" class="p-3 whitespace-nowrap">{{ getSetting('Rating 12') }}</th>
                    
                </tr>
            </thead>

            <tbody>

                <tr v-for="app in applications" :key="app.id" class="even:bg-gray-200">
                    <td class="border p-2 w-20 text-center">{{ app.id }}</td>
                    <td class="border p-2 w-20 text-center">{{ getTotalRating(app) }}</td>
                    <td class="border p-2 whitespace-nowrap">
                        <a :href="'/admission_pool/applications/'+app.id" target="_blank">
                            {{ app.first_name }} {{ app.middle_name }} {{ app.last_name }}
                        </a>
                    </td>
                    <td v-if="isCol(1)" class="border p-2 w-16"><input type="text" :value="app.rating_1" @focus="setFocusValue(app.rating_1)" @change="updateRating($event,app.id, 'rating_1', app)" class="w-full text-center bg-transparent border-none p-1"></td>
                    <td v-if="isCol(2)" class="border p-2 w-16"><input type="text" :value="app.rating_2" @focus="setFocusValue(app.rating_2)" @change="updateRating($event,app.id, 'rating_2', app)" class="w-full text-center bg-transparent border-none p-1"></td>
                    <td v-if="isCol(3)" class="border p-2 w-16"><input type="text" :value="app.rating_3" @focus="setFocusValue(app.rating_3)" @change="updateRating($event,app.id, 'rating_3', app)" class="w-full text-center bg-transparent border-none p-1"></td>
                    <td v-if="isCol(4)" class="border p-2 w-16"><input type="text" :value="app.rating_4" @focus="setFocusValue(app.rating_4)" @change="updateRating($event,app.id, 'rating_4', app)" class="w-full text-center bg-transparent border-none p-1"></td>
                    <td v-if="isCol(5)" class="border p-2 w-16"><input type="text" :value="app.rating_5" @focus="setFocusValue(app.rating_5)" @change="updateRating($event,app.id, 'rating_5', app)" class="w-full text-center bg-transparent border-none p-1"></td>
                    <td v-if="isCol(6)" class="border p-2 w-16"><input type="text" :value="app.rating_6" @focus="setFocusValue(app.rating_6)" @change="updateRating($event,app.id, 'rating_6', app)" class="w-full text-center bg-transparent border-none p-1"></td>
                    <td v-if="isCol(7)" class="border p-2 w-16"><input type="text" :value="app.rating_7" @focus="setFocusValue(app.rating_7)" @change="updateRating($event,app.id, 'rating_7', app)" class="w-full text-center bg-transparent border-none p-1"></td>
                    <td v-if="isCol(8)" class="border p-2 w-16"><input type="text" :value="app.rating_8" @focus="setFocusValue(app.rating_8)" @change="updateRating($event,app.id, 'rating_8', app)" class="w-full text-center bg-transparent border-none p-1"></td>
                    <td v-if="isCol(9)" class="border p-2 w-16"><input type="text" :value="app.rating_9" @focus="setFocusValue(app.rating_9)" @change="updateRating($event,app.id, 'rating_9', app)" class="w-full text-center bg-transparent border-none p-1"></td>
                    <td v-if="isCol(10)" class="border p-2 w-16"><input type="text" :value="app.rating_10" @focus="setFocusValue(app.rating_10)" @change="updateRating($event, app.id, 'rating_10', app)" class="w-full text-center bg-transparent border-none p-1"></td>
                    <td v-if="isCol(11)" class="border p-2 w-16"><input type="text" :value="app.rating_11" @focus="setFocusValue(app.rating_11)" @change="updateRating($event, app.id, 'rating_11', app)" class="w-full text-center bg-transparent border-none p-1"></td>
                    <td v-if="isCol(12)" class="border p-2 w-16"><input type="text" :value="app.rating_12" @focus="setFocusValue(app.rating_12)" @change="updateRating($event, app.id, 'rating_12', app)" class="w-full text-center bg-transparent border-none p-1"></td>
                    
                </tr>

            </tbody>

        </table>

    </div>

</div>


</Administrator>

</template>