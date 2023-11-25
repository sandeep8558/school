@extends('layouts.pdf')

@section('head')
<title>Merit List</title>
@endsection


@section('content')

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
            <td class="p-3 w-20 text-center font-bold uppercase">Merit List - {{ $grade }}</td>
        </tr>
    </tbody>
</table>

<table class="w-100">
    <thead>
        <tr>
            <th class="border py-8 w-10">ID</th>
            <th class="border py-8 w-30">Name</th>
            <th class="border py-8 w-30">Email</th>
            <th class="border py-8 w-15">Mobile</th>
            <th class="border py-8 w-15">Rating</th>
        </tr>
    </thead>

    <tbody>
        @foreach($apps as $ap)
        <tr>
            <td class="border p-5 text-center">{{ $ap->id }}</td>
            <td class="border p-5 text-center">{{ $ap->first_name }} {{ $ap->middle_name }} {{ $ap->last_name }}</td>
            <td class="border p-5 text-center">{{ $ap->email }}</td>
            <td class="border p-5 text-center">{{ $ap->phone }}</td>
            <td class="border p-5 text-center">{{ $ap->total_rating }}</td>
        </tr>
        @endforeach
    </tbody>

</table>

@endsection