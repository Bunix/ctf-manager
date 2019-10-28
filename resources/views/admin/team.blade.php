@extends('layouts.app')
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: #2d3238;">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Admin Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Teams</li>
                <li class="breadcrumb-item active" aria-current="page">{{$team->display_name}}</li>
            </ol>
        </nav>
        <div class="row justify-content-between">
            <div class="col-md-8">
                <img src="/storage/avatars/{{$team->avatar}}" class="float-left img-thumbnail mr-3" style="width: 150px">
                <div class="text-white ml-3">
                    <h1 class="display-3">{{$team->display_name}}</h1>
                </div>
                <div>
                    <button class="btn btn-outline-danger" onclick="if(confirm('Are you absolutely sure?')) deleteTeam()">Delete Team</button>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card bg-dark shadow">
                    <div class="card-body">
                        <h1 class="display-4 text-center">Box Progress</h1>
                        <table class="table table-dark text-center table-sm table-striped">
                            <thead>
                            <tr>
                                <th>Box</th>
                                <th>Progress</th>
                                <th>Score</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($progress as $row)
                                <tr>
                                    <td>{{$row['box']}}</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped {{$row['progress'] === 100 ? 'bg-success' : 'progress-bar-animated bg-danger'}}" role="progressbar" style="width: {{$row['progress']}}%"
                                                 aria-valuenow="{{$row['progress']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>{{$row['score']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card bg-dark shadow">
                    <div class="card-body">
                        <h1 class="display-4 text-center">Feed</h1>
                        <table class="table table-dark table-sm table-borderless table-striped">
                            <tbody>
                            @foreach($feed as $submission)
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <span><i data-feather="rss"></i> Flag no. {{$submission->level->flag_no}} was submitted by {{$team->display_name}} for {{$submission->level->points}} points. <span class="text-muted">{{$submission->created_at->diffForHumans()}}</span></span>
                                        <h4><span class="badge badge-danger">{{$submission->level->box->title}}</span></h4>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteTeam() {
            axios.delete('{{route('admin.delete.team',['id'=>$team->id])}}')
                .then(() => {
                    window.location = '{{route('admin.home')}}';
                }).catch(err => {
                toastr.error('Error');
                console.log(err);
            })
        }
    </script>
@endsection
