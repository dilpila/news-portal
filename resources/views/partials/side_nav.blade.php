@php $route = Request::route()->getName() 
@endphp

<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{$route=='dashboard'?'active':''}}">
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            {{--<li class="treeview {{$route=='grade.index'||$route=='student.index'?'active':''}}">--}}
                {{--<a href="#">--}}
                  {{--<i class="fa fa-users"></i> <span>Student Management</span>--}}
                  {{--<span class="pull-right-container">--}}
                    {{--<i class="fa fa-angle-left pull-right"></i>--}}
                  {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li class="{{$route=='grade.index'?'active':''}}"><a href="{{route('grade.index')}}"><i class="fa fa-angle-double-right"></i> <span>Classes</span></a></li>--}}
                    {{--<li class="{{$route=='student.index'?'active':''}}"><a href="{{route('student.index')}}"><i class="fa fa-angle-double-right"></i> <span>Students</span></a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        </ul>
    </section>
</aside>