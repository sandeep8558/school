<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {
    
    props: {
        errors: Object,
        admission: Object,
        rating_names: Object,
    },

    data: function () {
        return {
            rating: {
                rating_1: 0,
                rating_2: 0,
                rating_3: 0,
                rating_4: 0,
                rating_5: 0,
                rating_6: 0,
                rating_7: 0,
                rating_8: 0,
                rating_9: 0,
                rating_10: 0,
                rating_11: 0,
                rating_12: 0,
            },
        };
    },

    methods: {
        init(){
            this.rating.rating_1 = this.admission.rating_1;
            this.rating.rating_2 = this.admission.rating_2;
            this.rating.rating_3 = this.admission.rating_3;
            this.rating.rating_4 = this.admission.rating_4;
            this.rating.rating_5 = this.admission.rating_5;
            this.rating.rating_6 = this.admission.rating_6;
            this.rating.rating_7 = this.admission.rating_7;
            this.rating.rating_8 = this.admission.rating_8;
            this.rating.rating_9 = this.admission.rating_9;
            this.rating.rating_10 = this.admission.rating_10;
            this.rating.rating_11 = this.admission.rating_11;
            this.rating.rating_12 = this.admission.rating_12;
        },
        getSetting(col){
            let name = 'Rating';
            this.rating_names.forEach(setting => {
                if(setting.key == col){
                    name = setting.val;
                }
            });
            return name;
        },
        updateRating(){
            let data = this.rating;
            data.total_rating = this.total_rating;
            data.id = this.admission.id;
            let frm = useForm(data);
            frm.post('/admission_pool/update_ratings');
        },
    },

    computed: {
        total_rating(){
            return Number(this.rating.rating_1) + Number(this.rating.rating_2) + Number(this.rating.rating_3) + Number(this.rating.rating_4) + Number(this.rating.rating_5) + Number(this.rating.rating_6) + Number(this.rating.rating_7) + Number(this.rating.rating_8) + Number(this.rating.rating_9) + Number(this.rating.rating_10) + Number(this.rating.rating_11) + Number(this.rating.rating_12);
        }
    },

    created: function() {
        this.init();
    },

    components: { Administrator, Head, Link }
}
</script>

