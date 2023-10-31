<script>
import { useForm } from '@inertiajs/vue3';

export default {
    
    props: {
        classrooms: Object,
        student_shifts: Object,
        title: String,
        ssid: Number,
        cid: Number,
    },

    data: function () {
        return {
            classroom_id: '',
            student_shift_id: '',
        };
    },

    methods: {
    },

    mounted: function() {
        this.classroom_id = this.cid;
        this.student_shift_id = this.ssid;
    },

    components: {},

    computed: {
        isValid(){
            return this.classroom_id == '' || this.student_shift_id == '' ? true : false;
        },
    },
}
</script>


<template>
    <div class="bg-white p-6 md:w-96 rounded-lg shadow-lg border">

        <div>
            <h2 class="text-xl font-bold inline-block">Update {{ title }}</h2>
            <button class="float-right hover:underline" @click="$emit('close', true)">Close</button>
        </div>

        <hr class="my-5">

        <div class="mb-5">
            <label for="classroom_id" class="block mb-2">Classroom</label>
            <select name="classroom_id" id="classroom_id" class="w-full" v-model="classroom_id">
                <option v-for="classroom in classrooms" :key="classroom.id" :value="classroom.id">{{ classroom.name }} - {{ classroom.capacity }}</option>
            </select>
        </div>

        <div class="mb-5">
            <label for="student_shift_id" class="block mb-2">Student Shift</label>
            <select name="student_shift_id" id="student_shift_id" class="w-full" v-model="student_shift_id">
                <option v-for="shift in student_shifts" :key="shift.id" :value="shift.id">{{ shift.name }} {{ shift.from }} - {{ shift.to }}</option>
            </select>
        </div>

        <div class="">
            <button :disabled="isValid" :class="isValid ? 'btn-disbled' : 'btn-purple'" class="btn" @click="$emit('save', {classroom_id: classroom_id, student_shift_id: student_shift_id})">Update Batch</button>
        </div>

    </div>
</template>