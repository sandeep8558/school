<script>
import { Head, Link } from '@inertiajs/vue3';


export default {
    props: {
    },

    data: function () {
        return {
            isSidebar: true,
            ughadZap : {
                schoolBootstrap : false,
                gradeManager: false,
            },
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
                case "gradeManager" : this.ughadZap.gradeManager = val; break;
            }
            
        }
    },

    mounted: function() {
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
                            <p class="text-gray-300 text-xs">Administrator</p>
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
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url === '/school_bootstrap/classroom'}" href="/school_bootstrap/classroom">Classroom Manager</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url === '/school_bootstrap/house'}" href="/school_bootstrap/house">House</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url === '/school_bootstrap/staff_shift'}" href="/school_bootstrap/staff_shift">Staff Shift</Link>
                                    </li>
                                    <li>
                                        <Link class="nav-sec-link" :class="{'active': $page.url === '/school_bootstrap/student_shift'}" href="/school_bootstrap/student_shift">Student Shift</Link>
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
                                </ul>
                            </li>


                            <!-- <li class="nav-li">
                                <a href="#" class="nav-link" :class="ughadZap.bootstrap ? 'bg-gradient-to-r from-orange-700 to-orange-500' : ''" @click="ughadZapKar('bootstrap', !ughadZap.bootstrap)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    <span class="">Grade Setup</span>
                                    <span class="float-right">&#128899;</span>
                                </a>
                                <ul class="nav-sec-ul" v-if="ughadZap.bootstrap">
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">School Profile</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Grade Manager</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Division Manager</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-li">
                                <a href="#" class="nav-link" :class="ughadZap.bootstrap ? 'bg-gradient-to-r from-orange-700 to-orange-500' : ''" @click="ughadZapKar('bootstrap', !ughadZap.bootstrap)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    <span class="">Fee Manager</span>
                                    <span class="float-right">&#128899;</span>
                                </a>
                                <ul class="nav-sec-ul" v-if="ughadZap.bootstrap">
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">School Profile</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Grade Manager</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Division Manager</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-li">
                                <a href="#" class="nav-link" :class="ughadZap.bootstrap ? 'bg-gradient-to-r from-orange-700 to-orange-500' : ''" @click="ughadZapKar('bootstrap', !ughadZap.bootstrap)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    <span class="">Employee Manager</span>
                                    <span class="float-right">&#128899;</span>
                                </a>
                                <ul class="nav-sec-ul" v-if="ughadZap.bootstrap">
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">School Profile</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Grade Manager</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Division Manager</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-li">
                                <a href="#" class="nav-link" :class="ughadZap.bootstrap ? 'bg-gradient-to-r from-orange-700 to-orange-500' : ''" @click="ughadZapKar('bootstrap', !ughadZap.bootstrap)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    <span class="">Student Manager</span>
                                    <span class="float-right">&#128899;</span>
                                </a>
                                <ul class="nav-sec-ul" v-if="ughadZap.bootstrap">
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">School Profile</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Grade Manager</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Division Manager</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-li">
                                <a href="#" class="nav-link" :class="ughadZap.bootstrap ? 'bg-gradient-to-r from-orange-700 to-orange-500' : ''" @click="ughadZapKar('bootstrap', !ughadZap.bootstrap)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    <span class="">Admissions</span>
                                    <span class="float-right">&#128899;</span>
                                </a>
                                <ul class="nav-sec-ul" v-if="ughadZap.bootstrap">
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">School Profile</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Grade Manager</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Division Manager</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-li">
                                <a href="#" class="nav-link" :class="ughadZap.bootstrap ? 'bg-gradient-to-r from-orange-700 to-orange-500' : ''" @click="ughadZapKar('bootstrap', !ughadZap.bootstrap)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    <span class="">Academic Year Manager</span>
                                    <span class="float-right">&#128899;</span>
                                </a>
                                <ul class="nav-sec-ul" v-if="ughadZap.bootstrap">
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">School Profile</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Grade Manager</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Division Manager</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-li">
                                <a href="#" class="nav-link" :class="ughadZap.bootstrap ? 'bg-gradient-to-r from-orange-700 to-orange-500' : ''" @click="ughadZapKar('bootstrap', !ughadZap.bootstrap)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    <span class="">Batch Manager</span>
                                    <span class="float-right">&#128899;</span>
                                </a>
                                <ul class="nav-sec-ul" v-if="ughadZap.bootstrap">
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">School Profile</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Grade Manager</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Division Manager</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-li">
                                <a href="#" class="nav-link" :class="ughadZap.bootstrap ? 'bg-gradient-to-r from-orange-700 to-orange-500' : ''" @click="ughadZapKar('bootstrap', !ughadZap.bootstrap)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    <span class="">Ecampus/Attendance</span>
                                    <span class="float-right">&#128899;</span>
                                </a>
                                <ul class="nav-sec-ul" v-if="ughadZap.bootstrap">
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">School Profile</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Grade Manager</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Division Manager</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-li">
                                <a href="#" class="nav-link" :class="ughadZap.staffManager ? 'bg-gradient-to-r from-orange-700 to-orange-500' : ''" @click="ughadZapKar('staffManager', !ughadZap.staffManager)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    <span class="">Exam Manager</span>
                                    <span class="float-right">&#128899;</span>
                                </a>
                                <ul class="flex flex-col space-y-1 bg-gradient-to-r from-purple-700 to-purple-500 text-white mt-2 rounded-md" v-if="ughadZap.staffManager">
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Attendance</a>
                                    </li>
                                    <li>
                                        <a class="text-md block px-14 py-2 rounded-md hover:bg-gradient-to-r hover:from-orange-700 hover:to-orange-500" href="">Staff Designation</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="cursor-pointer select-none">
                                <a href="/" class="nav-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    Students Manager
                                </a>
                            </li> -->

                            <li class="cursor-pointer select-none">
                                <Link href="/settings" class="nav-link" :class="{'active': $page.url === '/settings'}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    Settings
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

                            <div class="font-extrabold text-lg uppercase select-none">{{$page.props.settings.schoolName}}</div>

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
