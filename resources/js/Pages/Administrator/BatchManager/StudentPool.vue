<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link } from '@inertiajs/vue3';

export default {
    
    props: {
        errors: Object,
        academic_years: Object,
        grades: Object,
        houses: Object,
        first_languages: Object,
        second_languages: Object,
        third_languages: Object,
    },

    data: function () {
        return {

            search: {
                academic_year_id: '',
                grade_id: '',
                batch_id: '',
            },

            students: [],

            dragged_student: null,

        };
    },

    methods: {

        /* New Drag and Drop Functions */
        onDragStart(student){
            this.dragged_student = student;
        },

        onDrop(batch){
            if(this.dragged_student != null){

                let formData = {
                    dropped_batch_id: batch,
                    dragged_batch_id: this.dragged_student.batch_id,
                    batch_student_id: this.dragged_student.bsid,
                    student_id: this.dragged_student.id
                };
                if(formData.dragged_batch_id != formData.dropped_batch_id){
                    this.allocate(formData)
                }

            }
        },

        onDO(e){
            e.preventDefault();
        },

        async allocate(formData){
            
            let data = {
                _token: this.$page.props.csrf_token,
            };

            let newFormData = Object.assign(data, formData);

            const options = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(newFormData)
            };

            let ss = await fetch('/batch_manager/allocate_student', options)
            .then(res => {
                res.json();
                this.getStudents();
            });

        },

        getBatchStudents(batch_id){
            let students = [];
            this.students.forEach(stu => {
                if(stu.batch_id == batch_id){
                    students.push(stu);
                }
            });
            return students;
        },

        async getStudents(){
            if(this.search.academic_year_id != '' && this.search.grade_id != ''){
                let data = {
                    _token: this.$page.props.csrf_token,
                };

                let fd = Object.assign(data, this.search);

                const options = {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(fd)
                };

                let ss = await fetch('/batch_manager/students', options)
                .then(res => res.json());

                this.students = ss;
            }
        },

        getLength(arr, key, val){
            return arr.filter(elm => elm[key] == val).length;
        },

        getLengthMF(arr, key, val){
            let c = {
                total: 0,
                male: 0,
                female: 0
            };
            c.total = arr.filter(elm => elm[key] == val).length;
            c.male = arr.filter(elm => (elm[key] == val && elm.gender == 'Male')).length;
            c.female = arr.filter(elm => (elm[key] == val & elm.gender == 'Female')).length;
            return c;
        },
    },

    created: function() {
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
                            }
                        });
                    }
                });
            }
            return batches;
        },

    },

    components: { Administrator, Head, Link }
}
</script>

