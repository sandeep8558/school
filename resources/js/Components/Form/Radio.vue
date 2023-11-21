<script>
export default {

    props :[ 'modelValue', 'label', 'error', 'width', 'options' ],

    data: function(){
        return {
            fieldWidth: 'w-full',
        };
    },

    methods: {
        sanStr(key, val, ind){
            return (this.label).toLowerCase().replace(/[^a-zA-Z0-9]/gim,"").trim() + (key).toLowerCase().replace(/[^a-zA-Z0-9]/gim,"").trim() + (val).toLowerCase().replace(/[^a-zA-Z0-9]/gim,"").trim() + ind;
        },
        sanLbl(){
            return (this.label).toLowerCase().replace(/[^a-zA-Z0-9]/gim,"").trim();
        },
        update(val){
            this.$emit('update:modelValue', val);
        },
    },

    created: function () {
        if(this.width == undefined || this.width == '' || this.width == null){
            this.fieldWidth = 'w-full'
        } else {
            this.fieldWidth = this.width;
        }
    },
}
</script>

<template>
    <div class="mb-5" :class="fieldWidth">
        <div class="relative bg-transparent">
            
            <label for="floating_outlined" class="block">{{ label }}</label>

            <template v-for="(option, ind) in options" :key="option.val">
                <input @change="update(option.val)" :value="option.val" type="radio" class="inline-block cursor-pointer" :name="sanLbl()" :id="sanStr(option.key, option.val, ind)" :checked="modelValue == option.val ? true : false">
                <label :for="sanStr(option.key, option.val, ind)" class="inline-block pl-2 pr-6 cursor-pointer">{{ option.key }}</label>
            </template>

        </div>
        <span class="text-sm text-red-500">{{ error }}</span>
    </div>
</template>