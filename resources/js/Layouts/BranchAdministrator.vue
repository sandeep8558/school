<script>
import { Head, Link, useForm } from '@inertiajs/vue3';


export default {
    props: {
    },

    data: function () {
        return {
            isSidebar: true,
            ughadZap : {
                schoolBootstrap : false,
                branchBootstrap : false,
                gradeManager: false,
                staffManager: false,
            },
            isBranchSelect: false,
            form: useForm({
                branch_id: null,
            }),
        };
    },

    methods: {
        
        sidebarOC() {
            this.isSidebar = !this.isSidebar;
        },

        ughadZapKar(what, val){

            for (const [key, value] of Object.entries(this.ughadZap)) {
                this.ughadZap[key] = false;
            }

            switch(what){
                case "schoolBootstrap" : this.ughadZap.schoolBootstrap = val; break;
                case "branchBootstrap" : this.ughadZap.branchBootstrap = val; break;
                case "gradeManager" : this.ughadZap.gradeManager = val; break;
                case "staffManager" : this.ughadZap.staffManager = val; break;
            }
            
        },

        branchChange(e){
            this.form.post('/user_manager/branch/update', {
                onSuccess: data => {
                    this.isBranchSelect = false;
                }
            });
        }
    },

    mounted: function() {
        this.form.branch_id = this.$page.props.gbranch.id;
    },

    components: { Head, Link }
}

</script>

