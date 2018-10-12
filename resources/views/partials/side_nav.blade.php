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
            <li class="treeview {{
                $route=='category.index' || $route == 'category.create' || $route == 'category.edit'
                ||$route=='news.index' || $route == 'news.create' || $route == 'news.edit' || $route == 'news.view'
            ?'active':''}}">
                <a href="#">
                  <i class="fa fa-envelope"></i> <span>News Portal</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{$route=='category.index' || $route=='category.create' || $route=='category.edit' ?'active':''}}"><a href="{{route('category.index')}}"><i class="fa fa-angle-double-right"></i> <span>Category</span></a></li>
                    <li class="{{$route=='news.index' || $route=='news.create' || $route=='news.edit' || $route=='news.view' ?'active':'' }}"><a href="{{route('news.index')}}"><i class="fa fa-angle-double-right"></i> <span>News</span></a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>