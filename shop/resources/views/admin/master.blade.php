<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>پنل مدیریت</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="favicon.png" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{url('panel/css/perfect-scrollbar.min.css')}}" />
{{--    <link rel="stylesheet" type="text/css" media="screen" href="{{url('tailwind/assets/app-fbFKsjzm.css')}}" />--}}
    @vite('resources/css/app.css')
    <link defer rel="stylesheet" type="text/css" media="screen" href="{{url('panel/css/animate.css')}}" />
    <script src="{{url('panel/js/perfect-scrollbar.min.js')}}"></script>
    <script defer src="{{url('panel/js/popper.min.js')}}"></script>
    <script defer src="{{url('panel/js/tippy-bundle.umd.min.js')}}"></script>
    <script defer src="{{url('panel/js/sweetalert.min.js')}}"></script>
</head>

<body
    x-data="main"
    class="relative overflow-x-hidden text-sm antialiased font-normal font-vazir font-nunito"
    :class="  [ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme, $store.app.menu, $store.app.layout,$store.app.rtlClass]"
>
<!-- sidebar menu overlay -->
<div x-cloak class="fixed inset-0 z-50 bg-[black]/60 lg:hidden" :class="{'hidden' : !$store.app.sidebar}" @click="$store.app.toggleSidebar()"></div>

<!-- screen loader -->
<div class="screen_loader animate__animated fixed inset-0 z-[60] grid place-content-center bg-[#fafafa] dark:bg-[#060818]">
    <svg width="64" height="64" viewBox="0 0 135 135" xmlns="http://www.w3.org/2000/svg" fill="#4361ee">
        <path
            d="M67.447 58c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10zm9.448 9.447c0 5.523 4.477 10 10 10 5.522 0 10-4.477 10-10s-4.478-10-10-10c-5.523 0-10 4.477-10 10zm-9.448 9.448c-5.523 0-10 4.477-10 10 0 5.522 4.477 10 10 10s10-4.478 10-10c0-5.523-4.477-10-10-10zM58 67.447c0-5.523-4.477-10-10-10s-10 4.477-10 10 4.477 10 10 10 10-4.477 10-10z"
        >
            <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="-360 67 67" dur="2.5s" repeatCount="indefinite" />
        </path>
        <path
            d="M28.19 40.31c6.627 0 12-5.374 12-12 0-6.628-5.373-12-12-12-6.628 0-12 5.372-12 12 0 6.626 5.372 12 12 12zm30.72-19.825c4.686 4.687 12.284 4.687 16.97 0 4.686-4.686 4.686-12.284 0-16.97-4.686-4.687-12.284-4.687-16.97 0-4.687 4.686-4.687 12.284 0 16.97zm35.74 7.705c0 6.627 5.37 12 12 12 6.626 0 12-5.373 12-12 0-6.628-5.374-12-12-12-6.63 0-12 5.372-12 12zm19.822 30.72c-4.686 4.686-4.686 12.284 0 16.97 4.687 4.686 12.285 4.686 16.97 0 4.687-4.686 4.687-12.284 0-16.97-4.685-4.687-12.283-4.687-16.97 0zm-7.704 35.74c-6.627 0-12 5.37-12 12 0 6.626 5.373 12 12 12s12-5.374 12-12c0-6.63-5.373-12-12-12zm-30.72 19.822c-4.686-4.686-12.284-4.686-16.97 0-4.686 4.687-4.686 12.285 0 16.97 4.686 4.687 12.284 4.687 16.97 0 4.687-4.685 4.687-12.283 0-16.97zm-35.74-7.704c0-6.627-5.372-12-12-12-6.626 0-12 5.373-12 12s5.374 12 12 12c6.628 0 12-5.373 12-12zm-19.823-30.72c4.687-4.686 4.687-12.284 0-16.97-4.686-4.686-12.284-4.686-16.97 0-4.687 4.686-4.687 12.284 0 16.97 4.686 4.687 12.284 4.687 16.97 0z"
        >
            <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="360 67 67" dur="8s" repeatCount="indefinite" />
        </path>
    </svg>
</div>