<template>

    <main class="select-none">
        <div class="flex bg-gray-300 h-screen">
            
            <!-- Left Section -->
            <div class="bg-gradient-to-r from-black to-purple-950 min-w-[360px] py-2 lg:py-12 pl-2 lg:pl-12" :class="isSidebar ? 'hidden lg:block' : 'block lg:hidden'">
                <div class="bg-gradient-to-r from-purple-950 to-purple-800 h-full shadow-md rounded-l-lg overflow-y-auto scrollbar-thin scrollbar-thumb-purple-950 scrollbar-track-transparent">

                    <div class="flex px-5 py-6 items-center space-x-3 sticky top-0 bg-gradient-to-r from-purple-950 to-purple-800">
                        <div class="w-16 h-16 rounded-full overflow-hidden">
                            <img src="/user.jpg" alt="Sandeep Rathod">
                        </div>
                        <div class="">
                            <h1 class="text-white"></h1>
                            <h2 class="text-white text-sm font-extrabold"><i>Hi,</i> {{ $page.props.auth.user.name }}</h2>
                            <hr>
                            <p class="text-gray-300 text-xs">Branch Administrator</p>
                        </div>
                    </div>

                    <!-- <div class="px-4">
                        <hr>
                    </div> -->

                    <!-- Side Navigation -->
                    <div class=" px-4">
                        <ul class="nav-ul">

                            <li class="nav-li">
                                <Link href="/dashboard_administrator" class="nav-link" :class="{'active': $page.url === '/dashboard_administrator'}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    Dashboard
                                </Link>
                            </li>

                            <!-- Bootstart Menu -->
                            <li class="nav-li">
                                <a href="#" class="nav-link" :class="ughadZap.schoolBootstrap || $page.url.startsWith('/school_bootstrap') ? 'active' : ''" @click="ughadZapKar('schoolBootstrap', !ughadZap.schoolBootstrap)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    <span class="">School Bootstrap</span>
                                    <span class="float-right">&#128899;</span>
                                </a>
                                <ul class="nav-sec-ul" v-if="ughadZap.schoolBootstrap || $page.url.startsWith('/school_bootstrap')">
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url === '/school_bootstrap/school_profile'}" href="/school_bootstrap/school_profile">School Profile</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url === '/school_bootstrap/designation'}" href="/school_bootstrap/designation">Designation</Link>
                                    </li>
                                </ul>
                            </li>


                            <!-- Branch Bootstart Menu -->
                            <li class="nav-li">
                                <a href="#" class="nav-link" :class="ughadZap.branchBootstrap || $page.url.startsWith('/branch_bootstrap') ? 'active' : ''" @click="ughadZapKar('branchBootstrap', !ughadZap.branchBootstrap)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    <span class="">Branch Bootstrap</span>
                                    <span class="float-right">&#128899;</span>
                                </a>
                                <ul class="nav-sec-ul" v-if="ughadZap.branchBootstrap || $page.url.startsWith('/branch_bootstrap')">
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url === '/branch_bootstrap/classroom'}" href="/branch_bootstrap/classroom">Classroom Manager</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url === '/branch_bootstrap/house'}" href="/branch_bootstrap/house">House</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url === '/branch_bootstrap/staff_shift'}" href="/branch_bootstrap/staff_shift">Staff Shift</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url === '/branch_bootstrap/student_shift'}" href="/branch_bootstrap/student_shift">Student Shift</Link>
                                    </li>
                                </ul>
                            </li>


                            <!-- Grade Manager -->
                            <li class="nav-li">
                                <a href="#" class="nav-link" :class="ughadZap.gradeManager || $page.url.startsWith('/grade_manager') ? 'active' : ''" @click="ughadZapKar('gradeManager', !ughadZap.gradeManager)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    <span class="">Grade Manager</span>
                                    <span class="float-right">&#128899;</span>
                                </a>
                                <ul class="nav-sec-ul" v-if="ughadZap.gradeManager || $page.url.startsWith('/grade_manager')">
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/grade_manager/subjects')}" href="/grade_manager/subjects">Subjects</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/grade_manager/sections')}" href="/grade_manager/sections">Sections</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/grade_manager/grades')}" href="/grade_manager/grades">Grades</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/grade_manager/subject_group')}" href="/grade_manager/subject_group">Subject Group</Link>
                                    </li>
                                    
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/grade_manager/grade_subjects')}" href="/grade_manager/grade_subjects">Grade Subjects</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/grade_manager/grade_subject_books')}" href="/grade_manager/grade_subject_books">Grade Subject Books</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/grade_manager/grade_subject_book_topics')}" href="/grade_manager/grade_subject_book_topics">Book Topics</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/grade_manager/grade_subject_book_topic_subtopics')}" href="/grade_manager/grade_subject_book_topic_subtopics">Book Subtopics</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/grade_manager/grade_remark')}" href="/grade_manager/grade_remark">Grade Remarks</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/grade_manager/grade_subjects_remark')}" href="/grade_manager/grade_subjects_remark">Grade Subject Remarks</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/grade_manager/division')}" href="/grade_manager/division">Division</Link>
                                    </li>
                                </ul>
                            </li>


                            <!-- Staff Manager -->
                            <li class="nav-li">
                                <a href="#" class="nav-link" :class="ughadZap.staffManager || $page.url.startsWith('/staff_manager') ? 'active' : ''" @click="ughadZapKar('staffManager', !ughadZap.staffManager)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    <span class="">Staff Manager</span>
                                    <span class="float-right">&#128899;</span>
                                </a>
                                <ul class="nav-sec-ul" v-if="ughadZap.staffManager || $page.url.startsWith('/staff_manager')">
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/staff_manager/staffs')}" href="/staff_manager/staffs">Staff</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/staff_manager/staff_photo')}" href="/staff_manager/staff_photo">Staff Photo</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/staff_manager/staff_address')}" href="/staff_manager/staff_address">Staff Address</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/staff_manager/staff_documents')}" href="/staff_manager/staff_documents">Staff Documents</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/staff_manager/staff_branch')}" href="/staff_manager/staff_branch">Staff Branch</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/staff_manager/staff_designation')}" href="/staff_manager/staff_designation">Staff Designation</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/staff_manager/staff_shift_duty')}" href="/staff_manager/staff_shift_duty">Staff Shift Duty</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/staff_manager/staff_section')}" href="/staff_manager/staff_section">Staff Section</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/staff_manager/staff_grade')}" href="/staff_manager/staff_grade">Staff Grade</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url.startsWith('/staff_manager/staff_subject')}" href="/staff_manager/staff_subject">Staff Subject</Link>
                                    </li>
                                </ul>
                            </li>

                            <li class="cursor-pointer select-none">
                                <Link href="/settings" class="nav-link" :class="{'active': $page.url === '/settings'}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    Settings
                                </Link>
                            </li>

                            <li class="cursor-pointer select-none">
                                <Link href="/user_manager" class="nav-link" :class="{'active': $page.url.startsWith('/user_manager')}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    User Manager
                                </Link>
                            </li>

                            <li class="cursor-pointer select-none">
                                <Link href="/logout" method="post" as="button" class="nav-link w-full text-left" :class="{'active': $page.url === '/logout'}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    Logout
                                </Link>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>

            <!-- Right Section -->
            <div class="w-full py-2 lg:py-12 pr-2 lg:pr-12" :class="isSidebar ? 'pl-2 lg:pl-0' : 'pl-0 lg:pl-12'">
                <div class="bg-gray-50 shadow-md h-full rounded-r-lg overflow-auto scrollbar-thin scrollbar-thumb-gray-100 hover:scrollbar-thumb-gray-500 scrollbar-track-transparent" :class="isSidebar ? 'rounded-l-lg lg:rounded-l-none' : 'rounded-l-none lg:rounded-l-lg'">

                    <!-- Top navigation bar -->
                    <div class="p-4 bg-gray-50 sticky top-0 z-50">
                        <div class="shadow-md rounded-lg p-4 border flex space-x-3 items-center">
                            <!-- Hamburger -->
                            <div class="flex flex-col space-y-1 min-w-[24px] cursor-pointer select-none" @click="sidebarOC()">
                                <div class="border-2 border-gray-500"></div>
                                <div class="border-2 border-gray-500"></div>
                                <div class="border-2 border-gray-500"></div>
                            </div>

                            <div class="font-extrabold text-lg uppercase select-none w-full">{{$page.props.settings.schoolName}}</div>

                            <div class="w-auto whitespace-nowrap text-xs cursor-pointer">
                                <span v-if="!isBranchSelect" @click="isBranchSelect = !isBranchSelect">
                                    {{ $page.props.gbranch.name }}
                                </span>
                                
                                <select @change="branchChange($event)" v-if="isBranchSelect" class="py-1 text-xs" v-model="form.branch_id">
                                    <option v-for="bra in $page.props.gbranches" :key="bra.id" :value="bra.id" :selected="bra.id == $page.props.gbranch.id">{{ bra.name }}</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="px-4 pb-4">
                        <slot></slot>
                    </div>
                    

                </div>
            </div>

        </div>
    </main>
    
</template>
