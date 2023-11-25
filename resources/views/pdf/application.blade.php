@extends('layouts.pdf')

@section('head')
<title>Demo</title>
@endsection


@section('content')

<table class="w-100">
    <tbody>
        <tr class="">
            <td class="text-20 uppercase font-bold text-center">
                {{ $ap->branch->name }}
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
            <td class="p-3 w-20 text-center font-bold">Admission form for AY : {{ $ap->academic_year->name }} - {{ $ap->grade->name }}</td>
        </tr>
    </tbody>
</table>

<table class="w-100 mb-10">
    <tbody>
        <tr class="">
            <td class="p-3 text-left">Application ID : {{ $ap->id }}</td>
            <td class="p-3 text-right">Date : {{ date_format($ap->created_at, 'd-m-Y') }}</td>
        </tr>
    </tbody>
</table>

<table class="w-100">

    <tbody>
        <tr>
            <td class="border text-14 p-3 w-20">Name</td>
            <td class="border text-14 p-3">{{ $ap->first_name }} {{ $ap->middle_name }} {{ $ap->last_name }}</td>
            <td class="border text-14 p-3 w-15" rowspan="4">
                <img class="w-100" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($ap->admission_photos[0]->media))) }}">
            </td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Contact</td>
            <td class="border text-14 p-3">{{ $ap->phone }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Email</td>
            <td class="border text-14 p-3">{{ $ap->email }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Address</td>
            <td class="border text-14 p-3">{{ $ap->admission_addresses[0]->address }} {{ $ap->admission_addresses[0]->city }} {{ $ap->admission_addresses[0]->pincode }} {{ $ap->admission_addresses[0]->state }} {{ $ap->admission_addresses[0]->country }}</td>
        </tr>
    </tbody>

</table>

<table class="w-100">

    <tbody>
        <tr>
            <th class="uppercase w-100 pt-15 pb-5 text-left" colspan="4">Personal Details</th>
        </tr>
    </tbody>

    <tbody>
        <tr>
            <td class="border text-14 p-3 w-20">Gender</td>
            <td class="border text-14 p-3">{{ $ap->gender }}</td>
            <td class="border text-14 p-3 w-20">Alumnus</td>
            <td class="border text-14 p-3">{{ $ap->is_alumnus }}</td>
        </tr>
        
        <tr>
            <td class="border text-14 p-3 w-20">Date of Birth</td>
            <td class="border text-14 p-3">{{ $ap->dob }}</td>
            <td class="border text-14 p-3 w-20">Birth Place</td>
            <td class="border text-14 p-3">{{ $ap->birth_place }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Blood Group</td>
            <td class="border text-14 p-3">{{ $ap->blood_group }}</td>
            <td class="border text-14 p-3 w-20">Mother Tongue</td>
            <td class="border text-14 p-3">{{ $ap->mothertongue }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Nationality</td>
            <td class="border text-14 p-3">{{ $ap->nationality }}</td>
            <td class="border text-14 p-3 w-20">Aadhar Number</td>
            <td class="border text-14 p-3">{{ $ap->aadhar }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Religion</td>
            <td class="border text-14 p-3">{{ $ap->religion }}</td>
            <td class="border text-14 p-3 w-20">Cast Category</td>
            <td class="border text-14 p-3">{{ $ap->cast_category }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Cast</td>
            <td class="border text-14 p-3">{{ $ap->cast }}</td>
            <td class="border text-14 p-3 w-20">Sub-cast</td>
            <td class="border text-14 p-3">{{ $ap->subcast }}</td>
        </tr>

        <tr>
            <td class="border text-14 p-3 w-20">Single Parent</td>
            <td class="border text-14 p-3" colspan="3">{{ $ap->is_single_parent }}</td>
        </tr>

    </tbody>

    <tbody>
        <tr>
            <th class="uppercase w-100 pt-15 pb-5 text-left" colspan="4">Language Selection</th>
        </tr>
    </tbody>

    <tbody>
        <tr>
            <td class="border text-14 p-3 w-20">First Language</td>
            <td class="border text-14 p-3" colspan="3">{{ $ap->first_language->language }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Second Language</td>
            <td class="border text-14 p-3" colspan="3">{{ $ap->second_language->language }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Third Language</td>
            <td class="border text-14 p-3" colspan="3">{{ $ap->third_language->language }}</td>
        </tr>
    </tbody>

    <tbody>
        <tr>
            <th class="uppercase w-100 pt-15 pb-5 text-left" colspan="4">Other Information</th>
        </tr>
    </tbody>

    <tbody>

        <tr>
            <td class="border text-14 p-3" colspan="4">Has your child ever had trouble speaking or hearing? - {{ $ap->speaking_hearing }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3" colspan="4">Does your child have special education needed? - {{ $ap->special_need }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Previous School</td>
            <td class="border text-14 p-3 font-bold" colspan="3">{{ $ap->previous_school }} - {{ $ap->board }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Sibling GR</td>
            <td class="border text-14 p-3 font-bold" colspan="3">
                @foreach($ap->admission_siblings as $sib)
                    <span>{{ $sib->gr_number }}</span>
                @endforeach
            </td>
        </tr>

    </tbody>

</table>

@foreach($ap->admission_parents as $i=>$p)

@if($i == 1)
<div class="page-break"></div>
@endif

<table class="w-100">

    <tbody>
        <tr>
            <th class="uppercase text-14 font-bold pt-15 pb-5 text-left" colspan="4">{{ $p->relation }}'s Details</th>
        </tr>
    </tbody>
    <tbody>
        
        <tr>
            <td class="border text-14 p-3 w-20">{{ $p->relation }}'s Name</td>
            <td class="border text-14 p-3">{{ $p->first_name }} {{ $p->middle_name }} {{ $p->last_name }}</td>
            <td class="border text-14 p-3 w-20">Email</td>
            <td class="border text-14 p-3">{{ $p->email }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Mobile</td>
            <td class="border text-14 p-3">{{ $p->phone }}</td>
            <td class="border text-14 p-3 w-20">Date of Birth</td>
            <td class="border text-14 p-3">{{ $p->dob }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Aadhar Number</td>
            <td class="border text-14 p-3">{{ $p->aadhar }}</td>
            <td class="border text-14 p-3 w-20">PAN</td>
            <td class="border text-14 p-3">{{ $p->pan }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Qualification</td>
            <td class="border text-14 p-3">{{ $p->qualification }}</td>
            <td class="border text-14 p-3 w-20">Degree</td>
            <td class="border text-14 p-3">{{ $p->degree }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Occupation</td>
            <td class="border text-14 p-3">{{ $p->occupation }}</td>
            <td class="border text-14 p-3 w-20">Annual Income</td>
            <td class="border text-14 p-3">{{ $p->annual_income }}</td>
        </tr>
        <tr>
            <td class="border text-14 p-3 w-20">Company Name</td>
            <td class="border text-14 p-3">{{ $p->company_name }}</td>
            <td class="border text-14 p-3 w-20">Company Address</td>
            <td class="border text-14 p-3">{{ $p->company_address }}</td>
        </tr>
    </tbody>
    
</table>
@endforeach

<table class="w-100 mt-15">
    <tbody>
        <tr>
            <td class="border text-center p-10">
                This is the system generated copy.
            </td>
        </tr>
    </tbody>
</table>

@endsection