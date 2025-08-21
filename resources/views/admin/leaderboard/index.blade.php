@extends('admin.layouts.app')

@section('content')
<div class="container main-content side-content pt-5" style="margin-left: 20em;">
    <h2 class="mb-4">Leaderboard</h2>

    <table class="table table-bordered" style="">
        <thead>
            <tr>
                <th>#</th>
                <th>User ID</th>
                <th>Score</th>
                <th>Time Taken (sec)</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($scores as $index => $score)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $score->user_id }}</td>
                <td>{{ $score->score }}</td>
                <td>{{ $score->time_taken }}</td>
                <td>{{ $score->created_at->format('d M Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