<template>

    <Head title="Admission" />

    <Administrator>

        <div class="items-start">

            

            <div class="box w-full">

                <div class="flex flex-wrap box-border w-full">

                    <h2 class="w-full mb-5 text-xl font-bold uppercase">Profile Rating - {{ total_rating }}</h2>

                    <div v-if="getSetting('Rating 1') != '0'" class="text-gray-200 text-center px-1 py-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
                        <label for="" class="block py-2 bg-gray-600">{{getSetting('Rating 1')}}</label>
                        <input type="text" name="" id="" class="w-full text-center text-black" @change="updateRating()" v-model="rating.rating_1">
                    </div>

                    <div v-if="getSetting('Rating 2') != '0'" class="text-gray-200 text-center px-1 py-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
                        <label for="" class="block py-2 bg-gray-600">{{getSetting('Rating 2')}}</label>
                        <input type="text" name="" id="" class="w-full text-center text-black" @change="updateRating()" v-model="rating.rating_2">
                    </div>

                    <div v-if="getSetting('Rating 3') != '0'" class="text-gray-200 text-center px-1 py-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
                        <label for="" class="block py-2 bg-gray-600">{{getSetting('Rating 3')}}</label>
                        <input type="text" name="" id="" class="w-full text-center text-black" @change="updateRating()" v-model="rating.rating_3">
                    </div>

                    <div v-if="getSetting('Rating 4') != '0'" class="text-gray-200 text-center px-1 py-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
                        <label for="" class="block py-2 bg-gray-600">{{getSetting('Rating 4')}}</label>
                        <input type="text" name="" id="" class="w-full text-center text-black" @change="updateRating()" v-model="rating.rating_4">
                    </div>

                    <div v-if="getSetting('Rating 5') != '0'" class="text-gray-200 text-center px-1 py-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
                        <label for="" class="block py-2 bg-gray-600">{{getSetting('Rating 5')}}</label>
                        <input type="text" name="" id="" class="w-full text-center text-black" @change="updateRating()" v-model="rating.rating_5">
                    </div>

                    <div v-if="getSetting('Rating 6') != '0'" class="text-gray-200 text-center px-1 py-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
                        <label for="" class="block py-2 bg-gray-600">{{getSetting('Rating 6')}}</label>
                        <input type="text" name="" id="" class="w-full text-center text-black" @change="updateRating()" v-model="rating.rating_6">
                    </div>

                    <div v-if="getSetting('Rating 7') != '0'" class="text-gray-200 text-center px-1 py-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
                        <label for="" class="block py-2 bg-gray-600">{{getSetting('Rating 7')}}</label>
                        <input type="text" name="" id="" class="w-full text-center text-black" @change="updateRating()" v-model="rating.rating_7">
                    </div>

                    <div v-if="getSetting('Rating 8') != '0'" class="text-gray-200 text-center px-1 py-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
                        <label for="" class="block py-2 bg-gray-600">{{getSetting('Rating 8')}}</label>
                        <input type="text" name="" id="" class="w-full text-center text-black" @change="updateRating()" v-model="rating.rating_8">
                    </div>

                    <div v-if="getSetting('Rating 9') != '0'" class="text-gray-200 text-center px-1 py-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
                        <label for="" class="block py-2 bg-gray-600">{{getSetting('Rating 9')}}</label>
                        <input type="text" name="" id="" class="w-full text-center text-black" @change="updateRating()" v-model="rating.rating_9">
                    </div>

                    <div v-if="getSetting('Rating 10') != '0'" class="text-gray-200 text-center px-1 py-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
                        <label for="" class="block py-2 bg-gray-600">{{getSetting('Rating 10')}}</label>
                        <input type="text" name="" id="" class="w-full text-center text-black" @change="updateRating()" v-model="rating.rating_10">
                    </div>

                    <div v-if="getSetting('Rating 11') != '0'" class="text-gray-200 text-center px-1 py-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
                        <label for="" class="block py-2 bg-gray-600">{{getSetting('Rating 11')}}</label>
                        <input type="text" name="" id="" class="w-full text-center text-black" @change="updateRating()" v-model="rating.rating_11">
                    </div>

                    <div v-if="getSetting('Rating 12') != '0'" class="text-gray-200 text-center px-1 py-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
                        <label for="" class="block py-2 bg-gray-600">{{getSetting('Rating 12')}}</label>
                        <input type="text" name="" id="" class="w-full text-center text-black" @change="updateRating()" v-model="rating.rating_12">
                    </div>

                </div>
            </div>
            

            <table class="w-full mb-6">
                <tr>
                    <td class="border-gray-400 border p-2 w-20">
                        <img :src="$page.props.settings.logo">
                    </td>
                    <td class="border-gray-400 border p-2" colspan="3">
                        <h3 class="text-xl font-bold">{{ $page.props.settings.schoolName }}</h3>
                        <span class="text-sm text-gray-500">{{ $page.props.settings.tagLine }}</span>
                    </td>
                </tr>
            </table>


            <table class="w-full mb-6">
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold" rowspan="4">
                        <img :src="admission.admission_photos[0].media" :alt="admission.first_name">
                    </td>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Name</td>
                    <td class="border-gray-400 border p-2" colspan="3">{{ admission.first_name }} {{ admission.middle_name }} {{ admission.last_name }}</td>
                </tr>

                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Contact Number</td>
                    <td class="border-gray-400 border p-2">{{ admission.phone }}</td>
                </tr>

                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Email Address</td>
                    <td class="border-gray-400 border p-2">{{ admission.email }}</td>
                </tr>

                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Address</td>
                    <td class="border-gray-400 border p-2 text-sm">{{ admission.admission_addresses[0].address }} {{ admission.admission_addresses[0].city }} {{ admission.admission_addresses[0].pincode }} {{ admission.admission_addresses[0].state }} {{ admission.admission_addresses[0].country }}</td>
                </tr>
                
            </table>

            <table class="w-full mb-6">
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Gender</td>
                    <td class="border-gray-400 border p-2">{{ admission.gender }}</td>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Blood Group</td>
                    <td class="border-gray-400 border p-2">{{ admission.blood_group }}</td>
                </tr>
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Date of Birth</td>
                    <td class="border-gray-400 border p-2">{{ admission.dob }}</td>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Birth Place</td>
                    <td class="border-gray-400 border p-2">{{ admission.birth_place }}</td>
                </tr>
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Religion</td>
                    <td class="border-gray-400 border p-2">{{ admission.religion }}</td>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Cast Category</td>
                    <td class="border-gray-400 border p-2">{{ admission.cast_category }}</td>
                </tr>
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Cast</td>
                    <td class="border-gray-400 border p-2">{{ admission.cast }}</td>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Sub-cast</td>
                    <td class="border-gray-400 border p-2">{{ admission.subcast }}</td>
                </tr>
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Mother Tongue</td>
                    <td class="border-gray-400 border p-2">{{ admission.mothertongue }}</td>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Nationality</td>
                    <td class="border-gray-400 border p-2">{{ admission.nationality }}</td>
                </tr>
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Aadhar</td>
                    <td class="border-gray-400 border p-2">{{ admission.aadhar }}</td>
                    <td class="border-gray-400 border p-2 w-40 font-bold">First Language</td>
                    <td class="border-gray-400 border p-2">{{ admission.first_language.language }}</td>
                </tr>
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Second Language</td>
                    <td class="border-gray-400 border p-2">{{ admission.second_language.language }}</td>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Third Language</td>
                    <td class="border-gray-400 border p-2">{{ admission.third_language.language }}</td>
                </tr>
            </table>

            <table class="w-full mb-6" v-for="parent in admission.admission_parents" :key="parent.id">
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold" colspan="4">{{ parent.relation }}</td>
                </tr>
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Name</td>
                    <td class="border-gray-400 border p-2" colspan="3">{{ parent.first_name }} {{ parent.middle_name }} {{ parent.last_name }}</td>
                </tr>
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Email</td>
                    <td class="border-gray-400 border p-2">{{ parent.email }}</td>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Phone</td>
                    <td class="border-gray-400 border p-2">{{ parent.phone }}</td>
                </tr>
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">PAN</td>
                    <td class="border-gray-400 border p-2">{{ parent.pan }}</td>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Aadhar Number</td>
                    <td class="border-gray-400 border p-2">{{ parent.aadhar }}</td>
                </tr>

                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Qualification</td>
                    <td class="border-gray-400 border p-2">{{ parent.qualification }}</td>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Degree</td>
                    <td class="border-gray-400 border p-2">{{ parent.degree }}</td>
                </tr>

                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Occupation</td>
                    <td class="border-gray-400 border p-2">{{ parent.occupation }}</td>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Annual Income</td>
                    <td class="border-gray-400 border p-2">{{ parent.annual_income }}</td>
                </tr>

                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Date of Birth</td>
                    <td class="border-gray-400 border p-2">{{ parent.dob }}</td>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Company Name</td>
                    <td class="border-gray-400 border p-2">{{ parent.company_name }}</td>
                </tr>
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Address</td>
                    <td class="border-gray-400 border p-2" colspan="3">{{ parent.company_address }}</td>
                </tr>
            </table>

            <table class="w-full mb-6">
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold" colspan="4">Previous School Information</td>
                </tr>
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">School</td>
                    <td class="border-gray-400 border p-2" colspan="3">{{ admission.previous_school }}</td>
                </tr>
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold">Board</td>
                    <td class="border-gray-400 border p-2" colspan="3">{{ admission.board }}</td>
                </tr>
            </table>


            <table class="w-full mb-6">
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold" colspan="4">Documents</td>
                </tr>
                <tr>
                    <td v-for="doc in admission.admission_documents" :key="doc.id" class="border-gray-400 border p-2 w-1/2 align-top">
                        <p class="py-4 font-bold">{{ doc.document_name }}</p>
                        <img :src="doc.document" class="w-full">
                    </td>
                </tr>
            </table>

            <table class="w-full mb-6" v-if="admission.user.successful_applications.length > 0">
                <tr>
                    <td class="border-gray-400 border p-2 w-40 font-bold" colspan="4">Other Applications</td>
                </tr>
                <template v-for="app in admission.user.successful_applications" :key="app.id">
                    <tr v-if="admission.id != app.id">
                        <td class="border-gray-400 border p-2 w-1/2 align-top">
                            <Link :href="'/admission_pool/applications/'+app.id">
                                <p class="font-bold">Application ID: {{ app.id }}</p>
                                <p class="">{{ app.first_name }} {{ app.middle_name }} {{ app.last_name }} - {{ app.gender }}</p>
                                <p class="">Date of Birth: {{ app.dob }}</p>
                                <p class="">{{ app.phone }} - {{ app.email }}</p>
                            </Link>
                        </td>
                    </tr>
                </template>
                
            </table>

            
        </div>



    </Administrator>

</template>