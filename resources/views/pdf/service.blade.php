@extends('layouts.pdf')

@section('head')
<title>Service</title>
@endsection


@section('content')

@include('layouts.letter_head')

<h3 class="py-40 text-center">{{ $service->name }} - {{ $service->academic_year->name }} ({{ $service->is_compulsory == 'Yes' ? 'Compulsory' : 'Optional' }})</h3>

@foreach($service->service_items as $item)
<table class="w-100 mb-20">
    
    <thead>
        <tr>
            <th class="border p-5 text-left">{{ $item->name }}</th>
            <th class="border p-5 w-25 text-right">Rs. {{ $item->amount }}/-</th>
        </tr>
    </thead>

    <tbody>
        
        <tr>
            <td class="border p-5" colspan="2">
                Grades:
                @foreach($item->service_item_grades as $i=>$grade)
                {{ $grade->grade->name }}{{ sizeof($item->service_item_grades) == ($i + 1) ? '' : ', ' }}
                @endforeach
            </td>
        </tr>

        @foreach($item->service_item_installments as $i=>$emi)
        <tr>
            <td class="border p-5">{{ $emi->name }} payable on or before {{ $emi->due_date }}</td>
            <td class="border p-5 w-25 text-right">Rs. {{ $emi->amount }}/-</td>
        </tr>
        @endforeach

        <tr>
            <td class="border p-5" colspan="2">{{ $item->description }}</td>
        </tr>

    </tbody>

</table>
@endforeach

@endsection