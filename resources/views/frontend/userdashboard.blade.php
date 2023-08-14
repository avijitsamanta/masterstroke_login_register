@extends('frontend.layouts.app')
@section('content')
<div class="rightPanel">
    <div class="headingArea desktopview">
        <h1>Hello {{auth()->user()->name}}!</h1>
        <div class="subHeading">Goodmorning.</div>
    </div>
    <!-- dashboard home start  -->
    <div class="dashboard-home">
        <!-- dashboard left start  -->
        <div class="dashboard-left">
            <div class="dashboard-left-row">
                <div class="col">
                    <div class="dashboard-left-row-sub align-v">
                        <div class="col-sub">
                            <div class="item-title">Agenda</div>
                        </div>
                        <div class="col-sub">
                            <a href="#" class="btn-all">See All</a>
                        </div>
                    </div>
                    <div class="dashboard-left-row-sub serviceDesktop">
                        <div class="col-sub pb-14">
                            <div class="blue-box">
                                <div class="top-icon">
                                    <span class="icon"><img src="{{asset('securepanel/images/icon-doc.svg')}}"  alt=""></span>
                                </div>
                                <h2>5</h2>
                                <h3>Upcoming<br>Agenda</h3>
                            </div>
                        </div>
                        <div class="col-sub pb-14">
                            <div class="blue-box">
                                <div class="top-icon">
                                    <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}"  alt=""></span>
                                </div>
                                <h2>8</h2>
                                <h3>Pending<br>Agendas</h3>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-left-row-sub serviceMobile">
                        <div class="owl-carousel" id="agendaService">
                            <div class="item">
                                <div class="col-sub pb-14">
                                    <div class="blue-box">
                                        <div class="top-icon">
                                            <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}" alt=""></span>
                                        </div>
                                        <h2>5</h2>
                                        <h3>Upcoming<br>Agenda</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sub pb-14">
                                    <div class="blue-box">
                                        <div class="top-icon">
                                            <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}" alt=""></span>
                                        </div>
                                        <h2>8</h2>
                                        <h3>Pending<br>Agendas</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="dashboard-left-row-sub align-v">
                        <div class="col-sub">
                            <div class="item-title">Task</div>
                        </div>
                        <div class="col-sub">
                            <a href="#" class="btn-all">See All</a>
                        </div>
                    </div>
                    <div class="dashboard-left-row-sub serviceDesktop">
                        <div class="col-sub pb-14">
                            <div class="blue-box">
                                <div class="top-icon">
                                    <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}" alt=""></span>
                                </div>
                                <h2>4</h2>
                                <h3>Upcoming<br>Tasks</h3>
                            </div>
                        </div>
                        <div class="col-sub pb-14">
                            <div class="blue-box">
                                <div class="top-icon">
                                    <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}"  alt=""></span>
                                </div>
                                <h2>5</h2>
                                <h3>Completed<br>Tasks</h3>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-left-row-sub serviceMobile">
                        <div class="owl-carousel" id="taskService">
                            <div class="col-sub pb-14">
                                <div class="blue-box">
                                    <div class="top-icon">
                                        <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}"  alt=""></span>
                                    </div>
                                    <h2>4</h2>
                                    <h3>Upcoming<br>Tasks</h3>
                                </div>
                            </div>
                            <div class="col-sub pb-14">
                                <div class="blue-box">
                                    <div class="top-icon">
                                        <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}"    alt=""></span>
                                    </div>
                                    <h2>5</h2>
                                    <h3>Completed<br>Tasks</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-left-row">
                <div class="col">
                    <div class="dashboard-left-row-sub align-v">
                        <div class="col-sub">
                            <div class="item-title">Leads</div>
                        </div>
                        <div class="col-sub">
                            <a href="#" class="btn-all">See All</a>
                        </div>
                    </div>
                    <div class="dashboard-left-row-sub serviceDesktop">
                        <div class="col-sub pb-14">
                            <div class="blue-box">
                                <div class="top-icon">
                                    <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}"  alt=""></span>
                                </div>
                                <h2>5</h2>
                                <h3>Follow Up<br>Leads</h3>
                            </div>
                        </div>
                        <div class="col-sub pb-14">
                            <div class="blue-box">
                                <div class="top-icon">
                                    <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}"  alt=""></span>
                                </div>
                                <h2>8</h2>
                                <h3>Contacted<br>Leads</h3>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-left-row-sub serviceMobile">
                        <div class="owl-carousel" id="leadService">
                            <div class="col-sub pb-14">
                                <div class="blue-box">
                                    <div class="top-icon">
                                        <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}"  alt=""></span>
                                    </div>
                                    <h2>5</h2>
                                    <h3>Follow Up<br>Leads</h3>
                                </div>
                            </div>
                            <div class="col-sub pb-14">
                                <div class="blue-box">
                                    <div class="top-icon">
                                        <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}"  alt=""></span>
                                    </div>
                                    <h2>8</h2>
                                    <h3>Contacted<br>Leads</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="dashboard-left-row-sub align-v">
                        <div class="col-sub">
                            <div class="item-title">Opportunity</div>
                        </div>
                        <div class="col-sub">
                            <a href="#" class="btn-all">See All</a>
                        </div>
                    </div>
                    <div class="dashboard-left-row-sub serviceDesktop">
                        <div class="col-sub pb-14">
                            <div class="blue-box">
                                <div class="top-icon">
                                    <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}"  alt=""></span>
                                </div>
                                <h2>4</h2>
                                <h3>Follow Ups<br>Pending</h3>
                            </div>
                        </div>
                        <div class="col-sub pb-14">
                            <div class="blue-box">
                                <div class="top-icon">
                                    <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}"  alt=""></span>
                                </div>
                                <h2>5</h2>
                                <h3>Follow Ups<br>Pending</h3>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-left-row-sub serviceMobile">
                        <div class="owl-carousel" id="opportunity">
                            <div class="col-sub pb-14">
                                <div class="blue-box">
                                    <div class="top-icon">
                                        <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}"  alt=""></span>
                                    </div>
                                    <h2>4</h2>
                                    <h3>Follow Ups<br>Pending</h3>
                                </div>
                            </div>
                            <div class="col-sub pb-14">
                                <div class="blue-box">
                                    <div class="top-icon">
                                        <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}" alt=""></span>
                                    </div>
                                    <h2>5</h2>
                                    <h3>Follow Ups<br>Pending</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-left-row nomobileview">
                <div class="col-full">
                    <div class="dashboard-left-row-sub align-v">
                        <div class="col-sub-full">
                            <div class="item-title">Heading</div>
                        </div>
                    </div>
                    <div class="blue-box full">
                        <div class="top-icon">
                            <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}"  alt=""></span>
                        </div>
                        <h2>5</h2>
                        <h3>Completed<br>Tasks</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- dashboard left endf  -->
        <!-- dashboard right start  -->
        <div class="dashboard-right nomobileview">
            <div class="item-title">Upcoming Birthdays</div>
            <div class="birthday-box">
                <ul>
                    <li>
                        <div class="pic">
                        </div>
                        <div class="txt">
                            <div class="name">Christina</div>
                            <div class="date">4th May</div>
                        </div>
                    </li>
                    <li>
                        <div class="pic">
                        </div>
                        <div class="txt">
                            <div class="name">Christina</div>
                            <div class="date">4th May</div>
                        </div>
                    </li>
                    <li>
                        <div class="pic">
                        </div>
                        <div class="txt">
                            <div class="name">Christina</div>
                            <div class="date">4th May</div>
                        </div>
                    </li>
                    <li>
                        <div class="pic">
                        </div>
                        <div class="txt">
                            <div class="name">Christina</div>
                            <div class="date">4th May</div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="item-title">Heading</div>
            <div class="blue-box">
                <div class="top-icon">
                    <span class="icon"><img src="{{asset('securepanel/images/icon-time.svg')}}"  alt=""></span>
                </div>
                <h2>5</h2>
                <div class="content-space"></div>
                <h3>Completed<br>Tasks</h3>
            </div>
        </div>
        <!-- dashboard right endf  -->
    </div>
    <!-- dashboard home end  -->
</div>

@endsection