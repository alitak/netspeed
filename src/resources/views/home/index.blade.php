@extends('layout.base')

@section('content')
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
@endsection

@section('jquery')
@if (false) <script> @endif
            Highcharts.chart('container', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'Packet loss statistics'
                },
                xAxis: {
                    type: 'datetime',
                    title: {
                        text: 'dátum'
                    }
                },
                yAxis: {
                    title: {
                        text: 'packet loss (%)'
                    },
                    min: 0
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: '{point.x:%e. %b}: {point.y}%'
                },

                plotOptions: {
                    spline: {
                        marker: {
                            enabled: true
                        }
                    }
                },

                colors: ['#6CF', '#39F', '#06C', '#036', '#000'],
series: [
    @foreach ($ping_data as $server => $datas)
    {
        name: "{{ $server }}",
        data:   [
            @foreach ($datas as $pd)
        [{{ $pd['created_at'] }}, {{ $pd['packet_loss'] }}],
            @endforeach
    ],
    },
    @endforeach
]
            })
    @if (false)</script> @endif
@endsection