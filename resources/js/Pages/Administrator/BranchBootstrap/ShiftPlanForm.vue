<script>
import { useForm } from '@inertiajs/vue3';
import Text from '@/Components/Form/Text.vue';
import Time from '@/Components/Form/Time.vue';
import Select from '@/Components/Form/Select.vue';

export default {

    components: {
        Text,
        Time,
        Select,
    },

    props: {
        student_shift: Object,
        plan: Object,
    },

    computed: {
        isValid(){
            let is = false;
            if(this.planForm.student_shift_id == '' || this.planForm.period_index == '' || this.planForm.from == '' || this.planForm.to == '' || this.planForm.slot == '' || this.planForm.is_in_halfday == ''){
                is = true;
            }
            return is;
        },
    },

    data: function () {
        return {

            planForm: {
                id: '',
                student_shift_id: '',
                period_index: '',
                from: '',
                to: '',
                slot: '',
                is_in_halfday: '',
            },

            slots: [
                { key:'Lecture', val: 'Lecture' },
                { key:'Short Break', val: 'Short Break' },
                { key:'Long Break', val: 'Long Break' },
                { key:'Interaction', val: 'Interaction' },
                { key:'Prayer', val: 'Prayer' },
                { key:'Assembly', val: 'Assembly' },
            ],

            yesNo: [
                { key:'Yes', val: 'Yes' },
                { key:'No', val: 'No' },
            ],

        };
    },

    methods: {
    },

    created: function() {
        if(this.student_shift != undefined && this.student_shift != null && this.student_shift != ''){
            this.planForm.student_shift_id = this.student_shift.id;
        }
        
        if(this.plan != undefined && this.plan != null && this.plan != ''){
            this.planForm.id = this.plan.id;
            this.planForm.student_shift_id = this.plan.student_shift_id;
            this.planForm.period_index = this.plan.period_index;
            this.planForm.from = this.plan.from;
            this.planForm.to = this.plan.to;
            this.planForm.slot = this.plan.slot;
            this.planForm.is_in_halfday = this.plan.is_in_halfday;
        }
    },

}
</script>

<template>

<div class="bg-white p-6 md:w-96 rounded-lg shadow-lg border">

    <div class="mb-6">
        <h2 class="text-xl font-bold inline-block">Create Shift Plan</h2>
        <button class="float-right hover:underline" @click="$emit('close', true)">Close</button>
    </div>

    <div class="mb-5">
        <Text label="Period Index" v-model="planForm.period_index"></Text>
    </div>

    <div class="mb-5">
        <Time label="From" v-model="planForm.from"></Time>
    </div>

    <div class="mb-5">
        <Time label="To" v-model="planForm.to"></Time>
    </div>

    <div class="mb-5">
        <Select label="Slot" v-model="planForm.slot" :options="slots"></Select>
    </div>

    <div class="mb-5">
        <Select label="Is in halfday" v-model="planForm.is_in_halfday" :options="yesNo"></Select>
    </div>

    <div class="">
        <button :disabled="isValid" :class="isValid ? 'btn-disbled' : 'btn-purple'" class="btn" @click="$emit('save', planForm)">Save Batch</button>
    </div>

</div>

</template>