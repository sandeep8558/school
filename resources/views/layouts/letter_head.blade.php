<table class="w-100">
    <tbody>
        <tr>
            <td class="w-10 p-10">
                <img class="w-100" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($logo))) }}" >
            </td>
            <td class="p-10">
                <h3 class="p-0 m-0 text-16 uppercase">{{$school_name}}</h3>
                <p class="p-0 m-0 text-12">{{$tag_line}}</p>
            </td>
            <td class="w-10 p-10 text-12 text-right">
            <p class="mb-5">{{$email_address}}</p>
            <p>{{$phone_number}}</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <hr>
            </td>
        </tr>
        <tr>
            <td class="text-12 py-5 text-center" colspan="3">
                <p>{{$address}} {{$city}} {{$pincode}} {{$state}} {{$country}}</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <hr>
            </td>
        </tr>
    </tbody>
</table>