<script>
import { useForm } from '@inertiajs/vue3';

export default {
    
    props: {
        title: String,
        subject: Object,
        teacher: Object,
    },

    data: function () {
        return {
            role: '',
            staff_id: '',
            assistant_id: '',
        };
    },

    methods: {
        setAssistant(){
            this.assistant_id = this.staff_id;
        }
    },

    created: function() {
        if(this.teacher != null){
            this.role = this.teacher.role;
            this.staff_id = this.teacher.staff_id;
            this.assistant_id = this.teacher.assistant_id;
        }
    },

    mounted: function() {
    },

    components: {},

    computed: {
        isValid(){
            return this.role == '' || this.staff_id == '' ? true : false;
        },
    },
}
</script>

<template>
    <div class="bg-white p-6 md:w-96 rounded-lg shadow-lg border">

        <div>
            <h2 class="text-xl font-bold inline-block">{{ title }}</h2>
            <button class="float-right hover:underline" @click="$emit('close', true)">Close</button>
        </div>

        <hr class="my-5">

        <div class="mb-5">
            <label for="staff_id" class="block mb-2">Assign Teacher for {{ subject.subject.name }}</label>
            <select @change="setAssistant()" name="staff_id" id="staff_id" class="w-full" v-model="staff_id">
                <option value="">Select Staff</option>
                <option v-for="staff in subject.subject.subject_teachers" :key="staff" :value="staff.staff.id">{{ staff.staff.full_name }} - {{ staff.staff.degree }}</option>
            </select>
        </div>

        <div class="mb-5">
            <label for="assistant_id" class="block mb-2">Assign Teacher for {{ subject.subject.name }}</label>
            <select name="assistant_id" id="assistant_id" class="w-full" v-model="assistant_id">
                <option value="">Select Assistant</option>
                <option v-for="staff in subject.subject.subject_teachers" :key="staff" :value="staff.staff.id">{{ staff.staff.full_name }} - {{ staff.staff.degree }}</option>
            </select>
        </div>

        <div class="mb-5">
            <label for="role" class="block mb-2">Teacher Role</label>
            <select name="role" id="role" class="w-full" v-model="role">
                <option value="">Select Role</option>
                <option value="Class teacher">Class teacher</option>
                <option value="Co-class teacher">Co-class teacher</option>
                <option value="Subject teacher">Subject teacher</option>
            </select>
        </div>

        <div class="">
            <button :disabled="isValid" :class="isValid ? 'btn-disbled' : 'btn-purple'" class="btn" @click="$emit('save', {role: role, staff_id: staff_id, assistant_id: assistant_id})">Save Batch</button>
        </div>
        
    </div>
</template>