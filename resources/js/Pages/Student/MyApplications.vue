<script>
import Student from '@/Layouts/Student.vue';
import { Head, Link } from '@inertiajs/vue3';

export default {
    
    props: {
        my_applications: Object,
    },

    data: function () {
        return {
        };
    },

    methods: {
    },

    mounted: function() {
    },

    components: { Student, Head, Link }
}
</script>

<template>
    <Head title="Dashboard" />

    <Student>

        <div class="box">
            My Application
        </div>

        <div v-for="app in my_applications" :key="app.id" class="box">

            <div class="w-40">
                <img class="w-full" :src="app.admission_photos[0].media">
            </div>

            <div class="w-full">
                <h3>{{ app.first_name }} {{ app.middle_name }} {{ app.last_name }}</h3>
                <p>{{ app.gender }}</p>
                <p>{{ app.phone }}</p>
            </div>

            <!-- {{ app }} -->
            
        </div>

    </Student>
</template>