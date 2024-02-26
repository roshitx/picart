@extends('layouts.main')
@section('content')
<div class="container">
    <div class="main-body">
        <h3>Traffic</h3>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div id="stats"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    const postTraffic = Highcharts.chart('stats', {
        chart: {
            type: 'area',
            styledMode: true
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Post Uploaded, Comments Posted, and Likes Counted'
        },
        subtitle: {
            text: 'Data in ' + new Date().getFullYear()
        },
        xAxis: {
            categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            accessibility: {
                rangeDescription: 'Range from January to December.'
            }
        },
        yAxis: {
            title: {
                text: 'Total'
            },
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        series: [{
                    name: 'Photos posted',
                    data: {!! json_encode($photoData) !!}
                }, {
                    name: 'Comments posted',
                    data: {!! json_encode($commentData) !!}
                },{
                    name: 'Like counted',
                    data: {!! json_encode($likeData) !!}
                }]
    });
});
</script>
@endsection