<div class="min-h-screen text-black main-container dark:text-white-dark" :class="[$store.app.navbar]">
    <!-- start sidebar section -->
    <div :class="{'dark text-white-dark' : $store.app.semidark}">
        <nav
            x-data="sidebar"
            class="sidebar fixed top-0 bottom-0 z-50 h-full min-h-screen w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] transition-all duration-300"
        >
            <div class="h-full bg-white dark:bg-[#0e1726]">
                <div class="flex items-center justify-between px-4 py-3">
                    <a href="index.html" class="flex items-center main-logo shrink-0">
                        <img class="ml-[5px] w-8 flex-none" src="{{url('panel/images/logo.svg')}}" alt="image" />
                        <span class="align-middle text-2xl font-semibold ltr:ml-1.5 rtl:mr-1.5 dark:text-white-light lg:inline">IMO</span>
                    </a>
                    <a
                        href="javascript:;"
                        class="flex items-center w-8 h-8 transition duration-300 rounded-full collapse-icon hover:bg-gray-500/10 rtl:rotate-180 dark:text-white-light dark:hover:bg-dark-light/10"
                        @click="$store.app.toggleSidebar()"
                    >
                        <svg class="w-5 h-5 m-auto" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                opacity="0.5"
                                d="M16.9998 19L10.9998 12L16.9998 5"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </a>
                </div>
                <ul
                    class="perfect-scrollbar relative h-[calc(100vh-80px)] space-y-0.5 overflow-y-auto overflow-x-hidden p-4 py-0 font-semibold"
                    x-data="{ activeDropdown: 'dashboard' }"
                >
                    <li class="menu nav-item">
                        <button
                            type="button"
                            class="nav-link group"
                            :class="{'active' : activeDropdown === 'dashboard'}"
                            @click="activeDropdown === 'dashboard' ? activeDropdown = null : activeDropdown = 'dashboard'"
                        >
                            <div class="flex items-center">
                                <svg
                                    class="group-hover:!text-primary"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        opacity="0.5"
                                        d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                                        fill="currentColor"
                                    />
                                    <path
                                        d="M9 17.25C8.58579 17.25 8.25 17.5858 8.25 18C8.25 18.4142 8.58579 18.75 9 18.75H15C15.4142 18.75 15.75 18.4142 15.75 18C15.75 17.5858 15.4142 17.25 15 17.25H9Z"
                                        fill="currentColor"
                                    />
                                </svg>

                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">داشبورد</span>
                            </div>
                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'dashboard'}">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </button>
                        <ul x-cloak x-show="activeDropdown === 'dashboard'" x-collapse class="text-gray-500 sub-menu">
                            <li>
                                <a href="{{route('panel')}}">داشبورد</a>
                            </li>
                            <li>
                                <a href="{{route('admin.users.list')}}">کاربران</a>
                            </li>
                            <!-- here -->
                        </ul>
                    </li>




                </ul>
            </div>
        </nav>
    </div>
    <!-- end sidebar section -->

    <div class="main-content">
        <!-- start header section -->
        <header :class="{'dark' : $store.app.semidark && $store.app.menu === 'horizontal'}">
            <div class="shadow-sm">
                <div class="relative flex w-full items-center bg-white px-5 py-2.5 dark:bg-[#0e1726]">
                    <div class="flex items-center justify-between horizontal-logo ltr:mr-2 rtl:ml-2 lg:hidden">
                        <a href="index.html" class="flex items-center main-logo shrink-0">
                            <img class="inline w-8 ltr:-ml-1 rtl:-mr-1" src="{{url('panel/images/logo.svg')}}" alt="image" />
                        </a>

                        <a
                            href="javascript:;"
                            class="collapse-icon flex flex-none rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary ltr:ml-2 rtl:mr-2 dark:bg-dark/40 dark:text-[#d0d2d6] dark:hover:bg-dark/60 dark:hover:text-primary lg:hidden"
                            @click="$store.app.toggleSidebar()"
                        >
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 7L4 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path opacity="0.5" d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M20 17L4 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </a>
                    </div>

                    <div
                        x-data="header"
                        class="flex items-center space-x-1.5 ltr:ml-auto rtl:mr-auto rtl:space-x-reverse dark:text-[#d0d2d6] sm:flex-1 ltr:sm:ml-0 sm:rtl:mr-0 lg:space-x-2"
                    >
                        <div class="sm:ltr:mr-auto sm:rtl:ml-auto" x-data="{ search: false }" @click.outside="search = false">
                            <form
                                class="absolute inset-x-0 z-10 hidden mx-4 -translate-y-1/2 top-1/2 sm:relative sm:top-0 sm:mx-0 sm:block sm:translate-y-0"
                                :class="{'!block' : search}"
                                @submit.prevent="search = false"
                            >
                                <div class="relative">
                                    <input
                                        type="text"
                                        class="bg-gray-100 peer form-input placeholder:tracking-widest ltr:pl-9 ltr:pr-9 rtl:pr-9 rtl:pl-9 sm:bg-transparent ltr:sm:pr-4 rtl:sm:pl-4"
                                        placeholder="جستجو"
                                    />
                                    <button
                                        type="button"
                                        class="absolute inset-0 appearance-none h-9 w-9 peer-focus:text-primary ltr:right-auto rtl:left-auto"
                                    >
                                        <svg class="mx-auto" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5" opacity="0.5" />
                                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    </button>
                                    <button
                                        type="button"
                                        class="absolute block -translate-y-1/2 top-1/2 hover:opacity-80 ltr:right-2 rtl:left-2 sm:hidden"
                                        @click="search = false"
                                    >
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                                            <path
                                                d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                            <button
                                type="button"
                                class="p-2 rounded-full search_btn bg-white-light/40 hover:bg-white-light/90 dark:bg-dark/40 dark:hover:bg-dark/60 sm:hidden"
                                @click="search = ! search"
                            >
                                <svg
                                    class="mx-auto h-4.5 w-4.5 dark:text-[#d0d2d6]"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5" opacity="0.5" />
                                    <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                        <div>
                            <a
                                href="javascript:;"
                                x-cloak
                                x-show="$store.app.theme === 'light'"
                                href="javascript:;"
                                class="flex items-center p-2 rounded-full bg-white-light/40 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60"
                                @click="$store.app.toggleTheme('dark')"
                            >
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="5" stroke="currentColor" stroke-width="1.5" />
                                    <path d="M12 2V4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path d="M12 20V22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path d="M4 12L2 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path d="M22 12L20 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path
                                        opacity="0.5"
                                        d="M19.7778 4.22266L17.5558 6.25424"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                    />
                                    <path
                                        opacity="0.5"
                                        d="M4.22217 4.22266L6.44418 6.25424"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                    />
                                    <path
                                        opacity="0.5"
                                        d="M6.44434 17.5557L4.22211 19.7779"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                    />
                                    <path
                                        opacity="0.5"
                                        d="M19.7778 19.7773L17.5558 17.5551"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                    />
                                </svg>
                            </a>
                            <a
                                href="javascript:;"
                                x-cloak
                                x-show="$store.app.theme === 'dark'"
                                href="javascript:;"
                                class="flex items-center p-2 rounded-full bg-white-light/40 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60"
                                @click="$store.app.toggleTheme('system')"
                            >
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21.0672 11.8568L20.4253 11.469L21.0672 11.8568ZM12.1432 2.93276L11.7553 2.29085V2.29085L12.1432 2.93276ZM21.25 12C21.25 17.1086 17.1086 21.25 12 21.25V22.75C17.9371 22.75 22.75 17.9371 22.75 12H21.25ZM12 21.25C6.89137 21.25 2.75 17.1086 2.75 12H1.25C1.25 17.9371 6.06294 22.75 12 22.75V21.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75V1.25C6.06294 1.25 1.25 6.06294 1.25 12H2.75ZM15.5 14.25C12.3244 14.25 9.75 11.6756 9.75 8.5H8.25C8.25 12.5041 11.4959 15.75 15.5 15.75V14.25ZM20.4253 11.469C19.4172 13.1373 17.5882 14.25 15.5 14.25V15.75C18.1349 15.75 20.4407 14.3439 21.7092 12.2447L20.4253 11.469ZM9.75 8.5C9.75 6.41182 10.8627 4.5828 12.531 3.57467L11.7553 2.29085C9.65609 3.5593 8.25 5.86509 8.25 8.5H9.75ZM12 2.75C11.9115 2.75 11.8077 2.71008 11.7324 2.63168C11.6686 2.56527 11.6538 2.50244 11.6503 2.47703C11.6461 2.44587 11.6482 2.35557 11.7553 2.29085L12.531 3.57467C13.0342 3.27065 13.196 2.71398 13.1368 2.27627C13.0754 1.82126 12.7166 1.25 12 1.25V2.75ZM21.7092 12.2447C21.6444 12.3518 21.5541 12.3539 21.523 12.3497C21.4976 12.3462 21.4347 12.3314 21.3683 12.2676C21.2899 12.1923 21.25 12.0885 21.25 12H22.75C22.75 11.2834 22.1787 10.9246 21.7237 10.8632C21.286 10.804 20.7293 10.9658 20.4253 11.469L21.7092 12.2447Z"
                                        fill="currentColor"
                                    />
                                </svg>
                            </a>
                            <a
                                href="javascript:;"
                                x-cloak
                                x-show="$store.app.theme === 'system'"
                                href="javascript:;"
                                class="flex items-center p-2 rounded-full bg-white-light/40 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60"
                                @click="$store.app.toggleTheme('light')"
                            >
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 9C3 6.17157 3 4.75736 3.87868 3.87868C4.75736 3 6.17157 3 9 3H15C17.8284 3 19.2426 3 20.1213 3.87868C21 4.75736 21 6.17157 21 9V14C21 15.8856 21 16.8284 20.4142 17.4142C19.8284 18 18.8856 18 17 18H7C5.11438 18 4.17157 18 3.58579 17.4142C3 16.8284 3 15.8856 3 14V9Z"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                    />
                                    <path opacity="0.5" d="M22 21H2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path opacity="0.5" d="M15 15H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </a>
                        </div>

                        <div class="dropdown" x-data="dropdown" @click.outside="open = false">
                            <a
                                href="javascript:;"
                                class="relative block p-2 rounded-full bg-white-light/40 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60"
                                @click="toggle"
                            >
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19.0001 9.7041V9C19.0001 5.13401 15.8661 2 12.0001 2C8.13407 2 5.00006 5.13401 5.00006 9V9.7041C5.00006 10.5491 4.74995 11.3752 4.28123 12.0783L3.13263 13.8012C2.08349 15.3749 2.88442 17.5139 4.70913 18.0116C9.48258 19.3134 14.5175 19.3134 19.291 18.0116C21.1157 17.5139 21.9166 15.3749 20.8675 13.8012L19.7189 12.0783C19.2502 11.3752 19.0001 10.5491 19.0001 9.7041Z"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                    />
                                    <path
                                        d="M7.5 19C8.15503 20.7478 9.92246 22 12 22C14.0775 22 15.845 20.7478 16.5 19"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                    />
                                    <path d="M12 6V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>

                                <span class="absolute top-0 flex w-3 h-3 ltr:right-0 rtl:left-0">
                                            <span
                                                class="absolute -top-[3px] inline-flex h-full w-full animate-ping rounded-full bg-success/50 opacity-75 ltr:-left-[3px] rtl:-right-[3px]"
                                            ></span>
                                            <span class="relative inline-flex h-[6px] w-[6px] rounded-full bg-success"></span>
                                        </span>
                            </a>
                            <ul
                                x-cloak
                                x-show="open"
                                x-transition
                                x-transition.duration.300ms
                                class="top-11 w-[300px] divide-y !py-0 text-dark ltr:-right-2 rtl:-left-2 dark:divide-white/10 dark:text-white-dark sm:w-[350px]"
                            >
                                <li>
                                    <div class="flex items-center justify-between px-4 py-2 font-semibold hover:!bg-transparent">
                                        <h4 class="text-lg">نوتیفیکیشن</h4>
                                        <template x-if="notifications.length">
                                            <span class="badge bg-primary/80" x-text="notifications.length + 'New'"></span>
                                        </template>
                                    </div>
                                </li>
                                <template x-for="notification in notifications">
                                    <li class="dark:text-white-light/90">
                                        <div class="flex items-center px-4 py-2 group" @click.self="toggle">
                                            <div class="grid rounded place-content-center">
                                                <div class="relative w-12 h-12">
                                                    <img
                                                        class="object-cover w-12 h-12 rounded-full"
                                                        :src="`{{url('panel/images/${notification.profile}')}}`"
                                                        alt="image"
                                                    />
                                                    <span class="absolute right-[6px] bottom-0 block h-2 w-2 rounded-full bg-success"></span>
                                                </div>
                                            </div>
                                            <div class="flex flex-auto ltr:pl-3 rtl:pr-3">
                                                <div class="ltr:pr-3 rtl:pl-3">
                                                    <h6 x-html="notification.message"></h6>
                                                    <span class="block text-xs font-normal dark:text-gray-500" x-text="notification.time"></span>
                                                </div>
                                                <button
                                                    type="button"
                                                    class="opacity-0 text-neutral-300 hover:text-danger group-hover:opacity-100 ltr:ml-auto rtl:mr-auto"
                                                    @click="removeNotification(notification.id)"
                                                >
                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                                                        <path
                                                            d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                        />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </template>
                                <template x-if="notifications.length">
                                    <li>
                                        <div class="p-4">
                                            <button class="block w-full btn btn-primary btn-small" @click="toggle">همه نوتیفیکیشن ها را بخوانید</button>
                                        </div>
                                    </li>
                                </template>
                                <template x-if="!notifications.length">
                                    <li>
                                        <div class="!grid min-h-[200px] place-content-center text-lg hover:!bg-transparent">
                                            <div class="mx-auto mb-4 rounded-full text-primary ring-4 ring-primary/30">
                                                <svg width="40" height="40" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        opacity="0.5"
                                                        d="M20 10C20 4.47715 15.5228 0 10 0C4.47715 0 0 4.47715 0 10C0 15.5228 4.47715 20 10 20C15.5228 20 20 15.5228 20 10Z"
                                                        fill="currentColor"
                                                    />
                                                    <path
                                                        d="M10 4.25C10.4142 4.25 10.75 4.58579 10.75 5V11C10.75 11.4142 10.4142 11.75 10 11.75C9.58579 11.75 9.25 11.4142 9.25 11V5C9.25 4.58579 9.58579 4.25 10 4.25Z"
                                                        fill="currentColor"
                                                    />
                                                    <path
                                                        d="M10 15C10.5523 15 11 14.5523 11 14C11 13.4477 10.5523 13 10 13C9.44772 13 9 13.4477 9 14C9 14.5523 9.44772 15 10 15Z"
                                                        fill="currentColor"
                                                    />
                                                </svg>
                                            </div>
                                            اطلاعاتی موجود نیست.
                                        </div>
                                    </li>
                                </template>
                            </ul>
                        </div>
                        <div class="flex-shrink-0 dropdown" x-data="dropdown" @click.outside="open = false">
                            <a href="javascript:;" class="relative group" @click="toggle()">
                                        <span
                                        ><img
                                                class="object-cover rounded-full h-9 w-9 saturate-50 group-hover:saturate-100"
                                                src="{{url('panel/images/user-profile.jpeg')}}"
                                                alt="image"
                                            /></span>
                            </a>
                            <ul
                                x-cloak
                                x-show="open"
                                x-transition
                                x-transition.duration.300ms
                                class="top-11 w-[230px] !py-0 font-semibold text-dark ltr:right-0 rtl:left-0 dark:text-white-dark dark:text-white-light/90"
                            >
                                <li>
                                    <div class="flex items-center px-4 py-4">
                                        <div class="flex-none">
                                            <img class="object-cover w-10 h-10 rounded-md" src="{{url('panel/images/user-profile.jpeg')}}" alt="image" />
                                        </div>
                                        <div class="ltr:pl-4 rtl:pr-4">
                                            <h4 class="text-base">
                                                جان دو<span class="px-1 text-xs rounded bg-success-light text-success ltr:ml-2 rtl:ml-2">Pro</span>
                                            </h4>
                                            <a
                                                class="text-black/60 hover:text-primary dark:text-dark-light/60 dark:hover:text-white"
                                                href="javascript:;"
                                            >johndoe@gmail.com</a
                                            >
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="users-profile.html" class="dark:hover:text-white" @click="toggle">
                                        <svg
                                            class="h-4.5 w-4.5 ltr:mr-2 rtl:ml-2"
                                            width="18"
                                            height="18"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                                            <path
                                                opacity="0.5"
                                                d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            />
                                        </svg>
                                        پروفایل</a
                                    >
                                </li>
                                <li>
                                    <a href="apps-mailbox.html" class="dark:hover:text-white" @click="toggle">
                                        <svg
                                            class="h-4.5 w-4.5 ltr:mr-2 rtl:ml-2"
                                            width="18"
                                            height="18"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                opacity="0.5"
                                                d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            />
                                            <path
                                                d="M6 8L8.1589 9.79908C9.99553 11.3296 10.9139 12.0949 12 12.0949C13.0861 12.0949 14.0045 11.3296 15.8411 9.79908L18 8"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                            />
                                        </svg>
                                        صندوق ورودی</a
                                    >
                                </li>
                                <li>
                                    <a href="auth-boxed-lockscreen.html" class="dark:hover:text-white" @click="toggle">
                                        <svg
                                            class="h-4.5 w-4.5 ltr:mr-2 rtl:ml-2"
                                            width="18"
                                            height="18"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            />
                                            <path
                                                opacity="0.5"
                                                d="M6 10V8C6 4.68629 8.68629 2 12 2C15.3137 2 18 4.68629 18 8V10"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                            />
                                            <g opacity="0.5">
                                                <path
                                                    d="M9 16C9 16.5523 8.55228 17 8 17C7.44772 17 7 16.5523 7 16C7 15.4477 7.44772 15 8 15C8.55228 15 9 15.4477 9 16Z"
                                                    fill="currentColor"
                                                />
                                                <path
                                                    d="M13 16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16C11 15.4477 11.4477 15 12 15C12.5523 15 13 15.4477 13 16Z"
                                                    fill="currentColor"
                                                />
                                                <path
                                                    d="M17 16C17 16.5523 16.5523 17 16 17C15.4477 17 15 16.5523 15 16C15 15.4477 15.4477 15 16 15C16.5523 15 17 15.4477 17 16Z"
                                                    fill="currentColor"
                                                />
                                            </g>
                                        </svg>
                                        صفحه قفل</a
                                    >
                                </li>
                                <li class="border-t border-white-light dark:border-white-light/10">
                                    <a href="auth-boxed-signin.html" class="!py-3 text-danger" @click="toggle">
                                        <svg
                                            class="h-4.5 w-4.5 rotate-90 ltr:mr-2 rtl:ml-2"
                                            width="18"
                                            height="18"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                opacity="0.5"
                                                d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                            />
                                            <path
                                                d="M12 15L12 2M12 2L15 5.5M12 2L9 5.5"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                        خروج از سیستم
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </header>
        <!-- end header section -->

        {{$slot}}
    </div>
