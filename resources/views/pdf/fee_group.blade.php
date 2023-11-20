@extends('layouts.pdf')

@section('head')
<title>Fee Group</title>
@endsection


@section('content')

@include('layouts.letter_head')

<h2 class="pt-40 text-center underline">{{ $fee_group->name }} for AY {{ $fee_group->academic_year->name }}</h2>

<p class="text-center pb-40">
    Grades - 
    @foreach($fee_group->fee_group_grades as $i=>$grade)
        {{$grade->grade->name}}{{ sizeof($fee_group->fee_group_grades) == ($i+1) ? '' : ',' }}
    @endforeach
</p>


<table class="border w-100">

    <tbody>
        <tr>
            <td class="border p-5">Application Fee</td>
            <td class="border p-5 w-25">Rs. {{$fee_group->application_fee}}/-</td>
        </tr>
        <tr>
            <td class="border p-5">Admission Fee</td>
            <td class="border p-5 w-25">Rs. {{$fee_group->admission_fee}}/-</td>
        </tr>

        @if($fee_group->deposit > 0)
        <tr>
            <td class="border p-5">Security Deposit</td>
            <td class="border p-5 w-25">Rs. {{$fee_group->deposit}}/-</td>
        </tr>
        @endif

        @foreach($fee_group->fee_group_parameters as $param)
        <tr>
            <td class="border p-5">{{$param->param}} (Rs. {{$param->per_month_fee}}/Month)</td>
            <td class="border p-5 w-25">Rs. {{$param->per_year_fee}}/-</td>
        </tr>
        @endforeach

        @foreach($fee_group->fee_group_installments as $insta)
        <tr>
            <td class="border p-5">{{$insta->name}} payable on or before {{$insta->due_date}}</td>
            <td class="border p-5 w-25">Rs. {{$insta->amount}}/-</td>
        </tr>
        @endforeach

        <tr>
            <td class="border p-5">Late Fee</td>
            <td class="border p-5 w-25">Rs. {{$fee_group->fee_group_Late_fee->amount}} per {{$fee_group->fee_group_Late_fee->per}}</td>
        </tr>

    </tbody>

</table>

<p class="py-10">
    At the time of admission,
    @foreach($fee_group->payable_at_admission as $inst)
    {{ $inst->name }},
    @endforeach
    {{ $fee_group->deposit == 0 ? 'and Admission Fee have to be paid.' : 'Caution Money Deposit and Admission Fee have to be paid.' }}
</p>

    
@endsection