<template>

    <Head title="Student Pool" />

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
                    <option value="">Select Grade</option>
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

        <!-- Workarea -->
        <div class="flex flex-wrap">
            
            <!-- Batches and its students -->
            <div class="w-1/2">
                <div v-for="batch in batches" :key="batch.id" class="box" @drop="onDrop(batch.id)" @dragover="onDO($event)">

                    <div class="w-full">

                        <h2 class="mb-5 uppercase font-bold">{{ batch.grade.name }} - {{ batch.division.name }}</h2>

                        <div class="w-full mb-5">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th class="border border-gray-400 p-1 text-left"></th>
                                        <th class="border border-gray-400 p-1 w-20">Male</th>
                                        <th class="border border-gray-400 p-1 w-20">Female</th>
                                        <th class="border border-gray-400 p-1 w-20">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-400 p-1 text-sm text-left">Students</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ getLength(getBatchStudents(batch.id), 'gender', 'Male') }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ getLength(getBatchStudents(batch.id), 'gender', 'Female') }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ getBatchStudents(batch.id).length }}</td>
                                    </tr>
                                    <tr v-for="house in houses" :key="house.id" :data-set ="a = getLengthMF(getBatchStudents(batch.id),'house',house.name)" :style="'background-color: '+house.bg+';color:'+house.txt+';'">
                                        <td class="border border-gray-400 p-1 text-sm text-left">{{ house.name }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.male }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.female }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.total }}</td>
                                    </tr>
                                    <tr v-for="fl in first_languages" :key="fl.id" :data-set ="a = getLengthMF(getBatchStudents(batch.id),'first_language',fl.language)">
                                        <td class="border border-gray-400 p-1 text-sm text-left">FL - {{ fl.language }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.male }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.female }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.total }}</td>
                                    </tr>
                                    <tr v-for="sl in second_languages" :key="sl.id" :data-set ="a = getLengthMF(getBatchStudents(batch.id),'second_language',sl.language)">
                                        <td class="border border-gray-400 p-1 text-sm text-left">SL - {{ sl.language }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.male }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.female }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.total }}</td>
                                    </tr>
                                    <tr v-for="tl in third_languages" :key="tl.id" :data-set ="a = getLengthMF(getBatchStudents(batch.id),'third_language',tl.language)">
                                        <td class="border border-gray-400 p-1 text-sm text-left">TL - {{ tl.language }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.male }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.female }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.total }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div v-for="stu in getBatchStudents(batch.id)" :key="stu.id" class="w-full mb-3" draggable="true" @dragstart="onDragStart(stu)">
                            <div class="w-full border border-gray-400">
                                <span class="inline-block py-1 px-2 bg-gray-600 text-white">{{ stu.gender[0] }} </span>
                                <span class="inline-block py-1 px-2">{{ stu.full_name }}</span>
                                <span class="inline-block py-1 px-2 float-right" :style="'background-color:' + stu.bg + '; color:' + stu.txt + ';'">{{ stu.house[0] }}</span>
                            </div>
                            <div class="w-full flex flex-row">
                                <div class="w-1/3 border border-gray-400 text-center text-sm">{{ stu.first_language }}</div>
                                <div class="w-1/3 border border-gray-400 text-center text-sm">{{ stu.second_language }}</div>
                                <div class="w-1/3 border border-gray-400 text-center text-sm">{{ stu.third_language }}</div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Students without batch allocation -->
            <div class="w-1/2 pl-5 h-[75vh] overflow-auto scrollbar-thin">
                <div class="box" @drop="onDrop(null)" @dragover="onDO($event)">

                    <div class="w-full">

                        <h2 class="mb-5 uppercase font-bold">Unallocated Students</h2>

                        <div class="w-full mb-5">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th class="border border-gray-400 p-1 text-left"></th>
                                        <th class="border border-gray-400 p-1 w-20">Male</th>
                                        <th class="border border-gray-400 p-1 w-20">Female</th>
                                        <th class="border border-gray-400 p-1 w-20">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-400 p-1 text-sm text-left">Students</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ getLength(getBatchStudents(null), 'gender', 'Male') }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ getLength(getBatchStudents(null), 'gender', 'Female') }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ getBatchStudents(null).length }}</td>
                                    </tr>
                                    <tr v-for="house in houses" :key="house.id" :data-set ="a = getLengthMF(getBatchStudents(null),'house',house.name)" :style="'background-color: '+house.bg+';color:'+house.txt+';'">
                                        <td class="border border-gray-400 p-1 text-sm text-left">{{ house.name }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.male }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.female }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.total }}</td>
                                    </tr>
                                    <tr v-for="fl in first_languages" :key="fl.id" :data-set ="a = getLengthMF(getBatchStudents(null),'first_language',fl.language)">
                                        <td class="border border-gray-400 p-1 text-sm text-left">FL - {{ fl.language }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.male }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.female }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.total }}</td>
                                    </tr>
                                    <tr v-for="sl in second_languages" :key="sl.id" :data-set ="a = getLengthMF(getBatchStudents(null),'second_language',sl.language)">
                                        <td class="border border-gray-400 p-1 text-sm text-left">SL - {{ sl.language }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.male }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.female }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.total }}</td>
                                    </tr>
                                    <tr v-for="tl in third_languages" :key="tl.id" :data-set ="a = getLengthMF(getBatchStudents(null),'third_language',tl.language)">
                                        <td class="border border-gray-400 p-1 text-sm text-left">TL - {{ tl.language }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.male }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.female }}</td>
                                        <td class="border border-gray-400 p-1 text-sm w-20 text-center">{{ a.total }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div v-for="stu in getBatchStudents(null)" :key="stu.id" class="w-full mb-3" draggable="true" @dragstart="onDragStart(stu)">
                            <div class="w-full border border-gray-400">
                                <span class="inline-block py-1 px-2 bg-gray-600 text-white">{{ stu.gender[0] }} </span>
                                <span class="inline-block py-1 px-2">{{ stu.full_name }}</span>
                                <span class="inline-block py-1 px-2 float-right" :style="'background-color:' + stu.bg + '; color:' + stu.txt + ';'">{{ stu.house[0] }}</span>
                            </div>
                            <div class="w-full flex flex-row">
                                <div class="w-1/3 border border-gray-400 text-center text-sm">{{ stu.first_language }}</div>
                                <div class="w-1/3 border border-gray-400 text-center text-sm">{{ stu.second_language }}</div>
                                <div class="w-1/3 border border-gray-400 text-center text-sm">{{ stu.third_language }}</div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </Administrator>

</template>