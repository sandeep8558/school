<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link } from '@inertiajs/vue3';

import Calendar from '@/Components/Calendar.vue';

export default {
    
    props: {
        academic_years: Object,
    },

    data: function () {
        return {
            weekoffs: [],
            halfdays: [],
            holidays: [],
        };
    },

    methods: {

        getHolidays(academic_year_id, grade_id){
            fetch('/academic_year/fetch/holiday/'+academic_year_id+'/'+grade_id)
            .then(data => data.json())
            .then(res => {
                this.holidays = res;
            });
        },

        getHalfdays(academic_year_id, grade_id){
            fetch('/academic_year/fetch/halfday/'+academic_year_id+'/'+grade_id)
            .then(data => data.json())
            .then(res => {
                this.halfdays = res;
            });
        },

        getWeekoffs(academic_year_id, grade_id){
            fetch('/academic_year/fetch/weekoff/'+academic_year_id+'/'+grade_id)
            .then(data => data.json())
            .then(res => {
                this.weekoffs = res;
            });
        },

        optionsChanged(e){
            this.e = e;
            this.getHolidays(e.academic_year_id, e.grade_id);
            this.getHalfdays(e.academic_year_id, e.grade_id);
            this.getWeekoffs(e.academic_year_id, e.grade_id);
        },

    },

    mounted: function() {
    },

    components: { Administrator, Head, Link, Calendar, Calendar }
}
</script>

<template>

    <Head title="Calendar" />

    <Administrator>

        <div>

            <Calendar @onOptionsChange="optionsChanged($event)" :weekoffs="weekoffs" :holidays="holidays" :halfdays="halfdays"></Calendar>

        </div>

    </Administrator>

</template>
