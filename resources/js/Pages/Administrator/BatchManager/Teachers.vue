<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link } from '@inertiajs/vue3';

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

    },

    data: function () {
        return {

            search: {
                academic_year_id: '',
                grade_id: '',
                batch_id: '',
            },

            staff: [],

        };
    },

    methods: {

        async getStaff(){

            let data = {
                _token: this.$page.props.csrf_token,
                academic_year_id: this.search.academic_year_id,
                grade_id: this.search.grade_id,
                batch_id: this.search.batch_id,
            };

            const options = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(data)
            };

            this.staff = await fetch('/batch_manager/fetch_teachers', options)
            .then(res => res.json());

        },

    },

    mounted: function() {
    },

    components: { Administrator, Head, Link },
}
</script>

<template>
<Head title="Teachers" />
<Administrator>

    <!-- Filter -->
    <div class="box space-x-3">
        <div class="w-full">
            <select @change="getStaff()" class="w-full" v-model="search.academic_year_id">
                <option value="">Select Academic Year</option>
                <option v-for="ay in academic_years" :key="ay.id" :value="ay.id">{{ ay.name }}</option>
            </select>
        </div>
        <!-- <div class="w-full">
            <select @change="getStaff()" class="w-full" v-model="search.grade_id">
                <option value="">All Grades</option>
                <option v-for="gr in grades" :key="gr.id" :value="gr.id">{{ gr.name }}</option>
            </select>
        </div>
        <div class="w-full">
            <select @change="getStaff()" class="w-full" v-model="search.batch_id">
                <option value="">All Batches</option>
                <option v-for="ba in batchSelect" :key="ba.id" :value="ba.id">{{ ba.grade.name }} - {{ ba.division.name }}</option>
            </select>
        </div> -->
    </div>

    <div v-for="st in staff" :key="st.id" class="box">

        <div class="w-full">

            <div class="mb-3 flex flex-row">
                <div class="w-full font-bold">{{ st.full_name }} </div>
                <div class="w-full text-right">{{ st.total }}</div>
            </div>

            <div class="w-full">

                <div v-for="bt in st.batch_teachers" :key="bt.id" class="odd:bg-white even:bg-gray-200 p-2">
                    {{ bt.grade }} - {{ bt.div }} : {{ bt.subject }}
                    <span class="float-right">{{ bt.lectures_per_week }}</span>
                </div>

            </div>
            

        </div>
        

        <!-- <div>{{ st }}</div> -->
    </div>

</Administrator>
</template>
