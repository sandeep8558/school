@extends('layouts.pdf')

@section('head')
<title>Applications</title>
@endsection


@section('content')

<?php
function getItem($app, $col){
    $val = 'NA';
    switch($col){
        case "ID":
        $val = $app->id;
        break;
        case "Name":
        $val = $app->first_name .' '. $app->middle_name .' '. $app->last_name;
        break;
        case "Grade":
        $val = $app->grade->name;
        break;
        case "Email":
        $val = $app->email;
        break;
        case "Mobile":
        $val = $app->phone;
        break;
        case "DOB":
        $val = $app->dob;
        break;
        case "Gender":
        $val = $app->gender;
        break;
        case "Blood Group":
        $val = $app->blood_group;
        break;
        case "Religion":
        $val = $app->religion;
        break;
        case "Cast":
        $val = $app->cast;
        break;
        case "Sub-cast":
        $val = $app->subcast;
        break;
        case "Cast Category":
        $val = $app->cast_category;
        break;
        case "Mother Tongue":
        $val = $app->mothertongue;
        break;
        case "Nationality":
        $val = $app->nationality;
        break;
        case "Aadhar":
        $val = $app->aadhar;
        break;
        case "Single Parent":
        $val = $app->is_single_parent;
        break;
        case "Single":
        $val = $app->single_what;
        break;
        case "Alumnus":
        $val = $app->is_alumnus;
        break;
        case "Special Need":
        $val = $app->special_need;
        break;
        case "Speaking And Hearing":
        $val = $app->speaking_hearing;
        break;
        case "Rating":
        $val = $app->total_rating;
        break;
        case "Status":
        $val = $app->status;
        break;
        case "First Language":
        $val = $app->first_language->language;
        break;
        case "Second Language":
        $val = $app->second_language->language;
        break;
        case "Third Language":
        $val = $app->third_language->language;
        break;
        case "Previous School":
        $val = $app->previous_school . ' - ' . $app->board;
        break;
        case "Remark":
        $val = '';
        break;
    }
    return $val;
}

function getClass($col){
    $cl = '';
    switch($col){
        case "ID":
        $cl = 'text-center w-10';
        break;
        case "Name":
        $cl = 'text-left w-20';
        break;
        case "Grade":
        $cl = 'text-center w-10';
        break;
        case "Email":
        $cl = 'text-center w-10';
        break;
        case "Mobile":
        $cl = 'text-center w-10';
        break;
        case "DOB":
        $cl = 'text-center w-10';
        break;
        case "Gender":
        $cl = 'text-center w-10';
        break;
        case "Blood Group":
        $cl = 'text-center w-10';
        break;
        case "Religion":
        $cl = 'text-center w-10';
        break;
        case "Cast":
        $cl = 'text-center w-10';
        break;
        case "Sub-cast":
        $cl = 'text-center w-10';
        break;
        case "Cast Category":
        $cl = 'text-center w-10';
        break;
        case "Mother Tongue":
        $cl = 'text-center w-10';
        break;
        case "Nationality":
        $cl = 'text-center w-10';
        break;
        case "Aadhar":
        $cl = 'text-center w-10';
        break;
        case "Single Parent":
        $cl = 'text-center w-10';
        break;
        case "Single":
        $cl = 'text-center w-10';
        break;
        case "Alumnus":
        $cl = 'text-center w-10';
        break;
        case "Special Need":
        $cl = 'text-center w-10';
        break;
        case "Speaking And Hearing":
        $cl = 'text-center w-10';
        break;
        case "Rating":
        $cl = 'text-center w-10';
        break;
        case "Status":
        $cl = 'text-center w-10';
        break;
        case "First Language":
        $cl = 'text-center w-10';
        break;
        case "Second Language":
        $cl = 'text-center w-10';
        break;
        case "Third Language":
        $cl = 'text-center w-10';
        break;
        case "Previous School":
        $cl = 'text-center w-10';
        break;
        case "Remark":
        $cl = '';
        break;
    }
    return $cl;
}
?>

<table class="w-100 mb-20">
    <tbody>
        <tr class="">
            <td class="text-20 uppercase font-bold text-center">
                {{ $school_name }}
            </td>
        </tr>
        <tr class="">
            <td class="text-12 text-center">
                {{$address}} {{$city}} {{$pincode}} {{$state}} {{$country}}
            </td>
        </tr>
    </tbody>
</table>

<table class="w-100 mt-15 mb-20">
    <tbody>
        <tr class="">
            <td class="p-3 w-20 text-center font-bold uppercase">List of Applications</td>
        </tr>
    </tbody>
</table>

<table class="w-100">

    <thead>
        <tr>
            @foreach(explode(',', $cols) as $col)
            <th class="border px-5 py-10 text-14 uppercase {{getClass($col)}}">{{$col}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($applications as $app)
            <tr>
                @foreach(explode(',', $cols) as $col)
                <td class="border p-5 text-13 {{getClass($col)}}">{{ getItem($app, $col) }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
@endsection