<script>
export default {

    props :[ 'modelValue', 'label', 'error', 'width', ],

    data: function(){
        return {
            fieldWidth: 'w-full',
        };
    },

    created: function () {
        if(this.width == undefined || this.width == '' || this.width == null){
            this.fieldWidth = 'w-full'
        } else {
            this.fieldWidth = this.width;
        }
    }
}
</script>

<template>

    <div class="mb-5" :class="fieldWidth">
        <div class="relative bg-white">
            <input type="date" id="floating_outlined" class="peer floating-inp" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
            <label for="floating_outlined" class="floating-lbl">{{ label }}</label>
        </div>
        <span class="text-sm text-red-500">{{ error }}</span>
    </div>

</template>