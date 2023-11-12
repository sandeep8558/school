<script>
import Modal from '../Modal.vue';

export default {

    props :[ 'modelValue', 'label', 'error', 'width', ],

    data: function(){
        return {
            fieldWidth: 'w-full',
            image: null,
            url: null,
        };
    },

    methods: {

        assignFile(img){
            if(img!=null){
                this.$emit('update:modelValue', img);
                this.url = URL.createObjectURL(img);
            }
        },

        setFile(e){
            if(e.target.files.length > 0){

                let img = e.target.files[0];
                this.assignFile(img);
                

            } else {

                this.$emit('update:modelValue', null);
                this.url = null;

            }
            
        },

    },

    created: function () {
        if(this.width == undefined || this.width == '' || this.width == null){
            this.fieldWidth = 'w-full'
        } else {
            this.fieldWidth = this.width;
        }
        this.assignFile(this.modelValue);
    }
}
</script>

<template>

    <div class="mb-5" :class="fieldWidth">

        <div class="flex space-x-6 items-center">
            <div v-if="url!=null" class="w-32">
                <img :src="url" >
            </div>
            <div class="w-full">

                <div class="relative">
                    <label for="floating_outlined" class="block mb-2">{{ label }}</label>
                    <input @change="setFile($event)" type="file" id="floating_outlined" class="peer inp inp-file" />
                </div>
                <span class="text-sm text-red-500">{{ error }}</span>

            </div>
        </div>
        
        

        
    </div>

</template>