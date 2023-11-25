<script>
import Student from '@/Layouts/Student.vue';
import { Head, Link } from '@inertiajs/vue3';

export default {
    
    props: {
        application: Object,
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

    <Head title="Application" />

    <Student>

        <div class="box">
            <div class="w-full">

                <div class="mb-5 font-bold text-center text-xl">Application ID {{ application.id }}</div>

                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="border border-gray-400 p-1 w-48">Name</td>
                            <td class="border border-gray-400 p-1">{{ application.first_name }} {{ application.middle_name }} {{ application.last_name }}</td>
                            <td class="border border-gray-400 p-1 w-32" rowspan="4"><img class="w-full" :src="application.admission_photos[0].media"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-1 w-48">Contact</td>
                            <td class="border border-gray-400 p-1">{{ application.phone }}</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-1 w-48">Email Address</td>
                            <td class="border border-gray-400 p-1">{{ application.email }}</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-1 w-48">Address</td>
                            <td class="border border-gray-400 p-1">{{ application.admission_addresses[0].address }} {{ application.admission_addresses[0].city }} {{ application.admission_addresses[0].pincode }} {{ application.admission_addresses[0].state }} {{ application.admission_addresses[0].country }}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="w-full">
                    <tbody>
                        
                        <tr>
                            <td class="border border-gray-400 p-1 w-48">Branch</td>
                            <td class="border border-gray-400 p-1" colspan="3">Seeking Admission For - {{ application.branch.name }}</td>
                        </tr>

                        <tr>
                            <td class="border border-gray-400 p-1 w-48">Grade</td>
                            <td class="border border-gray-400 p-1">{{ application.grade.name }}</td>
                            <td class="border border-gray-400 p-1 w-48">Academic Year</td>
                            <td class="border border-gray-400 p-1">{{ application.academic_year.name }}</td>
                        </tr>

                        <tr>
                            <td class="border border-gray-400 p-1 w-48">Gender</td>
                            <td class="border border-gray-400 p-1">{{ application.gender }}</td>
                            <td class="border border-gray-400 p-1 w-48">First Language</td>
                            <td class="border border-gray-400 p-1">{{ application.first_language.language }}</td>
                        </tr>

                        <tr>
                            <td class="border border-gray-400 p-1 w-48">Second Language</td>
                            <td class="border border-gray-400 p-1">{{ application.second_language.language }}</td>
                            <td class="border border-gray-400 p-1 w-48">Third Language</td>
                            <td class="border border-gray-400 p-1">{{ application.third_language.language }}</td>
                        </tr>

                        <tr>
                            <td class="border border-gray-400 p-1 w-48">Date of Birth</td>
                            <td class="border border-gray-400 p-1">{{ application.dob }}</td>
                            <td class="border border-gray-400 p-1 w-48">Birth Place</td>
                            <td class="border border-gray-400 p-1">{{ application.birth_place }}</td>
                        </tr>

                        <tr>
                            <td class="border border-gray-400 p-1 w-48">Blood Group</td>
                            <td class="border border-gray-400 p-1">{{ application.blood_group }}</td>
                            <td class="border border-gray-400 p-1 w-48">Mother Tongue</td>
                            <td class="border border-gray-400 p-1">{{ application.mothertongue }}</td>
                        </tr>

                        <tr>
                            <td class="border border-gray-400 p-1 w-48">Nationality</td>
                            <td class="border border-gray-400 p-1">{{ application.nationality }}</td>
                            <td class="border border-gray-400 p-1 w-48">Aadhar Number</td>
                            <td class="border border-gray-400 p-1">{{ application.aadhar }}</td>
                        </tr>

                        <tr>
                            <td class="border border-gray-400 p-1 w-48">Religion</td>
                            <td class="border border-gray-400 p-1">{{ application.religion }}</td>
                            <td class="border border-gray-400 p-1 w-48">Cast Category</td>
                            <td class="border border-gray-400 p-1">{{ application.cast_category }}</td>
                        </tr>

                        <tr>
                            <td class="border border-gray-400 p-1 w-48">Cast</td>
                            <td class="border border-gray-400 p-1">{{ application.cast }}</td>
                            <td class="border border-gray-400 p-1 w-48">Sub-cast</td>
                            <td class="border border-gray-400 p-1">{{ application.subcast }}</td>
                        </tr>

                        <tr>
                            <td class="border border-gray-400 p-1" colspan="4">Has you child ever had trouble speaking or listning? - <strong>{{ application.speaking_hearing }}</strong></td>
                        </tr>

                        <tr>
                            <td class="border border-gray-400 p-1" colspan="4">Does your child have special education needs? - <strong>{{ application.special_need }}</strong></td>
                        </tr>

                        <tr>
                            <td class="border border-gray-400 p-1 w-48">Alumnus</td>
                            <td class="border border-gray-400 p-1">{{ application.is_alumnus }}</td>
                            <td class="border border-gray-400 p-1 w-48">Single Parent</td>
                            <td class="border border-gray-400 p-1">{{ application.is_single_parent }} {{ application.is_single_parent == 'Yes' ? ' - ' + application.single_what : '' }}</td>
                        </tr>

                        <template v-for="parent in application.admission_parents" :key="parent.id">
                            
                            <tr>
                                <td class="border border-gray-400 p-1 font-bold" colspan="4">{{ parent.relation }}'s Details</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 p-1 w-48">{{ parent.relation }}'s Name</td>
                                <td class="border border-gray-400 p-1"> {{ parent.first_name }} {{ parent.middle_name }} {{ parent.last_name }}</td>
                                <td class="border border-gray-400 p-1 w-48">Email</td>
                                <td class="border border-gray-400 p-1">{{ parent.email }}</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 p-1 w-48">Mobile</td>
                                <td class="border border-gray-400 p-1"> {{ parent.phone }}</td>
                                <td class="border border-gray-400 p-1 w-48">Date of Birth</td>
                                <td class="border border-gray-400 p-1">{{ parent.dob }}</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 p-1 w-48">Aadhar Number</td>
                                <td class="border border-gray-400 p-1"> {{ parent.aadhar }}</td>
                                <td class="border border-gray-400 p-1 w-48">PAN</td>
                                <td class="border border-gray-400 p-1">{{ parent.pan }}</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 p-1 w-48">Qualification</td>
                                <td class="border border-gray-400 p-1"> {{ parent.qualification }}</td>
                                <td class="border border-gray-400 p-1 w-48">Degree</td>
                                <td class="border border-gray-400 p-1">{{ parent.degree }}</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 p-1 w-48">Occupation</td>
                                <td class="border border-gray-400 p-1"> {{ parent.occupation }}</td>
                                <td class="border border-gray-400 p-1 w-48">Annual Income</td>
                                <td class="border border-gray-400 p-1">{{ parent.annual_income }}</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 p-1 w-48">Company Name</td>
                                <td class="border border-gray-400 p-1"> {{ parent.company_name }}</td>
                                <td class="border border-gray-400 p-1 w-48">Company Address</td>
                                <td class="border border-gray-400 p-1">{{ parent.company_address }}</td>
                            </tr>

                        </template>

                        <tr>
                            <td class="border border-gray-400 p-1" colspan="4">Name of previous school is <strong>{{ application.previous_school }}</strong> and board is <strong>{{ application.board }}</strong></td>
                        </tr>

                        <tr>
                            <td class="border border-gray-400 p-1" colspan="4">Siblings GR: <span v-for="sib in application.admission_siblings" :key="sib.id">{{ sib.gr_number }}</span></td>
                        </tr>
                        

                    </tbody>
                </table>

                <div class="mt-5 text-center">
                    <a class="btn btn-purple mr-2" :href="'/pdf/application/' + application.id" target="_blank">Download Form</a>
                    <a v-for="receipt in application.razorpay" :key="receipt.id" class="btn btn-purple mr-2" :href="'/pdf/receipt/' + receipt.id" target="_blank">Receipt {{ receipt.id }}</a>
                </div>

            </div>
        </div>

    </Student>

</template>