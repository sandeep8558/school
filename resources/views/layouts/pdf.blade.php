<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    @yield('head')

    <style>
        * {
            box-sizing: border-box;
            padding: 0px;
            margin: 0px;
        }
        .page-break {
            page-break-after: always;
        }
        table {
            border-collapse: collapse;
        }
        .border { border: 1px solid #666666; }
        .border-l { border-left: 1px solid #666666; }
        .border-r { border-right: 1px solid #666666; }
        .border-t { border-top: 1px solid #666666; }
        .border-b { border-bottom: 1px solid #666666; }


        .w-1 { width: 1%; }
        .w-2 { width: 2%; }
        .w-3 { width: 3%; }
        .w-4 { width: 4%; }
        .w-5 { width: 5%; }
        .w-6 { width: 6%; }
        .w-7 { width: 7%; }
        .w-8 { width: 8%; }
        .w-9 { width: 9%; }
        .w-10 { width: 10%; }
        .w-11 { width: 11%; }
        .w-12 { width: 12%; }
        .w-13 { width: 13%; }
        .w-14 { width: 14%; }
        .w-15 { width: 15%; }
        .w-16 { width: 16%; }
        .w-17 { width: 17%; }
        .w-18 { width: 18%; }
        .w-19 { width: 19%; }
        .w-20 { width: 20%; }
        .w-21 { width: 21%; }
        .w-22 { width: 22%; }
        .w-23 { width: 23%; }
        .w-24 { width: 24%; }
        .w-25 { width: 25%; }
        .w-26 { width: 26%; }
        .w-27 { width: 27%; }
        .w-28 { width: 28%; }
        .w-29 { width: 29%; }
        .w-30 { width: 30%; }
        .w-31 { width: 31%; }
        .w-32 { width: 32%; }
        .w-33 { width: 33%; }
        .w-34 { width: 34%; }
        .w-35 { width: 35%; }
        .w-36 { width: 36%; }
        .w-37 { width: 37%; }
        .w-38 { width: 38%; }
        .w-39 { width: 39%; }
        .w-40 { width: 40%; }
        .w-41 { width: 41%; }
        .w-42 { width: 42%; }
        .w-43 { width: 43%; }
        .w-44 { width: 44%; }
        .w-45 { width: 45%; }
        .w-46 { width: 46%; }
        .w-47 { width: 47%; }
        .w-48 { width: 48%; }
        .w-49 { width: 49%; }
        .w-50 { width: 50%; }
        .w-51 { width: 51%; }
        .w-52 { width: 52%; }
        .w-53 { width: 53%; }
        .w-54 { width: 54%; }
        .w-55 { width: 55%; }
        .w-56 { width: 56%; }
        .w-57 { width: 57%; }
        .w-58 { width: 58%; }
        .w-59 { width: 59%; }
        .w-60 { width: 60%; }
        .w-61 { width: 61%; }
        .w-62 { width: 62%; }
        .w-63 { width: 63%; }
        .w-64 { width: 64%; }
        .w-65 { width: 65%; }
        .w-66 { width: 66%; }
        .w-67 { width: 67%; }
        .w-68 { width: 68%; }
        .w-69 { width: 69%; }
        .w-70 { width: 70%; }
        .w-71 { width: 71%; }
        .w-72 { width: 72%; }
        .w-73 { width: 73%; }
        .w-74 { width: 74%; }
        .w-75 { width: 75%; }
        .w-76 { width: 76%; }
        .w-77 { width: 77%; }
        .w-78 { width: 78%; }
        .w-79 { width: 79%; }
        .w-80 { width: 80%; }
        .w-81 { width: 81%; }
        .w-82 { width: 82%; }
        .w-83 { width: 83%; }
        .w-84 { width: 84%; }
        .w-85 { width: 85%; }
        .w-86 { width: 86%; }
        .w-87 { width: 87%; }
        .w-88 { width: 88%; }
        .w-89 { width: 89%; }
        .w-90 { width: 90%; }
        .w-91 { width: 91%; }
        .w-92 { width: 92%; }
        .w-93 { width: 93%; }
        .w-94 { width: 94%; }
        .w-95 { width: 95%; }
        .w-96 { width: 96%; }
        .w-97 { width: 97%; }
        .w-98 { width: 98%; }
        .w-99 { width: 99%; }
        .w-100 { width: 100%; }

        .p-0 { padding: 0px; }
        .p-1 { padding: 1px; }
        .p-2 { padding: 2px; }
        .p-3 { padding: 3px; }
        .p-4 { padding: 4px; }
        .p-5 { padding: 5px; }
        .p-6 { padding: 6px; }
        .p-7 { padding: 7px; }
        .p-8 { padding: 8px; }
        .p-9 { padding: 9px; }
        .p-10 { padding: 10px; }
        .p-11 { padding: 11px; }
        .p-12 { padding: 12px; }
        .p-13 { padding: 13px; }
        .p-14 { padding: 14px; }
        .p-15 { padding: 15px; }
        .p-16 { padding: 16px; }
        .p-17 { padding: 17px; }
        .p-18 { padding: 18px; }
        .p-19 { padding: 19px; }
        .p-20 { padding: 20px; }
        .p-21 { padding: 21px; }
        .p-22 { padding: 22px; }
        .p-23 { padding: 23px; }
        .p-24 { padding: 24px; }
        .p-25 { padding: 25px; }
        .p-26 { padding: 26px; }
        .p-27 { padding: 27px; }
        .p-28 { padding: 28px; }
        .p-29 { padding: 29px; }
        .p-30 { padding: 30px; }
        .p-40 { padding: 40px; }
        .p-50 { padding: 50px; }
        .p-60 { padding: 60px; }
        .p-70 { padding: 70px; }
        .p-80 { padding: 80px; }
        .p-90 { padding: 90px; }
        .p-100 { padding: 100px; }

        .pt-0 { padding-top: 0px; }
        .pt-1 { padding-top: 1px; }
        .pt-2 { padding-top: 2px; }
        .pt-3 { padding-top: 3px; }
        .pt-4 { padding-top: 4px; }
        .pt-5 { padding-top: 5px; }
        .pt-6 { padding-top: 6px; }
        .pt-7 { padding-top: 7px; }
        .pt-8 { padding-top: 8px; }
        .pt-9 { padding-top: 9px; }
        .pt-10 { padding-top: 10px; }
        .pt-11 { padding-top: 11px; }
        .pt-12 { padding-top: 12px; }
        .pt-13 { padding-top: 13px; }
        .pt-14 { padding-top: 14px; }
        .pt-15 { padding-top: 15px; }
        .pt-16 { padding-top: 16px; }
        .pt-17 { padding-top: 17px; }
        .pt-18 { padding-top: 18px; }
        .pt-19 { padding-top: 19px; }
        .pt-20 { padding-top: 20px; }
        .pt-21 { padding-top: 21px; }
        .pt-22 { padding-top: 22px; }
        .pt-23 { padding-top: 23px; }
        .pt-24 { padding-top: 24px; }
        .pt-25 { padding-top: 25px; }
        .pt-26 { padding-top: 26px; }
        .pt-27 { padding-top: 27px; }
        .pt-28 { padding-top: 28px; }
        .pt-29 { padding-top: 29px; }
        .pt-30 { padding-top: 30px; }
        .pt-40 { padding-top: 40px; }
        .pt-50 { padding-top: 50px; }
        .pt-60 { padding-top: 60px; }
        .pt-70 { padding-top: 70px; }
        .pt-80 { padding-top: 80px; }
        .pt-90 { padding-top: 90px; }
        .pt-100 { padding-top: 100px; }

        .pb-0 { padding-bottom: 0px; }
        .pb-1 { padding-bottom: 1px; }
        .pb-2 { padding-bottom: 2px; }
        .pb-3 { padding-bottom: 3px; }
        .pb-4 { padding-bottom: 4px; }
        .pb-5 { padding-bottom: 5px; }
        .pb-6 { padding-bottom: 6px; }
        .pb-7 { padding-bottom: 7px; }
        .pb-8 { padding-bottom: 8px; }
        .pb-9 { padding-bottom: 9px; }
        .pb-10 { padding-bottom: 10px; }
        .pb-11 { padding-bottom: 11px; }
        .pb-12 { padding-bottom: 12px; }
        .pb-13 { padding-bottom: 13px; }
        .pb-14 { padding-bottom: 14px; }
        .pb-15 { padding-bottom: 15px; }
        .pb-16 { padding-bottom: 16px; }
        .pb-17 { padding-bottom: 17px; }
        .pb-18 { padding-bottom: 18px; }
        .pb-19 { padding-bottom: 19px; }
        .pb-20 { padding-bottom: 20px; }
        .pb-21 { padding-bottom: 21px; }
        .pb-22 { padding-bottom: 22px; }
        .pb-23 { padding-bottom: 23px; }
        .pb-24 { padding-bottom: 24px; }
        .pb-25 { padding-bottom: 25px; }
        .pb-26 { padding-bottom: 26px; }
        .pb-27 { padding-bottom: 27px; }
        .pb-28 { padding-bottom: 28px; }
        .pb-29 { padding-bottom: 29px; }
        .pb-30 { padding-bottom: 30px; }
        .pb-40 { padding-bottom: 40px; }
        .pb-50 { padding-bottom: 50px; }
        .pb-60 { padding-bottom: 60px; }
        .pb-70 { padding-bottom: 70px; }
        .pb-80 { padding-bottom: 80px; }
        .pb-90 { padding-bottom: 90px; }
        .pb-100 { padding-bottom: 100px; }

        .pl-0 { padding-left: 0px; }
        .pl-1 { padding-left: 1px; }
        .pl-2 { padding-left: 2px; }
        .pl-3 { padding-left: 3px; }
        .pl-4 { padding-left: 4px; }
        .pl-5 { padding-left: 5px; }
        .pl-6 { padding-left: 6px; }
        .pl-7 { padding-left: 7px; }
        .pl-8 { padding-left: 8px; }
        .pl-9 { padding-left: 9px; }
        .pl-10 { padding-left: 10px; }
        .pl-11 { padding-left: 11px; }
        .pl-12 { padding-left: 12px; }
        .pl-13 { padding-left: 13px; }
        .pl-14 { padding-left: 14px; }
        .pl-15 { padding-left: 15px; }
        .pl-16 { padding-left: 16px; }
        .pl-17 { padding-left: 17px; }
        .pl-18 { padding-left: 18px; }
        .pl-19 { padding-left: 19px; }
        .pl-20 { padding-left: 20px; }
        .pl-21 { padding-left: 21px; }
        .pl-22 { padding-left: 22px; }
        .pl-23 { padding-left: 23px; }
        .pl-24 { padding-left: 24px; }
        .pl-25 { padding-left: 25px; }
        .pl-26 { padding-left: 26px; }
        .pl-27 { padding-left: 27px; }
        .pl-28 { padding-left: 28px; }
        .pl-29 { padding-left: 29px; }
        .pl-30 { padding-left: 30px; }
        .pl-40 { padding-left: 40px; }
        .pl-50 { padding-left: 50px; }
        .pl-60 { padding-left: 60px; }
        .pl-70 { padding-left: 70px; }
        .pl-80 { padding-left: 80px; }
        .pl-90 { padding-left: 90px; }
        .pl-100 { padding-left: 100px; }

        .pr-0 { padding-right: 0px; }
        .pr-1 { padding-right: 1px; }
        .pr-2 { padding-right: 2px; }
        .pr-3 { padding-right: 3px; }
        .pr-4 { padding-right: 4px; }
        .pr-5 { padding-right: 5px; }
        .pr-6 { padding-right: 6px; }
        .pr-7 { padding-right: 7px; }
        .pr-8 { padding-right: 8px; }
        .pr-9 { padding-right: 9px; }
        .pr-10 { padding-right: 10px; }
        .pr-11 { padding-right: 11px; }
        .pr-12 { padding-right: 12px; }
        .pr-13 { padding-right: 13px; }
        .pr-14 { padding-right: 14px; }
        .pr-15 { padding-right: 15px; }
        .pr-16 { padding-right: 16px; }
        .pr-17 { padding-right: 17px; }
        .pr-18 { padding-right: 18px; }
        .pr-19 { padding-right: 19px; }
        .pr-20 { padding-right: 20px; }
        .pr-21 { padding-right: 21px; }
        .pr-22 { padding-right: 22px; }
        .pr-23 { padding-right: 23px; }
        .pr-24 { padding-right: 24px; }
        .pr-25 { padding-right: 25px; }
        .pr-26 { padding-right: 26px; }
        .pr-27 { padding-right: 27px; }
        .pr-28 { padding-right: 28px; }
        .pr-29 { padding-right: 29px; }
        .pr-30 { padding-right: 30px; }
        .pr-40 { padding-right: 40px; }
        .pr-50 { padding-right: 50px; }
        .pr-60 { padding-right: 60px; }
        .pr-70 { padding-right: 70px; }
        .pr-80 { padding-right: 80px; }
        .pr-90 { padding-right: 90px; }
        .pr-100 { padding-right: 100px; }

        .px-0 { padding-left: 0px;  padding-right: 0px; }
        .px-1 { padding-left: 1px;  padding-right: 1px; }
        .px-2 { padding-left: 2px;  padding-right: 2px; }
        .px-3 { padding-left: 3px;  padding-right: 3px; }
        .px-4 { padding-left: 4px;  padding-right: 4px; }
        .px-5 { padding-left: 5px;  padding-right: 5px; }
        .px-6 { padding-left: 6px;  padding-right: 6px; }
        .px-7 { padding-left: 7px;  padding-right: 7px; }
        .px-8 { padding-left: 8px;  padding-right: 8px; }
        .px-9 { padding-left: 9px;  padding-right: 9px; }
        .px-10 { padding-left: 10px;  padding-right: 10px; }
        .px-11 { padding-left: 11px;  padding-right: 11px; }
        .px-12 { padding-left: 12px;  padding-right: 12px; }
        .px-13 { padding-left: 13px;  padding-right: 13px; }
        .px-14 { padding-left: 14px;  padding-right: 14px; }
        .px-15 { padding-left: 15px;  padding-right: 15px; }
        .px-16 { padding-left: 16px;  padding-right: 16px; }
        .px-17 { padding-left: 17px;  padding-right: 17px; }
        .px-18 { padding-left: 18px;  padding-right: 18px; }
        .px-19 { padding-left: 19px;  padding-right: 19px; }
        .px-20 { padding-left: 20px;  padding-right: 20px; }
        .px-21 { padding-left: 21px;  padding-right: 21px; }
        .px-22 { padding-left: 22px;  padding-right: 22px; }
        .px-23 { padding-left: 23px;  padding-right: 23px; }
        .px-24 { padding-left: 24px;  padding-right: 24px; }
        .px-25 { padding-left: 25px;  padding-right: 25px; }
        .px-26 { padding-left: 26px;  padding-right: 26px; }
        .px-27 { padding-left: 27px;  padding-right: 27px; }
        .px-28 { padding-left: 28px;  padding-right: 28px; }
        .px-29 { padding-left: 29px;  padding-right: 29px; }
        .px-30 { padding-left: 30px;  padding-right: 30px; }
        .px-40 { padding-left: 40px;  padding-right: 40px; }
        .px-50 { padding-left: 50px;  padding-right: 50px; }
        .px-60 { padding-left: 60px;  padding-right: 60px; }
        .px-70 { padding-left: 70px;  padding-right: 70px; }
        .px-80 { padding-left: 80px;  padding-right: 80px; }
        .px-90 { padding-left: 90px;  padding-right: 90px; }
        .px-100 { padding-left: 100px;  padding-right: 100px; }

        .py-0 { padding-top: 0px;  padding-bottom: 0px; }
        .py-1 { padding-top: 1px;  padding-bottom: 1px; }
        .py-2 { padding-top: 2px;  padding-bottom: 2px; }
        .py-3 { padding-top: 3px;  padding-bottom: 3px; }
        .py-4 { padding-top: 4px;  padding-bottom: 4px; }
        .py-5 { padding-top: 5px;  padding-bottom: 5px; }
        .py-6 { padding-top: 6px;  padding-bottom: 6px; }
        .py-7 { padding-top: 7px;  padding-bottom: 7px; }
        .py-8 { padding-top: 8px;  padding-bottom: 8px; }
        .py-9 { padding-top: 9px;  padding-bottom: 9px; }
        .py-10 { padding-top: 10px;  padding-bottom: 10px; }
        .py-11 { padding-top: 11px;  padding-bottom: 11px; }
        .py-12 { padding-top: 12px;  padding-bottom: 12px; }
        .py-13 { padding-top: 13px;  padding-bottom: 13px; }
        .py-14 { padding-top: 14px;  padding-bottom: 14px; }
        .py-15 { padding-top: 15px;  padding-bottom: 15px; }
        .py-16 { padding-top: 16px;  padding-bottom: 16px; }
        .py-17 { padding-top: 17px;  padding-bottom: 17px; }
        .py-18 { padding-top: 18px;  padding-bottom: 18px; }
        .py-19 { padding-top: 19px;  padding-bottom: 19px; }
        .py-20 { padding-top: 20px;  padding-bottom: 20px; }
        .py-21 { padding-top: 21px;  padding-bottom: 21px; }
        .py-22 { padding-top: 22px;  padding-bottom: 22px; }
        .py-23 { padding-top: 23px;  padding-bottom: 23px; }
        .py-24 { padding-top: 24px;  padding-bottom: 24px; }
        .py-25 { padding-top: 25px;  padding-bottom: 25px; }
        .py-26 { padding-top: 26px;  padding-bottom: 26px; }
        .py-27 { padding-top: 27px;  padding-bottom: 27px; }
        .py-28 { padding-top: 28px;  padding-bottom: 28px; }
        .py-29 { padding-top: 29px;  padding-bottom: 29px; }
        .py-30 { padding-top: 30px;  padding-bottom: 30px; }
        .py-40 { padding-top: 40px;  padding-bottom: 40px; }
        .py-50 { padding-top: 50px;  padding-bottom: 50px; }
        .py-60 { padding-top: 60px;  padding-bottom: 60px; }
        .py-70 { padding-top: 70px;  padding-bottom: 70px; }
        .py-80 { padding-top: 80px;  padding-bottom: 80px; }
        .py-90 { padding-top: 90px;  padding-bottom: 90px; }
        .py-100 { padding-top: 100px;  padding-bottom: 100px; }

        .m-0 { margin: 0px; }
        .m-1 { margin: 1px; }
        .m-2 { margin: 2px; }
        .m-3 { margin: 3px; }
        .m-4 { margin: 4px; }
        .m-5 { margin: 5px; }
        .m-6 { margin: 6px; }
        .m-7 { margin: 7px; }
        .m-8 { margin: 8px; }
        .m-9 { margin: 9px; }
        .m-10 { margin: 10px; }
        .m-11 { margin: 11px; }
        .m-12 { margin: 12px; }
        .m-13 { margin: 13px; }
        .m-14 { margin: 14px; }
        .m-15 { margin: 15px; }
        .m-16 { margin: 16px; }
        .m-17 { margin: 17px; }
        .m-18 { margin: 18px; }
        .m-19 { margin: 19px; }
        .m-20 { margin: 20px; }
        .m-21 { margin: 21px; }
        .m-22 { margin: 22px; }
        .m-23 { margin: 23px; }
        .m-24 { margin: 24px; }
        .m-25 { margin: 25px; }
        .m-26 { margin: 26px; }
        .m-27 { margin: 27px; }
        .m-28 { margin: 28px; }
        .m-29 { margin: 29px; }
        .m-30 { margin: 30px; }
        .m-40 { margin: 40px; }
        .m-50 { margin: 50px; }
        .m-60 { margin: 60px; }
        .m-70 { margin: 70px; }
        .m-80 { margin: 80px; }
        .m-90 { margin: 90px; }
        .m-100 { margin: 100px; }

        .mt-0 { margin-top: 0px; }
        .mt-1 { margin-top: 1px; }
        .mt-2 { margin-top: 2px; }
        .mt-3 { margin-top: 3px; }
        .mt-4 { margin-top: 4px; }
        .mt-5 { margin-top: 5px; }
        .mt-6 { margin-top: 6px; }
        .mt-7 { margin-top: 7px; }
        .mt-8 { margin-top: 8px; }
        .mt-9 { margin-top: 9px; }
        .mt-10 { margin-top: 10px; }
        .mt-11 { margin-top: 11px; }
        .mt-12 { margin-top: 12px; }
        .mt-13 { margin-top: 13px; }
        .mt-14 { margin-top: 14px; }
        .mt-15 { margin-top: 15px; }
        .mt-16 { margin-top: 16px; }
        .mt-17 { margin-top: 17px; }
        .mt-18 { margin-top: 18px; }
        .mt-19 { margin-top: 19px; }
        .mt-20 { margin-top: 20px; }
        .mt-21 { margin-top: 21px; }
        .mt-22 { margin-top: 22px; }
        .mt-23 { margin-top: 23px; }
        .mt-24 { margin-top: 24px; }
        .mt-25 { margin-top: 25px; }
        .mt-26 { margin-top: 26px; }
        .mt-27 { margin-top: 27px; }
        .mt-28 { margin-top: 28px; }
        .mt-29 { margin-top: 29px; }
        .mt-30 { margin-top: 30px; }
        .mt-40 { margin-top: 40px; }
        .mt-50 { margin-top: 50px; }
        .mt-60 { margin-top: 60px; }
        .mt-70 { margin-top: 70px; }
        .mt-80 { margin-top: 80px; }
        .mt-90 { margin-top: 90px; }
        .mt-100 { margin-top: 100px; }

        .mb-0 { margin-bottom: 0px; }
        .mb-1 { margin-bottom: 1px; }
        .mb-2 { margin-bottom: 2px; }
        .mb-3 { margin-bottom: 3px; }
        .mb-4 { margin-bottom: 4px; }
        .mb-5 { margin-bottom: 5px; }
        .mb-6 { margin-bottom: 6px; }
        .mb-7 { margin-bottom: 7px; }
        .mb-8 { margin-bottom: 8px; }
        .mb-9 { margin-bottom: 9px; }
        .mb-10 { margin-bottom: 10px; }
        .mb-11 { margin-bottom: 11px; }
        .mb-12 { margin-bottom: 12px; }
        .mb-13 { margin-bottom: 13px; }
        .mb-14 { margin-bottom: 14px; }
        .mb-15 { margin-bottom: 15px; }
        .mb-16 { margin-bottom: 16px; }
        .mb-17 { margin-bottom: 17px; }
        .mb-18 { margin-bottom: 18px; }
        .mb-19 { margin-bottom: 19px; }
        .mb-20 { margin-bottom: 20px; }
        .mb-21 { margin-bottom: 21px; }
        .mb-22 { margin-bottom: 22px; }
        .mb-23 { margin-bottom: 23px; }
        .mb-24 { margin-bottom: 24px; }
        .mb-25 { margin-bottom: 25px; }
        .mb-26 { margin-bottom: 26px; }
        .mb-27 { margin-bottom: 27px; }
        .mb-28 { margin-bottom: 28px; }
        .mb-29 { margin-bottom: 29px; }
        .mb-30 { margin-bottom: 30px; }
        .mb-40 { margin-bottom: 40px; }
        .mb-50 { margin-bottom: 50px; }
        .mb-60 { margin-bottom: 60px; }
        .mb-70 { margin-bottom: 70px; }
        .mb-80 { margin-bottom: 80px; }
        .mb-90 { margin-bottom: 90px; }
        .mb-100 { margin-bottom: 100px; }

        .ml-0 { margin-left: 0px; }
        .ml-1 { margin-left: 1px; }
        .ml-2 { margin-left: 2px; }
        .ml-3 { margin-left: 3px; }
        .ml-4 { margin-left: 4px; }
        .ml-5 { margin-left: 5px; }
        .ml-6 { margin-left: 6px; }
        .ml-7 { margin-left: 7px; }
        .ml-8 { margin-left: 8px; }
        .ml-9 { margin-left: 9px; }
        .ml-10 { margin-left: 10px; }
        .ml-11 { margin-left: 11px; }
        .ml-12 { margin-left: 12px; }
        .ml-13 { margin-left: 13px; }
        .ml-14 { margin-left: 14px; }
        .ml-15 { margin-left: 15px; }
        .ml-16 { margin-left: 16px; }
        .ml-17 { margin-left: 17px; }
        .ml-18 { margin-left: 18px; }
        .ml-19 { margin-left: 19px; }
        .ml-20 { margin-left: 20px; }
        .ml-21 { margin-left: 21px; }
        .ml-22 { margin-left: 22px; }
        .ml-23 { margin-left: 23px; }
        .ml-24 { margin-left: 24px; }
        .ml-25 { margin-left: 25px; }
        .ml-26 { margin-left: 26px; }
        .ml-27 { margin-left: 27px; }
        .ml-28 { margin-left: 28px; }
        .ml-29 { margin-left: 29px; }
        .ml-30 { margin-left: 30px; }
        .ml-40 { margin-left: 40px; }
        .ml-50 { margin-left: 50px; }
        .ml-60 { margin-left: 60px; }
        .ml-70 { margin-left: 70px; }
        .ml-80 { margin-left: 80px; }
        .ml-90 { margin-left: 90px; }
        .ml-100 { margin-left: 100px; }

        .mr-0 { margin-right: 0px; }
        .mr-1 { margin-right: 1px; }
        .mr-2 { margin-right: 2px; }
        .mr-3 { margin-right: 3px; }
        .mr-4 { margin-right: 4px; }
        .mr-5 { margin-right: 5px; }
        .mr-6 { margin-right: 6px; }
        .mr-7 { margin-right: 7px; }
        .mr-8 { margin-right: 8px; }
        .mr-9 { margin-right: 9px; }
        .mr-10 { margin-right: 10px; }
        .mr-11 { margin-right: 11px; }
        .mr-12 { margin-right: 12px; }
        .mr-13 { margin-right: 13px; }
        .mr-14 { margin-right: 14px; }
        .mr-15 { margin-right: 15px; }
        .mr-16 { margin-right: 16px; }
        .mr-17 { margin-right: 17px; }
        .mr-18 { margin-right: 18px; }
        .mr-19 { margin-right: 19px; }
        .mr-20 { margin-right: 20px; }
        .mr-21 { margin-right: 21px; }
        .mr-22 { margin-right: 22px; }
        .mr-23 { margin-right: 23px; }
        .mr-24 { margin-right: 24px; }
        .mr-25 { margin-right: 25px; }
        .mr-26 { margin-right: 26px; }
        .mr-27 { margin-right: 27px; }
        .mr-28 { margin-right: 28px; }
        .mr-29 { margin-right: 29px; }
        .mr-30 { margin-right: 30px; }
        .mr-40 { margin-right: 40px; }
        .mr-50 { margin-right: 50px; }
        .mr-60 { margin-right: 60px; }
        .mr-70 { margin-right: 70px; }
        .mr-80 { margin-right: 80px; }
        .mr-90 { margin-right: 90px; }
        .mr-100 { margin-right: 100px; }

        .mx-0 { margin-left: 0px;  margin-right: 0px; }
        .mx-1 { margin-left: 1px;  margin-right: 1px; }
        .mx-2 { margin-left: 2px;  margin-right: 2px; }
        .mx-3 { margin-left: 3px;  margin-right: 3px; }
        .mx-4 { margin-left: 4px;  margin-right: 4px; }
        .mx-5 { margin-left: 5px;  margin-right: 5px; }
        .mx-6 { margin-left: 6px;  margin-right: 6px; }
        .mx-7 { margin-left: 7px;  margin-right: 7px; }
        .mx-8 { margin-left: 8px;  margin-right: 8px; }
        .mx-9 { margin-left: 9px;  margin-right: 9px; }
        .mx-10 { margin-left: 10px;  margin-right: 10px; }
        .mx-11 { margin-left: 11px;  margin-right: 11px; }
        .mx-12 { margin-left: 12px;  margin-right: 12px; }
        .mx-13 { margin-left: 13px;  margin-right: 13px; }
        .mx-14 { margin-left: 14px;  margin-right: 14px; }
        .mx-15 { margin-left: 15px;  margin-right: 15px; }
        .mx-16 { margin-left: 16px;  margin-right: 16px; }
        .mx-17 { margin-left: 17px;  margin-right: 17px; }
        .mx-18 { margin-left: 18px;  margin-right: 18px; }
        .mx-19 { margin-left: 19px;  margin-right: 19px; }
        .mx-20 { margin-left: 20px;  margin-right: 20px; }
        .mx-21 { margin-left: 21px;  margin-right: 21px; }
        .mx-22 { margin-left: 22px;  margin-right: 22px; }
        .mx-23 { margin-left: 23px;  margin-right: 23px; }
        .mx-24 { margin-left: 24px;  margin-right: 24px; }
        .mx-25 { margin-left: 25px;  margin-right: 25px; }
        .mx-26 { margin-left: 26px;  margin-right: 26px; }
        .mx-27 { margin-left: 27px;  margin-right: 27px; }
        .mx-28 { margin-left: 28px;  margin-right: 28px; }
        .mx-29 { margin-left: 29px;  margin-right: 29px; }
        .mx-30 { margin-left: 30px;  margin-right: 30px; }
        .mx-40 { margin-left: 40px;  margin-right: 40px; }
        .mx-50 { margin-left: 50px;  margin-right: 50px; }
        .mx-60 { margin-left: 60px;  margin-right: 60px; }
        .mx-70 { margin-left: 70px;  margin-right: 70px; }
        .mx-80 { margin-left: 80px;  margin-right: 80px; }
        .mx-90 { margin-left: 90px;  margin-right: 90px; }
        .mx-100 { margin-left: 100px;  margin-right: 100px; }

        .my-0 { margin-top: 0px;  margin-bottom: 0px; }
        .my-1 { margin-top: 1px;  margin-bottom: 1px; }
        .my-2 { margin-top: 2px;  margin-bottom: 2px; }
        .my-3 { margin-top: 3px;  margin-bottom: 3px; }
        .my-4 { margin-top: 4px;  margin-bottom: 4px; }
        .my-5 { margin-top: 5px;  margin-bottom: 5px; }
        .my-6 { margin-top: 6px;  margin-bottom: 6px; }
        .my-7 { margin-top: 7px;  margin-bottom: 7px; }
        .my-8 { margin-top: 8px;  margin-bottom: 8px; }
        .my-9 { margin-top: 9px;  margin-bottom: 9px; }
        .my-10 { margin-top: 10px;  margin-bottom: 10px; }
        .my-11 { margin-top: 11px;  margin-bottom: 11px; }
        .my-12 { margin-top: 12px;  margin-bottom: 12px; }
        .my-13 { margin-top: 13px;  margin-bottom: 13px; }
        .my-14 { margin-top: 14px;  margin-bottom: 14px; }
        .my-15 { margin-top: 15px;  margin-bottom: 15px; }
        .my-16 { margin-top: 16px;  margin-bottom: 16px; }
        .my-17 { margin-top: 17px;  margin-bottom: 17px; }
        .my-18 { margin-top: 18px;  margin-bottom: 18px; }
        .my-19 { margin-top: 19px;  margin-bottom: 19px; }
        .my-20 { margin-top: 20px;  margin-bottom: 20px; }
        .my-21 { margin-top: 21px;  margin-bottom: 21px; }
        .my-22 { margin-top: 22px;  margin-bottom: 22px; }
        .my-23 { margin-top: 23px;  margin-bottom: 23px; }
        .my-24 { margin-top: 24px;  margin-bottom: 24px; }
        .my-25 { margin-top: 25px;  margin-bottom: 25px; }
        .my-26 { margin-top: 26px;  margin-bottom: 26px; }
        .my-27 { margin-top: 27px;  margin-bottom: 27px; }
        .my-28 { margin-top: 28px;  margin-bottom: 28px; }
        .my-29 { margin-top: 29px;  margin-bottom: 29px; }
        .my-30 { margin-top: 30px;  margin-bottom: 30px; }
        .my-40 { margin-top: 40px;  margin-bottom: 40px; }
        .my-50 { margin-top: 50px;  margin-bottom: 50px; }
        .my-60 { margin-top: 60px;  margin-bottom: 60px; }
        .my-70 { margin-top: 70px;  margin-bottom: 70px; }
        .my-80 { margin-top: 80px;  margin-bottom: 80px; }
        .my-90 { margin-top: 90px;  margin-bottom: 90px; }
        .my-100 { margin-top: 100px;  margin-bottom: 100px; }

        .uppercase { text-transform: uppercase; }
        .capitalize { text-transform: capitalize; }
        .lowercase { text-transform: lowercase; }

        .underline { text-decoration: underline; }

        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .text-justify { text-align: justify; }

        .font-bold { font-weight: bold; }

        .text-10 { font-size: 10px; }
        .text-12 { font-size: 12px; }
        .text-13 { font-size: 13px; }
        .text-16 { font-size: 16px; }
        .text-18 { font-size: 18px; }
        .text-20 { font-size: 20px; }
        .text-22 { font-size: 22px; }
        .text-24 { font-size: 24px; }
        .text-28 { font-size: 28px; }
        .text-30 { font-size: 30px; }
        .text-32 { font-size: 32px; }

    </style>

</head>
<body class="p-60">

@yield('content')
    
</body>
</html>