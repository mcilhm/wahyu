@php
    $role = App\Role::where('id',Auth::user()->role_id)->first();
@endphp
        <!-- ===== Left-Sidebar ===== -->
        <aside class="sidebar">
            <div class="scroll-sidebar">
                <div class="user-profile">
                    <div class="dropdown user-pro-body">
                        <div class="profile-image">
                            <img src="../plugins/images/users/user.jpg" alt="user-img" class="img-circle">
                            <a class="dropdown-toggle u-dropdown text-blue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="badge badge-primary">
                                    <i class="fa fa-check"></i>
                                </span>
                            </a>
                        </div>
                        <p class="profile-text m-t-15 font-16">
                            <a href="javascript:void(0);">
                                @if (Auth::user()->user_type == 0)
                                    Administrator
                                @else
                                 {{ session('employee_name') }}
                                <br> {{ session('no_reg') }}
                                <br> {{ session('division_name') }}
                                @endif


                                @if ($role != null)
                                    <br>
                                    {{ $role->name }}
                                @endif
                            </a>
                        </p>
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

                            $employee = App\Employee::where('no_reg', Auth::user()->username)->first();
                            $age = Carbon\Carbon::parse($employee->date_of_birthday)->age;
                            $menu = \App\Activity::all();
                            @endphp

                            @if (Auth::user()->role_id == 1)
                                @foreach($menu as $row)
                                
                                @php
                                    $totalData = \App\Submission::where('isRead', '0')->where('id_activity', $row->id)->where('id_employee', Auth::user()->employee_id)->count();
                                @endphp
                                <li>
                                    @if(($age*365) > $row->activity_before_day && $row->activity_before_day > 0)
                                        <a href="{{ url('submission/'.$row->id) }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> {{ $row->activity_name }}</span>
                                            @if($totalData > 0) 
                                                <span class="badge badge-danger">{{ $totalData }}</span>
                                            @endif
                                        </a>
                                    @elseif(($age*365) < ($row->activity_before_day+19710) && $row->activity_before_day == 0)
                                        <a href="{{ url('submission/'.$row->id) }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> {{ $row->activity_name }}</span>
                                            @if($totalData > 0) 
                                                <span class="badge badge-danger">{{ $totalData }}</span>
                                            @endif
                                        </a>
                                    @endif
                                </li>
                                @endforeach
                            @elseif (Auth::user()->role_id == 2)
                                @php
                                    $totalData = DB::table('submission')
                                        ->join('employee', 'submission.id_employee', '=', 'employee.id')
                                        ->where('submission.status_of_submission', '4')
                                        ->where('submission.status_of_document', '!=' , '1')
                                        ->where('submission.status_of_administration', '!=' , '1')
                                        ->where('submission.id_activity', '1')
                                        ->count();
                                @endphp
                                <li>
                                    <a href="{{ url('worklist') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Monitoring Aktivitas</span>
                                        @if($totalData > 0) 
                                            <span class="badge badge-danger">{{ $totalData }}</span>
                                        @endif
                                    </a>
                                </li>

                                @php
                                $totalData = \App\Submission::where('status_of_submission', '2')->count();
                                @endphp
                                <li>
                                    <a href="{{ url('submissionemployee/2') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Validasi Pengajuan</span> 
                                        @if($totalData > 0) 
                                            <span class="badge badge-danger">{{ $totalData }}</span>
                                        @endif
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('manageadministration') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Kelola Administrasi PHK </span></a>
                                </li>
                                <li>
                                    <a href="{{ url('submissionreport') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Laporan </span></a>
                                </li>

                                @foreach($menu as $row)
                                <li>
                                    @if(($age*365) > $row->activity_before_day && $row->activity_before_day > 0)
                                        <a href="{{ url('submission/'.$row->id) }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> {{ $row->activity_name }}</span></a>
                                    @elseif(($age*365) < ($row->activity_before_day+19710) && $row->activity_before_day == 0)
                                        <a href="{{ url('submission/'.$row->id) }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> {{ $row->activity_name }}</span></a>
                                    @endif
                                </li>
                                @endforeach
                            @elseif (Auth::user()->role_id == 3)
                                <li>
                                    <a href="{{ url('employee') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Employee</span></a>
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
                                    <a href="{{ url('education') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Education</span></a>
                                </li>
                                <li>
                                    <a href="{{ url('position') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Position</span></a>
                                </li>
                                <li>
                                    <a href="{{ url('kelas') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Kelas</span></a>
                                </li>
                                <li>
                                    <a href="{{ url('endedcontract') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Ended Contract</span></a>
                                </li>
                                <li>
                                    <a href="{{ url('user') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> User</span></a>
                                </li>

                            @elseif (Auth::user()->role_id == 4)
                                @php
                                    $totalData = DB::table('submission')
                                        ->join('employee', 'submission.id_employee', '=', 'employee.id')
                                        ->where('submission.status_of_submission', '0')
                                        ->where('employee.division_id', session('division_id'))
                                        ->count();
                                    // $totalData = \App\Submission::where('status_of_submission', '0')->count();
                                @endphp
                                <li>
                                    <a href="{{ url('submissionemployee/0') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Validasi Pengajuan</span> 
                                        @if($totalData > 0) 
                                            <span class="badge badge-danger">{{ $totalData }}</span>
                                        @endif
                                    </a>
                                </li>

                                @foreach($menu as $row)
                                <li>
                                    @if(($age*365) > $row->activity_before_day && $row->activity_before_day > 0)
                                        <a href="{{ url('submission/'.$row->id) }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> {{ $row->activity_name }}</span></a>
                                    @elseif(($age*365) < ($row->activity_before_day+19710) && $row->activity_before_day == 0)
                                        <a href="{{ url('submission/'.$row->id) }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> {{ $row->activity_name }}</span></a>
                                    @endif
                                </li>
                                @endforeach

                            @elseif (Auth::user()->role_id == 5)
                                @php
                                $totalData = \App\Submission::where('status_of_submission', '3')->count();
                                @endphp
                                <li>
                                    <a href="{{ url('submissionemployee/3') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Validasi Pengajuan</span> 
                                        @if($totalData > 0) 
                                            <span class="badge badge-danger">{{ $totalData }}</span>
                                        @endif
                                    </a>
                                </li>
                                
                                
                                @foreach($menu as $row)
                                <li>
                                    @if(($age*365) > $row->activity_before_day && $row->activity_before_day > 0)
                                        <a href="{{ url('submission/'.$row->id) }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> {{ $row->activity_name }}</span></a>
                                    @elseif(($age*365) < ($row->activity_before_day+19710) && $row->activity_before_day == 0)
                                        <a href="{{ url('submission/'.$row->id) }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> {{ $row->activity_name }}</span></a>
                                    @endif
                                </li>
                                @endforeach

                            @elseif (Auth::user()->role_id == 6)
                                <li>
                                    <a href="{{ url('managejadwalinterview') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Mengelola Jadwal Exit Interview</span></a>
                                    <a href="{{ url('exitinterview') }}" class="active waves-effect" aria-expanded="false"><span class="hide-menu"> Melakukan Exit Interview</span></a>
                                </li>

                            @endif
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
