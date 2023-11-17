<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, useForm } from '@inertiajs/vue3';

import { 
    Datepicker,
    Input,
    Modal,
    Ripple,
    initTE
} from "tw-elements";

/* const form = useForm({
    key: 'ohh',
    value: '',
}); */

export default {
    props: ['mysettings'],

    data: function () {
        return {

            isSchoolProfileForm: false,

            isSaved: {
                schoolName: false,
                tagLine: false,
                address: false,
                city: false,
                pincode: false,
                state: false,
                country: false,
                lat: false,
                lng: false,
                email: false,
                phone: false,
                mailDomain: false,
                mailSecret: false,
                mailFromName: false,
                mailFromAddress: false,
                firebaseServerKey: false,
                googleMapsAPIkey: false,
                googleAPIKey: false,
                smsAPIKey: false,
                razorpayKayId: false,
                razorpayKaySecret: false,
                isAdmissionOpen: false,
                logo:false,
                favicon:false,

                rating_1: false,
                rating_2: false,
                rating_3: false,
                rating_4: false,
                rating_5: false,
                rating_6: false,
                rating_7: false,
                rating_8: false,
                rating_9: false,
                rating_10: false,
                rating_11: false,
                rating_12: false,
            },
            
            settings: {
                schoolName: '',
                tagLine: '',
                address: '',
                city: '',
                pincode: '',
                state: '',
                country: '',
                lat: '',
                lng: '',
                email: '',
                phone: '',
                mailDomain: '',
                mailSecret: '',
                mailFromName: '',
                mailFromAddress: '',
                firebaseServerKey: '',
                googleMapsAPIkey: '',
                googleAPIKey: '',
                smsAPIKey: '',
                razorpayKayId: '',
                razorpayKaySecret: '',
                isAdmissionOpen: '',
                logo: null,
                favicon: null,

                rating_1: '',
                rating_2: '',
                rating_3: '',
                rating_4: '',
                rating_5: '',
                rating_6: '',
                rating_7: '',
                rating_8: '',
                rating_9: '',
                rating_10: '',
                rating_11: '',
                rating_12: '',
            },

            form : useForm({
                key: '',
                val: '',
            }),
        };
    },

    methods: {

        getSettings(){
            this.mysettings.forEach(setting => {
                this.setKeyValue(setting.key, setting.val);
            });
        },

        setKeyValue(key, val){
            switch(key){
                case 'School Name': this.settings.schoolName = val; break;
                case 'Tag Line': this.settings.tagLine = val; break;
                case 'Address': this.settings.address = val; break;
                case 'City': this.settings.city = val; break;
                case 'Pincode': this.settings.pincode = val; break;
                case 'State': this.settings.state = val; break;
                case 'Country': this.settings.country = val; break;
                case 'Latitude': this.settings.lat = val; break;
                case 'Longitude': this.settings.lng = val; break;
                case 'Email Address': this.settings.email = val; break;
                case 'Phone Number': this.settings.phone = val; break;
                case 'Mail Domain': this.settings.mailDomain = val; break;
                case 'Mail Secret': this.settings.mailSecret = val; break;
                case 'Mail From Name': this.settings.mailFromName = val; break;
                case 'Mail From Address': this.settings.mailFromAddress = val; break;
                case 'Firebase Server Key': this.settings.firebaseServerKey = val; break;
                case 'Google Maps API key': this.settings.googleMapsAPIkey = val; break;
                case 'Google API Key': this.settings.googleAPIKey = val; break;
                case 'SMS API Key': this.settings.smsAPIKey = val; break;
                case 'Razorpay Kay Id': this.settings.razorpayKayId = val; break;
                case 'Razorpay Kay Secret': this.settings.razorpayKaySecret = val; break;
                case 'Is Admission Open': this.settings.isAdmissionOpen = val; break;
                case 'Logo': this.settings.logo = val; break;
                case 'Favicon': this.settings.favicon = val; break;

                case 'Rating 1': this.settings.rating_1 = val; break;
                case 'Rating 2': this.settings.rating_2 = val; break;
                case 'Rating 3': this.settings.rating_3 = val; break;
                case 'Rating 4': this.settings.rating_4 = val; break;
                case 'Rating 5': this.settings.rating_5 = val; break;
                case 'Rating 6': this.settings.rating_6 = val; break;
                case 'Rating 7': this.settings.rating_7 = val; break;
                case 'Rating 8': this.settings.rating_8 = val; break;
                case 'Rating 9': this.settings.rating_9 = val; break;
                case 'Rating 10': this.settings.rating_10 = val; break;
                case 'Rating 11': this.settings.rating_11 = val; break;
                case 'Rating 12': this.settings.rating_12 = val; break;
            }
        },

        updateField(key,val){
            this.form.val = val;
            this.form.key = key;
            if(val != null && val != ''){
                this.form.post('/settings/update', {
                    onFinish: data => {
                        setTimeout(this.hideSaved, 2000);
                        this.getSettings();
                    }
                });
            } else {
                this.hideSaved();
                this.getSettings();
            }
        },

        uploadFile(key, e){
            let file = null;
            let target = e.target;
            if (target && target.files) {
                file = target.files[0];
                this.updateField(key, file);
            }
        },

        changing(key, val){
            this.form.val = val;
        },

        hideSaved(){
            Object.keys(this.isSaved).forEach(key => {
                this.isSaved[key] = false;
            });
        },

    },

    mounted: function() {
        initTE({ Datepicker, Input, Modal, Ripple });
        this.getSettings();
    },

    components: { Administrator, Head }
}
</script>

