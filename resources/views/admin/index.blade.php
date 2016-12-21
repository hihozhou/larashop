@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-8 col-md-offset-2">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Dashboard</div>--}}

                    {{--<div class="panel-body">--}}
                        {{--You are logged in!--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div id="app">
        <div class="content-wrapper">
            {{--<section class="content-header">--}}
                {{--<h1>--}}
                    {{--Admin Panel--}}
                    {{--<small>Everything is here.</small>--}}
                {{--</h1>--}}
            {{--</section>--}}
            <router-view></router-view>
        </div>
    </div>
    {{--<example></example>--}}
@endsection