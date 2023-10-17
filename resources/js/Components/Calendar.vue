<script>
export default {
    
    props: {
        weekoffs: Object,
        halfdays: Object,
        holidays: Object,
    },

    data: function () {
        return {
            /* Construction Variables */
            months: ['January','February','March','April','May','June','July','August','September','October','November','December'],
            days: ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
            day_count: [31,28,31,30,31,30,31,31,30,31,30,31],
            squares: 42,

            /* The current date is displayed with a green border */
            current_date: null,

            /* Selected Academic Year */
            academic_year: {
                id:null,
            },

            /* Selected Grade */
            grade: {
                id : null,
            },

            /* Select List */
            academic_years: [],
            grades: [],
        };
    },

    methods: {

        /* Get Academic Years */
        getAcademicYears(){
            return fetch('/api_call/fetch/academic_years')
            .then(data => data.json())
            .then(response => {
                this.academic_years = response;
            });
        },

        /* Get Grades */
        getGrades(){
            return fetch('/api_call/fetch/grades')
            .then(data => data.json())
            .then(response => {
                this.grades = response;
            });
        },

        setAcademicYear(){
            let academic_year = null;
            if(this.academic_years.length > 0){

                this.academic_years.forEach(ay => {

                    if(this.academic_year.id == null){
                        if(new Date(this.today) >= new Date(ay.from) && new Date(this.today) <= new Date(ay.to)){
                            academic_year =  ay;
                            this.current_date = this.today;
                        }
                    } else {
                        if(ay.id == this.academic_year.id){
                            academic_year =  ay;
                            if(new Date(this.today) >= new Date(ay.from) && new Date(this.today) <= new Date(ay.to)){
                                this.current_date = this.today;
                            } else {
                                this.current_date = academic_year.from;
                            }
                        }
                    }
                    
                });

                if(academic_year == null){
                    academic_year = this.academic_years[0];
                    this.current_date = academic_year.from;
                }

                this.academic_year.id = academic_year.id;

                this.emitOptionsChange();
            }
        },

        setCurrentDate(mt){
            let dd = '01';
            let yyyy = null;
            let mm = null;
            if(mt > 11){
                yyyy = this.year + 1;
                mm = String(1).padStart(2, '0');
            } else if(mt < 0) {
                yyyy = this.year - 1;
                mm = String(12).padStart(2, '0');
            } else {
                yyyy = this.year;
                mm = String(mt + 1).padStart(2, '0');
            }
            let today = new Date();
            if(yyyy == today.getFullYear() & mm == String(today.getMonth() + 1).padStart(2, '0')){
                dd = String(today.getDate()).padStart(2, '0');
            }
            this.current_date = yyyy + '-' + mm + '-' + dd;
        },

        setHolidayName(dt){
            let message = null;
            this.holiday.forEach(elm => {
                if(elm.on_date == dt){
                    message = elm.note;
                }
            });
            return message;
        },

        validateDate(dt){
            let d = new Date(dt);
            let dd = d.getDate();
            let mm = d.getMonth();
            let yyyy = d.getFullYear();
            let newDate = yyyy + '-' + String(mm + 1).padStart(2, '0') + '-' + String(dd).padStart(2, '0');
            return (dd > 0 && dd <= this.day_count[mm] && dt == newDate) ? true : false;
        },

        emitDblClick(day){
            if(this.validateDate(day)){
                let data = {
                    on_date : day,
                    grade_id : this.grade.id,
                    academic_year_id : this.academic_year.id
                };
                this.$emit('onDblClick', data);
            }
        },

        emitOptionsChange(){
            this.$emit('onOptionsChange', {
                grade_id: this.grade.id,
                academic_year_id: this.academic_year.id
            })
        },

        async init(){
            await this.getAcademicYears();
            await this.getGrades();
            this.grade = this.grades.length > 0 ? this.grades[0] : { id: null };
            this.setAcademicYear();
        },

    },

    created: function(){
        this.init();
    },

    mounted: function() {
    },

    computed: {

        weekoff(){
            return this.weekoffs == undefined || this.weekoffs == null ? [] : this.weekoffs;
        },

        halfday(){
            return this.halfdays == undefined || this.halfdays == null ? [] : this.halfdays;
        },

        holiday(){
            return this.holidays == undefined || this.holidays == null ? [] : this.holidays;
        },

        today(){
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0');
            let yyyy = today.getFullYear();
            return yyyy + '-' + mm + '-' + dd;
        },

        year(){
            let today = this.current_date == null ? new Date() : new Date(this.current_date);
            this.day_count[1] = today.getFullYear() % 4 == 0 ? 29 : 28;
            return today.getFullYear();
        },

        month(){
            let today = this.current_date == null ? new Date() : new Date(this.current_date);
            return today.getMonth();
        },

        date(){
            let today = this.current_date == null ? new Date() : new Date(this.current_date);
            return today.getDate();
        },

        first_day(){
            let dt = this.year + '-' + (this.month + 1) + '-' + 1;
            let d = new Date(dt);
            
            let ts = d.getDay() + this.day_count[this.month];

            if(ts <= 28){
                this.squares = 28;
            } else if (ts > 28 & ts <= 35){
                this.squares = 35;
            } else {
                this.squares = 42;
            }

            return d.getDay();
        },

    },

    components: {}
}
</script>

