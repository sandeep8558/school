<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {
    
    props: {
        errors: Object,
        houses: Object,
        students: Object,
        grades: Object,
        grade_id: String,
        house_id: String,
        gender: String,
        non: Object,
    },

    data: function () {
        return {
            frm: {
                house_id : this.house_id,
                grade_id : this.grade_id,
                gender : this.gender,
            },
        };
    },

    methods: {
        openWith(){
            this.$refs.myForm.submit();
        },
        setHouse(e, sid){
            let url = '/student_manager/student_house_update';
            let data = {
                id: sid,
                house_id: e.target.value
            };
            let frm = new useForm(data);
            frm.post(url);
        },
    },

    mounted: function() {
    },

    components: { Administrator, Head, Link }
}
</script>

<template>
<Head title="Student Houses" />
<Administrator>

    <form class="box" action="/student_manager/student_houses" method="get" ref="myForm">

        <div class="w-1/3">
            <select class="w-full" name="house_id" id="house_id" @change="openWith()" v-model="frm.house_id">
                <option value="All">All</option>
                <option value="Uncategorized">Uncategorized</option>
                <option v-for="house in houses" :key="house.id" :value="house.id">{{ house.name }}</option>
            </select>
        </div>

        <div class="w-1/3">
            <select class="w-full" name="gender" id="gender" @change="openWith()" v-model="frm.gender">
                <option value="All">All</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="w-1/3">
            <select class="w-full" name="grade_id" id="grade_id" @change="openWith()" v-model="frm.grade_id">
                <option value="All">All</option>
                <option v-for="grade in grades" :key="grade.id" :value="grade.id">{{ grade.name }}</option>
            </select>
        </div>

    </form>

    <div class="box">
        <div class="w-full">

            <table class="w-full">
                <thead>
                    <tr class="bg-gray-400 text-white">
                        <th class="p-2 text-left">House Name</th>
                        <th class="p-2 w-40">Male</th>
                        <th class="p-2 w-40">Female</th>
                        <th class="p-2 w-40">Total</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr v-for="house in houses" :key="house.id" class="odd:bg-white">
                        <td class="p-2">{{ house.name }}</td>
                        <td class="p-2 text-center">{{ house.counts.male }}</td>
                        <td class="p-2 text-center">{{ house.counts.female }}</td>
                        <td class="p-2 text-center">{{ house.counts.total }}</td>
                    </tr>

                    <tr class="odd:bg-white">
                        <td class="p-2">Uncategorized</td>
                        <td class="p-2 text-center">{{ non.male }}</td>
                        <td class="p-2 text-center">{{ non.female }}</td>
                        <td class="p-2 text-center">{{ non.total }}</td>
                    </tr>

                </tbody>
            </table>

        </div>
    </div>

    <div class="box">
        <div class="w-full">

            <table class="w-full">

                <thead>
                    <tr>
                        <th class="border border-gray-400 px-2 py-3">ID</th>
                        <th class="border border-gray-400 px-2 py-3">GRN</th>
                        <th class="border border-gray-400 px-2 py-3 text-left">Name</th>
                        <th class="border border-gray-400 px-2 py-3">House</th>
                        <th class="border border-gray-400 px-2 py-3">Grade</th>
                        <th class="border border-gray-400 px-2 py-3">Gender</th>
                        <th class="border border-gray-400 px-2 py-3">DOB</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="student in students" :key="student.id">
                        <td class="border border-gray-400 p-2 text-center w-24">{{ student.id }}</td>
                        <td class="border border-gray-400 p-2 text-center w-24">{{ student.gr_number }}</td>
                        <td class="border border-gray-400 p-2">{{ student.first_name }} {{ student.middle_name }} {{ student.last_name }}</td>
                        <td class="border border-gray-400 p-2 text-center w-32">
                            <select name="hid" id="hid" class="border-none bg-transparent bg-none pr-3 text-center" v-model="student.house_id" @change="setHouse($event, student.id)">
                                <option :value="null">Uncategorized</option>
                                <option v-for="house in houses" :key="house.id" :value="house.id">{{ house.name }}</option>
                            </select>
                        </td>
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