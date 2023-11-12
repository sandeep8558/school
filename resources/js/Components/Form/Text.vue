<script>
export default {

    props :[ 'modelValue', 'label', 'error', 'width', 'readonly' ],

    data: function(){
        return {
            fieldWidth: 'w-full',
            ro: false,
        };
    },

    created: function () {
        if(this.width == undefined || this.width == '' || this.width == null){
            this.fieldWidth = 'w-full'
        } else {
            this.fieldWidth = this.width;
        }

        if(this.readonly == undefined || this.readonly == '' || this.readonly == null){
            this.ro = false;
        } else {
            this.ro = this.readonly;
        }
    }
}
</script>

<template>

    <div class="mb-5" :class="fieldWidth">
        <div class="relative bg-white">
            <input type="text" id="floating_outlined" class="peer floating-inp" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" :readonly="ro" />
            <label for="floating_outlined" class="floating-lbl">{{ label }}</label>
        </div>
        <span class="text-sm text-red-500">{{ error }}</span>
    </div>

</template>