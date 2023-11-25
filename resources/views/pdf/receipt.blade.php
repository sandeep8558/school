@extends('layouts.pdf')

@section('head')
<title>Receipt</title>
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
            <td class="p-3 w-20 text-center font-bold uppercase">Payment Receipt</td>
        </tr>
    </tbody>
</table>

<table class="w-100 mb-10">
    <tbody>
        <tr class="">
            <td class="p-3 text-left">Receipt ID : {{ $receipt->id }}</td>
            <td class="p-3 text-right">Date : {{ date_format($receipt->created_at, 'd-m-Y') }}</td>
        </tr>
    </tbody>
</table>

<table class="w-100 border">
    <thead>
        <tr>
            <th class="border px-5 py-10 text-left">Particular</th>
            <th class="border px-5 py-10 w-25">Amount</th>
        </tr>
    </thead>
    <tbody class="border block" style="height:150px;">
        @foreach($receipt->razorpay_data as $rd)
        <tr>
            <td style="height:22px;" class="p-5">{{ $rd->obligation }}</td>
            <td style="height:22px;" class="p-5 text-right border-l">{{ number_format((float)($rd->amount),2,'.') }}</td>
        </tr>
        @endforeach
        <tr>
            <td style="height:{{ 25 * (6 - (sizeof($receipt->razorpay_data))) }}px;" class="p-5"></td>
            <td class="p-5 text-right border-l"></td>
        </tr>
    </tbody>

    <tbody>
        <tr>
            <td class="p-5">Total</td>
            <td class="p-5 text-right">{{ number_format((float)($receipt->amount),2,'.') }}</td>
        </tr>
    </tbody>

</table>

<table class="w-100">
    <tbody>
        <tr>
            <td class="border text-center p-5">
                This is the system generated copy.
            </td>
        </tr>
    </tbody>
</table>

@endsection