</div>

{{--<script src="{{url('panel/js/alpine-collaspe.min.js')}}"></script>--}}
{{--<script src="{{url('panel/js/alpine-persist.min.js')}}"></script>--}}
{{--<script defer src="{{url('panel/js/alpine-ui.min.js')}}"></script>--}}
{{--<script defer src="{{url('panel/js/alpine-focus.min.js')}}"></script>--}}
{{--<script defer src="{{url('panel/js/alpine.min.js')}}"></script>--}}
<script src="{{url('panel/js/custom.js')}}"></script>
<script defer src="{{url('panel/js/apexcharts.js')}}"></script>
<script>
    // main section
    document.addEventListener('alpine:init', () => {

        // sidebar section
        Alpine.data('sidebar', () => ({
            init() {
                const selector = document.querySelector('.sidebar ul a[href="' + window.location.pathname + '"]');
                if (selector) {
                    selector.classList.add('active');
                    const ul = selector.closest('ul.sub-menu');
                    if (ul) {
                        let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                        if (ele) {
                            ele = ele[0];
                            setTimeout(() => {
                                ele.click();
                            });
                        }
                    }
                }
            },
        }));

        // header section
        Alpine.data('header', () => ({
            init() {
                const selector = document.querySelector('ul.horizontal-menu a[href="' + window.location.pathname + '"]');
                if (selector) {
                    selector.classList.add('active');
                    const ul = selector.closest('ul.sub-menu');
                    if (ul) {
                        let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                        if (ele) {
                            ele = ele[0];
                            setTimeout(() => {
                                ele.classList.add('active');
                            });
                        }
                    }
                }
            },

            notifications: [
                {
                    id: 1,
                    profile: 'user-profile.jpeg',
                    message: '<strong class="mr-1 text-sm">جان دو</strong>شما را به <strong>نمونه سازی اولیه</strong> دعوت می کند',
                    time: '45 min ago',
                },
                {
                    id: 2,
                    profile: 'profile-34.jpeg',
                    message: '<strong class="mr-1 text-sm">آدام نولان</strong>از شما در <strong>مبانی UX</strong> نام برد',
                    time: '9h Ago',
                },
                {
                    id: 3,
                    profile: 'profile-16.jpeg',
                    message: '<strong class="mr-1 text-sm">آنا مورگان</strong>آپلود یک فایل',
                    time: '9h Ago',
                },
            ],

            messages: [
                {
                    id: 1,
                    image: '<span class="grid rounded-full place-content-center w-9 h-9 bg-success-light dark:bg-success text-success dark:text-success-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></span>',
                    title: 'تبریک می گویم!',
                    message: 'سیستم عامل شما به روز شده است.',
                    time: '1hr',
                },
                {
                    id: 2,
                    image: '<span class="grid rounded-full place-content-center w-9 h-9 bg-info-light dark:bg-info text-info dark:text-info-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg></span>',
                    title: 'آیا می دانستی؟',
                    message: 'می توانید بین تابلوهای هنری جابجا شوید.',
                    time: '2hr',
                },
                {
                    id: 3,
                    image: '<span class="grid rounded-full place-content-center w-9 h-9 bg-danger-light dark:bg-danger text-danger dark:text-danger-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>',
                    title: 'مشکلی پیش آمد!',
                    message: 'ارسال گزارش',
                    time: '2days',
                },
                {
                    id: 4,
                    image: '<span class="grid rounded-full place-content-center w-9 h-9 bg-warning-light dark:bg-warning text-warning dark:text-warning-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">    <circle cx="12" cy="12" r="10"></circle>    <line x1="12" y1="8" x2="12" y2="12"></line>    <line x1="12" y1="16" x2="12.01" y2="16"></line></svg></span>',
                    title: 'هشدار',
                    message: 'قدرت رمز عبور شما کم است.',
                    time: '5days',
                },
            ],

            languages: [
                {
                    id: 1,
                    key: 'Chinese',
                    value: 'zh',
                },
                {
                    id: 2,
                    key: 'Danish',
                    value: 'da',
                },
                {
                    id: 3,
                    key: 'English',
                    value: 'en',
                },
                {
                    id: 4,
                    key: 'French',
                    value: 'fr',
                },
                {
                    id: 5,
                    key: 'German',
                    value: 'de',
                },
                {
                    id: 6,
                    key: 'Greek',
                    value: 'el',
                },
                {
                    id: 7,
                    key: 'Hungarian',
                    value: 'hu',
                },
                {
                    id: 8,
                    key: 'Italian',
                    value: 'it',
                },
                {
                    id: 9,
                    key: 'Japanese',
                    value: 'ja',
                },
                {
                    id: 10,
                    key: 'Polish',
                    value: 'pl',
                },
                {
                    id: 11,
                    key: 'Portuguese',
                    value: 'pt',
                },
                {
                    id: 12,
                    key: 'Russian',
                    value: 'ru',
                },
                {
                    id: 13,
                    key: 'Spanish',
                    value: 'es',
                },
                {
                    id: 14,
                    key: 'Swedish',
                    value: 'sv',
                },
                {
                    id: 15,
                    key: 'Turkish',
                    value: 'tr',
                },
            ],

            removeNotification(value) {
                this.notifications = this.notifications.filter((d) => d.id !== value);
            },

            removeMessage(value) {
                this.messages = this.messages.filter((d) => d.id !== value);
            },
        }));


    });
</script>
</body>
</html>
