<script>
export default {

    props :[ 'modelValue', 'label', 'error', 'width', 'options' ],

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
    },

    computed: {
        proxyChecked(){
            return this.modelValue;
        },
    },
}
</script>

<template>
    
    <div class="py-2 px-3 mb-4" :class="fieldWidth">
        <p class="mb-1">{{ label }}</p>
        <div v-for="option in options" :key="option.val" class="mb-2">
            <input type="checkbox" class="mr-2 cursor-pointer" :id="'grade'+option.val" name="grade_id" :value="option.val"  @input="$emit('update:modelValue', $event.target.value)">
            <label :for="'grade'+option.val" class="cursor-pointer">{{ option.key }}</label>
        </div>
    </div>

</template>