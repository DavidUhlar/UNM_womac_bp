@extends('layouts.app-master')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

@section('content')
    @auth





{{--hopa--}}
        @foreach($pacientiData as $pacient)

            <div class="exportZaznam">
                {{ $pacient->meno }} {{ $pacient->priezvisko }} {{ $pacient->rc }}
                <table>
                    <thead>
                    <tr>
                        <th>SAR_ID</th>
                        <th>typ</th>
                        <th>subtyp</th>
                        <th>zobraziť</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pacient->operacie as $operacia)
                        <tr>
                            <td>{{ $operacia->sar_id }}</td>
                            <td>{{ $operacia->typ }}</td>
                            <td>{{ $operacia->subtyp }}</td>
                            <td><a href="{{ route('export.operacia', $operacia->id) }}">Zobraz</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @endauth
@endsection