<template>

    <Head title="Settings" />

    <Administrator>

        <div class="mb-3 mt-7 px-6">
            <h2 class="text-3xl font-bold">Logo Upload</h2>
            <p>Upload Logo file here.</p>
        </div>

        <div class="box">
            <ul class="w-full">
                <!-- Is Admission Open Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">
                        <img :src="settings.logo" class="h-28">
                    </div>
                    <div class="w-auto pr-3" v-if="isSaved.logo">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80 text-right">
                            <div class="">
                                <input
                                    @change="isSaved.logo = true;uploadFile('Logo', $event);"
                                    class="inp-file"
                                    type="file"
                                    accept="image/*"
                                    capture
                                    id="formFile" />
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>



        <div class="mb-3 mt-7 px-6">
            <h2 class="text-3xl font-bold">Favicon Upload</h2>
            <p>Upload Favicon file here.</p>
        </div>

        <div class="box">
            <ul class="w-full">
                <!-- Is Admission Open Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">
                        <img :src="settings.favicon" class="h-20">
                    </div>
                    <div class="w-auto pr-3" v-if="isSaved.favicon">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80 text-right">
                            <div class="">
                                <input
                                    @change="isSaved.favicon = true;uploadFile('Favicon', $event);"
                                    class="inp-file"
                                    type="file"
                                    accept="image/*"
                                    capture
                                    id="formFile" />
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>




        <div class="mb-3 mt-10 px-6">
            <h2 class="text-3xl font-bold">School Profile</h2>
            <p>Here you can change school name, tag line and logo of your school.</p>
        </div>
        

        <div class="box">
            
            <ul class="w-full">
                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">School Name</div>
                    
                    <div class="w-auto pr-3" v-if="isSaved.schoolName">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>

                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('School Name', settings.schoolName)"
                            @change="isSaved.schoolName = true;updateField('School Name', settings.schoolName);"
                            v-model="settings.schoolName"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter School Name" />
                        </div>
                    </div>
                </li>

                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Tag Line</div>
                    
                    <div class="w-auto pr-3" v-if="isSaved.tagLine">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>

                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Tag Line', settings.tagLine)"
                            @change="isSaved.tagLine = true;updateField('Tag Line', settings.tagLine)"
                            v-model="settings.tagLine"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Tag Line" />
                        </div>
                    </div>
                </li>
            </ul>

        </div>


        <div class="mb-3 mt-10 px-6">
            <h2 class="text-3xl font-bold">Contact Details</h2>
            <p>Here you can change address.</p>
        </div>
        

        <div class="box">
            
            <ul class="w-full">
                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">Address</div>
                    <div class="w-auto pr-3" v-if="isSaved.address">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Address', settings.address)"
                            @change="isSaved.address = true;updateField('Address', settings.address);"
                            v-model="settings.address"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Address" />
                        </div>
                    </div>
                </li>
                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">City</div>
                    <div class="w-auto pr-3" v-if="isSaved.city">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('City', settings.city)"
                            @change="isSaved.city = true;updateField('City', settings.city);"
                            v-model="settings.city"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter City" />
                        </div>
                    </div>
                </li>

                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">Pincode</div>
                    <div class="w-auto pr-3" v-if="isSaved.pincode">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Pincode', settings.pincode)"
                            @change="isSaved.pincode = true;updateField('Pincode', settings.pincode);"
                            v-model="settings.pincode"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Pincode" />
                        </div>
                    </div>
                </li>

                <!-- State Filed -->
                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">State</div>
                    <div class="w-auto pr-3" v-if="isSaved.state">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('State', settings.state)"
                            @change="isSaved.state = true;updateField('State', settings.state);"
                            v-model="settings.state"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter State" />
                        </div>
                    </div>
                </li>

                <!-- Country Filed -->
                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">Country</div>
                    <div class="w-auto pr-3" v-if="isSaved.country">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Country', settings.country)"
                            @change="isSaved.country = true;updateField('Country', settings.country);"
                            v-model="settings.country"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Country" />
                        </div>
                    </div>
                </li>

                <!-- Latitude Filed -->
                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">Latitude</div>
                    <div class="w-auto pr-3" v-if="isSaved.lat">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Latitude', settings.lat)"
                            @change="isSaved.lat = true;updateField('Latitude', settings.lat);"
                            v-model="settings.lat"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Latitude" />
                        </div>
                    </div>
                </li>

                <!-- Longitude Filed -->
                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">Longitude</div>
                    <div class="w-auto pr-3" v-if="isSaved.lng">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Longitude', settings.lng)"
                            @change="isSaved.lng = true;updateField('Longitude', settings.lng);"
                            v-model="settings.lng"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Longitude" />
                        </div>
                    </div>
                </li>

                <!-- Email Address Filed -->
                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">Email Address</div>
                    <div class="w-auto pr-3" v-if="isSaved.email">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Email Address', settings.email)"
                            @change="isSaved.email = true;updateField('Email Address', settings.email);"
                            v-model="settings.email"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Email Address" />
                        </div>
                    </div>
                </li>

                <!-- Phone Number Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Phone Number</div>
                    <div class="w-auto pr-3" v-if="isSaved.phone">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Phone Number', settings.phone)"
                            @change="isSaved.phone = true;updateField('Phone Number', settings.phone);"
                            v-model="settings.phone"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Phone Number" />
                        </div>
                    </div>
                </li>

            </ul>

        </div>


        <div class="mb-3 mt-10 px-6">
            <h2 class="text-3xl font-bold">Email API</h2>
            <p>Here you can change school name, tag line and logo of your school.</p>
        </div>
        

        <div class="box">
            
            <ul class="w-full">
                
                <!-- Mail Domain Filed -->
                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">Mail Domain</div>
                    <div class="w-auto pr-3" v-if="isSaved.mailDomain">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Mail Domain', settings.mailDomain)"
                            @change="isSaved.mailDomain = true;updateField('Mail Domain', settings.mailDomain);"
                            v-model="settings.mailDomain"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Mail Domain" />
                        </div>
                    </div>
                </li>

                <!-- Mail Secret Filed -->
                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">Mail Secret</div>
                    <div class="w-auto pr-3" v-if="isSaved.mailSecret">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Mail Secret', settings.mailSecret)"
                            @change="isSaved.mailSecret = true;updateField('Mail Secret', settings.mailSecret);"
                            v-model="settings.mailSecret"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Mail Secret" />
                        </div>
                    </div>
                </li>

                <!-- Mail From Name Filed -->
                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">Mail From Name</div>
                    <div class="w-auto pr-3" v-if="isSaved.mailFromName">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Mail From Name', settings.mailFromName)"
                            @change="isSaved.mailFromName = true;updateField('Mail From Name', settings.mailFromName);"
                            v-model="settings.mailFromName"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Mail From Name" />
                        </div>
                    </div>
                </li>

                <!-- Mail From Address Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Mail From Address</div>
                    <div class="w-auto pr-3" v-if="isSaved.mailFromAddress">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Mail From Address', settings.mailFromAddress)"
                            @change="isSaved.mailFromAddress = true;updateField('Mail From Address', settings.mailFromAddress);"
                            v-model="settings.mailFromAddress"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Mail From Address" />
                        </div>
                    </div>
                </li>

            </ul>

        </div>

        <div class="mb-3 mt-10 px-6">
            <h2 class="text-3xl font-bold">Google API</h2>
            <p>Here you can change school name, tag line and logo of your school.</p>
        </div>
        

        <div class="box">
            
            <ul class="w-full">
                
                <!-- Firebase Server Key Filed -->
                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">Firebase Server Key</div>
                    <div class="w-auto pr-3" v-if="isSaved.firebaseServerKey">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Firebase Server Key', settings.firebaseServerKey)"
                            @change="isSaved.firebaseServerKey = true;updateField('Firebase Server Key', settings.firebaseServerKey);"
                            v-model="settings.firebaseServerKey"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Firebase Server Key" />
                        </div>
                    </div>
                </li>

                <!-- Google Maps API key Filed -->
                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">Google Maps API key</div>
                    <div class="w-auto pr-3" v-if="isSaved.googleMapsAPIkey">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Google Maps API key', settings.googleMapsAPIkey)"
                            @change="isSaved.googleMapsAPIkey = true;updateField('Google Maps API key', settings.googleMapsAPIkey);"
                            v-model="settings.googleMapsAPIkey"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Google Maps API key" />
                        </div>
                    </div>
                </li>

                <!-- Google API Key Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Google API Key</div>
                    <div class="w-auto pr-3" v-if="isSaved.googleAPIKey">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Google API Key', settings.googleAPIKey)"
                            @change="isSaved.googleAPIKey = true;updateField('Google API Key', settings.googleAPIKey);"
                            v-model="settings.googleAPIKey"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Google API Key" />
                        </div>
                    </div>
                </li>

            </ul>

        </div>


        <div class="mb-3 mt-10 px-6">
            <h2 class="text-3xl font-bold">SMS API</h2>
            <p>Here you can change school name, tag line and logo of your school.</p>
        </div>
        

        <div class="box">
            
            <ul class="w-full">
                <!-- SMS API Key Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">SMS API Key</div>
                    <div class="w-auto pr-3" v-if="isSaved.smsAPIKey">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('SMS API Key', settings.smsAPIKey)"
                            @change="isSaved.smsAPIKey = true;updateField('SMS API Key', settings.smsAPIKey);"
                            v-model="settings.smsAPIKey"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter SMS API Key" />
                        </div>
                    </div>
                </li>
            </ul>

        </div>

        <div class="mb-3 mt-10 px-6">
            <h2 class="text-3xl font-bold">Razorpay API</h2>
            <p>Here you can change school name, tag line and logo of your school.</p>
        </div>
        

        <div class="box">
            
            <ul class="w-full">

                <!-- Razorpay Kay Id Filed -->
                <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50 flex items-center">
                    <div class="w-full">Razorpay Kay Id</div>
                    <div class="w-auto pr-3" v-if="isSaved.razorpayKayId">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Razorpay Kay Id', settings.razorpayKayId)"
                            @change="isSaved.razorpayKayId = true;updateField('Razorpay Kay Id', settings.razorpayKayId);"
                            v-model="settings.razorpayKayId"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Razorpay Kay Id" />
                        </div>
                    </div>
                </li>

                <!-- Razorpay Kay Secret Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Razorpay Kay Secret</div>
                    <div class="w-auto pr-3" v-if="isSaved.razorpayKaySecret">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Razorpay Kay Secret', settings.razorpayKaySecret)"
                            @change="isSaved.razorpayKaySecret = true;updateField('Razorpay Kay Secret', settings.razorpayKaySecret);"
                            v-model="settings.razorpayKaySecret"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Razorpay Kay Secret" />
                        </div>
                    </div>
                </li>

            </ul>

        </div>

        <div class="mb-3 mt-10 px-6">
            <h2 class="text-3xl font-bold">General Settings</h2>
            <p>Here you can change school name, tag line and logo of your school.</p>
        </div>
        

        <div class="box">
            
            <ul class="w-full">
                
                <!-- Is Admission Open Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Is Admission Open</div>
                    <!-- <div class="w-auto pr-3" v-if="isSaved.isAdmissionOpen">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div> -->
                    <div class="w-auto">
                        <div class="w-auto text-right">
                            <button
                            @click="isSaved.isAdmissionOpen = true;updateField('Is Admission Open', settings.isAdmissionOpen == null || settings.isAdmissionOpen == '' || settings.isAdmissionOpen == 'No' ? 'Yes' : 'No');"
                            type="button"
                            class="btn"
                            :class="settings.isAdmissionOpen == null || settings.isAdmissionOpen == '' || settings.isAdmissionOpen == 'No' ? 'btn-red' : 'btn-green'">
                            {{ settings.isAdmissionOpen == null || settings.isAdmissionOpen == '' || settings.isAdmissionOpen == 'No' ? 'No' : 'Yes' }}
                            </button>


                        </div>
                    </div>
                </li>

            </ul>

        </div>


        <div class="mb-3 mt-10 px-6">
            <h2 class="text-3xl font-bold">Admission Rating Setting</h2>
            <p>Change rating names according to your evalution method and choice.</p>
        </div>
        

        <div class="box">
            
            <ul class="w-full">
                
                <!-- Rating 1 Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Rating 1</div>
                    <div class="w-auto pr-3" v-if="isSaved.rating_1">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Rating 1', settings.rating_1)"
                            @change="isSaved.rating_1 = true;updateField('Rating 1', settings.rating_1);"
                            v-model="settings.rating_1"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Rating 1" />
                        </div>
                    </div>
                </li>

                <!-- Rating 2 Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Rating 2</div>
                    <div class="w-auto pr-3" v-if="isSaved.rating_2">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Rating 2', settings.rating_2)"
                            @change="isSaved.rating_2 = true;updateField('Rating 2', settings.rating_2);"
                            v-model="settings.rating_2"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Rating 2" />
                        </div>
                    </div>
                </li>

                <!-- Rating 3 Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Rating 3</div>
                    <div class="w-auto pr-3" v-if="isSaved.rating_3">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Rating 3', settings.rating_3)"
                            @change="isSaved.rating_3 = true;updateField('Rating 3', settings.rating_3);"
                            v-model="settings.rating_3"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Rating 3" />
                        </div>
                    </div>
                </li>

                <!-- Rating 4 Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Rating 4</div>
                    <div class="w-auto pr-3" v-if="isSaved.rating_4">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Rating 4', settings.rating_4)"
                            @change="isSaved.rating_4 = true;updateField('Rating 4', settings.rating_4);"
                            v-model="settings.rating_4"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Rating 4" />
                        </div>
                    </div>
                </li>

                <!-- Rating 5 Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Rating 5</div>
                    <div class="w-auto pr-3" v-if="isSaved.rating_5">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Rating 5', settings.rating_5)"
                            @change="isSaved.rating_5 = true;updateField('Rating 5', settings.rating_5);"
                            v-model="settings.rating_5"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Rating 5" />
                        </div>
                    </div>
                </li>

                <!-- Rating 6 Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Rating 6</div>
                    <div class="w-auto pr-3" v-if="isSaved.rating_6">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Rating 6', settings.rating_6)"
                            @change="isSaved.rating_6 = true;updateField('Rating 6', settings.rating_6);"
                            v-model="settings.rating_6"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Rating 6" />
                        </div>
                    </div>
                </li>

                <!-- Rating 7 Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Rating 7</div>
                    <div class="w-auto pr-3" v-if="isSaved.rating_7">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Rating 7', settings.rating_7)"
                            @change="isSaved.rating_7 = true;updateField('Rating 7', settings.rating_7);"
                            v-model="settings.rating_7"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Rating 7" />
                        </div>
                    </div>
                </li>

                <!-- Rating 8 Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Rating 8</div>
                    <div class="w-auto pr-3" v-if="isSaved.rating_8">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Rating 8', settings.rating_8)"
                            @change="isSaved.rating_8 = true;updateField('Rating 8', settings.rating_8);"
                            v-model="settings.rating_8"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Rating 8" />
                        </div>
                    </div>
                </li>

                <!-- Rating 9 Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Rating 9</div>
                    <div class="w-auto pr-3" v-if="isSaved.rating_9">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Rating 9', settings.rating_9)"
                            @change="isSaved.rating_9 = true;updateField('Rating 9', settings.rating_9);"
                            v-model="settings.rating_9"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Rating 9" />
                        </div>
                    </div>
                </li>

                <!-- Rating 10 Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Rating 10</div>
                    <div class="w-auto pr-3" v-if="isSaved.rating_10">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Rating 10', settings.rating_10)"
                            @change="isSaved.rating_10 = true;updateField('Rating 10', settings.rating_10);"
                            v-model="settings.rating_10"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Rating 10" />
                        </div>
                    </div>
                </li>

                <!-- Rating 11 Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Rating 11</div>
                    <div class="w-auto pr-3" v-if="isSaved.rating_11">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Rating 11', settings.rating_11)"
                            @change="isSaved.rating_11 = true;updateField('Rating 11', settings.rating_11);"
                            v-model="settings.rating_11"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Rating 11" />
                        </div>
                    </div>
                </li>

                <!-- Rating 12 Filed -->
                <li class="w-full py-4 flex items-center">
                    <div class="w-full">Rating 12</div>
                    <div class="w-auto pr-3" v-if="isSaved.rating_12">
                        <span class="duration-['150'] transition-opacity" :class="form.processing ? 'text-red-500' : 'text-green-800'">{{ form.processing ? 'Saving' : 'Saved' }}</span>
                    </div>
                    <div class="w-auto">
                        <div class="w-80">
                        <input
                            @input="changing('Rating 12', settings.rating_12)"
                            @change="isSaved.rating_12 = true;updateField('Rating 12', settings.rating_12);"
                            v-model="settings.rating_12"
                            type="text"
                            class="inp"
                            id="exampleSearch"
                            placeholder="Enter Rating 12" />
                        </div>
                    </div>
                </li>

            </ul>

        </div>


    </Administrator>

</template>

<style>



</style>