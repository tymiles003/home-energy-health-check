@extends('master')

@section('content')
    <nav class="navbar navbar-expand-md fixed-top admin-navbar">
        <div class="container">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    {{ link_to_route('reports.index', 'Reports', [], [
                        'class' => 'nav-link'
                    ]) }}
                </li>
                <li class="nav-item">
                    {{ link_to_route('improvements.index', 'Improvements', [], [
                        'class' => 'nav-link'
                    ]) }}
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url(config('backpack.base.route_prefix', 'admin') . '/elfinder') }}">File manager</a>
                </li>
            </ul>
        </div>
    </nav>
@endsection
