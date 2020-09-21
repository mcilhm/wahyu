
        <!-- ===== Left-Sidebar ===== -->
        <aside class="sidebar">
            <div class="scroll-sidebar">
                <div class="user-profile">
                    <div class="dropdown user-pro-body">
                        <div class="profile-image">
                            <img src="../plugins/images/users/hanna.jpg" alt="user-img" class="img-circle">
                            <a class="dropdown-toggle u-dropdown text-blue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="badge badge-danger">
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </a>
                        </div>
                        <p class="profile-text m-t-15 font-16"><a href="javascript:void(0);"> Administrator</a></p>
                    </div>
                </div>
                <nav class="sidebar-nav">
                    <ul id="side-menu">
                    @if(Auth::user()->user_type == 0)
                        <li>
                            <a href="{{ url('home') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Home</span></a>
                        </li>
                        <li>
                            <a href="{{ url('division') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Division</span></a>
                        </li>
                        <li>
                            <a href="{{ url('department') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Department</span></a>
                        </li>
                        <li>
                            <a href="{{ url('section') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Section</span></a>
                        </li>
                        <li>
                            <a href="{{ url('employee') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Employee</span></a>
                        </li>
                        <li>
                            <a href="{{ url('user') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> User</span></a>
                        </li>
                        <li>
                            <a href="{{ url('education') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Education</span></a>
                        </li>
                        <li>
                            <a href="{{ url('position') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Position</span></a>
                        </li>
                        <li>
                            <a href="{{ url('kelas') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Kelas</span></a>
                        </li>
                        <li>
                            <a href="{{ url('role') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Role</span></a>
                        </li>
                        <li>
                            <a href="{{ url('activity') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Activity</span></a>
                        </li>
                    @elseif(Auth::user()->user_type == 1)
                        @php
                        $menu = \App\Activity::all();
                        @endphp

                        @foreach($menu as $row)
                        <li>
                            <a href="{{ url('submission/'.$row->id) }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> {{ $row->activity_name }}</span></a>
                        </li>
                        @endforeach
                    @endif

                    </ul>
                </nav>
                <div class="p-30">
                    <span class="hide-menu">
                        <a href="{{ url('logout') }}" class="btn btn-default">Logout</a>
                    </span>
                </div>
            </div>
        </aside>
        <!-- ===== Left-Sidebar-End ===== -->
