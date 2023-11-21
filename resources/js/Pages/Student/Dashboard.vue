<script>
import Student from '@/Layouts/Student.vue';
import { Head, Link } from '@inertiajs/vue3';

import Razorpay from '@/Components/Razorpay.vue';

export default {
    
    props: {
        isAdmission: String,
    },

    data: function () {
        return {
        };
    },

    methods: {
        payment(e){
            console.log(e);
        },
    },

    created: function() {
    },

    components: { Student, Head, Link, Razorpay }
}
</script>

<template>
    <Head title="Dashboard" />

    <Student>

        <div v-if="isAdmission == 'Yes'" class="box">
            <div>
                <p class="w-full mb-3 text-lg">Admissions are open! please visit the link below for admission and more details.</p>
                <Link class="btn btn-purple" href="/admission">
                    Go to Admission
                </Link>
            </div>
            
        </div>

        <div v-if="isAdmission == 'No'" class="box">
            Admissions are closed!
        </div>

    </Student>
</template>