<template>

    <div>

        <div class="w-full mb-4 flex">
            
            <!-- Grade Select List -->
            <div class="w-1/2">
                <label class="block mb-1" for="grade">Grade</label>
                <select @change="emitOptionsChange()" class="w-full rounded" name="grade" id="grade" v-model="grade">
                    <option v-for="grade in grades" :key="grade.id" :value="grade">{{ grade.name }}</option>
                </select>
            </div>

            <!-- Academic Year Select list -->
            <div class="w-1/2">
                <label class="block mb-1" for="ay">Select Academic Year</label>
                <select @change="setAcademicYear()" class="w-full rounded" name="ay" id="ay" v-model="academic_year.id">
                    <option v-for="ay in academic_years" :key="ay.id" :value="ay.id">{{ ay.name }} | {{ ay.from }} - {{ ay.to }}</option>
                </select>
            </div>

        </div>

        <div class="w-full flex border shadow-md rounded p-3 items-center">
            <div class="w-full">
                {{ date }} {{ months[month] }}, {{ year }}
            </div>
            <div class="w-auto whitespace-nowrap">
                <button @click="setCurrentDate(this.month - 1)" class="btn btn-red p-2 ml-1">&#9204;</button>
                <button @click="setCurrentDate(this.month + 1)" class="btn btn-red p-2 ml-1">&#9205;</button>
            </div>
        </div>

        <div class="flex flex-wrap">
            
            <!-- Header -->
            <div v-for="day in days" :key="day" class="bg-gray-200 text-black text-center border border-gray-300 p-3 w-[calc(100%/7)]">{{ day }}</div>

            <!-- Days -->
            <div @dblclick="emitDblClick(year + '-' + String(month + 1).padStart(2, '0') + '-' + (String(c - first_day).padStart(2, '0')))"
            v-for="c in squares" :key="c" 
            class="text-right h-28 border border-gray-300 p-3 w-[calc(100%/7)] cursor-pointer" 
            :class="[
                (c-first_day) == date ? 'border-2 border-green-500' : '',
                weekoff.includes(year + '-' + String(month + 1).padStart(2, '0') + '-' + String(c - first_day).padStart(2, '0') ) ? 'bg-red-100' : '',
                halfday.includes(year + '-' + String(month + 1).padStart(2, '0') + '-' + String(c - first_day).padStart(2, '0') ) ? 'bg-orange-100' : '',
                holiday.some(el => el.on_date === (year + '-' + String(month + 1).padStart(2, '0') + '-' + String(c - first_day).padStart(2, '0'))) ? 'bg-green-100' : '',
                ]"
            >


                <div class="flex flex-col h-full">

                    <div class="h-full">
                        {{ c - first_day > 0 & c - first_day <= day_count[month] ? c - first_day : '' }}
                    </div>

                    <div class="h-auto text-xs">
                        {{ setHolidayName(year + '-' + String(month + 1).padStart(2, '0') + '-' + String(c - first_day).padStart(2, '0')) }}
                    </div>

                </div>
                

                
            </div>
        </div>

    </div>
    
</template>