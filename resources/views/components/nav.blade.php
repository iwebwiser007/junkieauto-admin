<?php
use App\Models\User;
use App\Models\Auction;
use App\Models\Auction_bids;

$user=User::where('status','1')->count();
$auction = Auction::where('status','2')->count();
$bids = Auction_bids::where('status','1')->count();

?>

<!------- Main Container Starts ------->
<div class="main-container">
    <!------- page-wrapper Start ------->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-main-header">
            <div class="main-header-right row m-0">
                <div class="main-header-left">
                    <div class="logo-wrapper">
                        <a href="{{url('dashboard')}}"><img class="img-fluid" style="height: 60px;" src="{{asset('image/complete-logo.png')}}" alt=""></a>
                    </div>
                    {{-- <div class="dark-logo-wrapper">
                        <a href="index.html"><img class="img-fluid" src="{{asset('image/logo/dark-logo.png')}}" alt=""></a>
                    </div> --}}
                    <div class="toggle-sidebar d-none" data-feather="align-center" id="sidebar-toggle"><i class="fas fa-bars middle" ></i>
                    </div>
                </div>
                {{-- <div class="left-menu-header col">
                    <ul>
                        <li>
                            <form class="form-inline search-form">
                                <div class="search-bg"><i class="fa fa-search"></i>
                                    <input class="form-control-plaintext" placeholder="Search here.....">
                                </div>
                            </form><span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
                        </li>
                    </ul>
                </div> --}}
                <div class="nav-right col pull-right right-menu p-0">
                    <ul class="nav-menus">
                        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                                    class="fas fa-compress"></i></a>
                        </li>
                        {{-- <li class="onhover-dropdown">
                            <div class="bookmark-box"><i data-feather="star"></i></div>
                            <div class="bookmark-dropdown onhover-show-div">
                                <div class="form-group mb-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-search"></i></span>
                                        </div>
                                        <input class="form-control" type="text" placeholder="Search for bookmark...">
                                    </div>
                                </div>
                                <ul class="m-t-5">
                                    <li class="add-to-bookmark"><i class="bookmark-icon"
                                            data-feather="inbox"></i>Email<span class="pull-right"><i
                                                data-feather="star"></i></span></li>
                                    <li class="add-to-bookmark"><i class="bookmark-icon"
                                            data-feather="message-square"></i>Chat<span class="pull-right"><i
                                                data-feather="star"></i></span></li>
                                    <li class="add-to-bookmark"><i class="bookmark-icon"
                                            data-feather="command"></i>Feather Icon<span class="pull-right"><i
                                                data-feather="star"></i></span></li>
                                    <li class="add-to-bookmark"><i class="bookmark-icon"
                                            data-feather="airplay"></i>Widgets<span class="pull-right"><i
                                                data-feather="star"> </i></span></li>
                                </ul>
                            </div>
                        </li> --}}
                        {{-- <li class="onhover-dropdown">
                            <div class="notification-box"><i class="far fa-bell"></i><span class="dot-animated"></span>
                            </div>
                            <ul class="notification-dropdown onhover-show-div">
                                <li>
                                    <p class="f-w-700 mb-0">You have 3 Notifications<span
                                            class="pull-right badge badge-primary badge-pill">4</span></p>
                                </li>
                                <li class="noti-primary">
                                    <div class="media"><span class="notification-bg bg-light-primary"><i class="fas fa-heartbeat"></i></span>
                                        <div class="media-body">
                                            <p>Delivery processing </p><span>10 minutes ago</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="noti-secondary">
                                    <div class="media"><span class="notification-bg bg-light-secondary"><i
                                                data-feather="check-circle">
                                            </i></span>
                                        <div class="media-body">
                                            <p>Order Complete</p><span>1 hour ago</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="noti-success">
                                    <div class="media"><span class="notification-bg bg-light-success"><i
                                                data-feather="file-text">
                                            </i></span>
                                        <div class="media-body">
                                            <p>Tickets Generated</p><span>3 hour ago</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="noti-danger">
                                    <div class="media"><span class="notification-bg bg-light-danger"><i
                                                data-feather="user-check">
                                            </i></span>
                                        <div class="media-body">
                                            <p>Delivery Complete</p><span>6 hour ago</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li>
                            <div class="mode"><i class="fa fa-moon-o"></i></div>
                        </li> --}}
                        {{-- <li class="onhover-dropdown"><i data-feather="message-square"></i>
                            <ul class="chat-dropdown onhover-show-div">
                                <li>
                                    <div class="media"><img class="img-fluid rounded-circle me-3"
                                            src="./assets/img/user/4.jpg" alt="">
                                        <div class="media-body"><span>Ain Chavez</span>
                                            <p class="f-12 light-font">Lorem Ipsum is simply dummy...</p>
                                        </div>
                                        <p class="f-12">32 mins ago</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><img class="img-fluid rounded-circle me-3"
                                            src="./assets/img/user/1.jpg" alt="">
                                        <div class="media-body"><span>Erica Hughes</span>
                                            <p class="f-12 light-font">Lorem Ipsum is simply dummy...</p>
                                        </div>
                                        <p class="f-12">58 mins ago</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><img class="img-fluid rounded-circle me-3"
                                            src="./assets/img/user/2.jpg" alt="">
                                        <div class="media-body"><span>Kori Thomas</span>
                                            <p class="f-12 light-font">Lorem Ipsum is simply dummy...</p>
                                        </div>
                                        <p class="f-12">1 hr ago</p>
                                    </div>
                                </li>
                                <li class="text-center"> <a class="f-w-700" href="javascript:void(0)">See All </a></li>
                            </ul>
                        </li> --}}
                        <li class="onhover-dropdown p-0">
                            
                            <button class="btn btn-primary-light" type="button" data-bs-toggle="modal"
                                data-bs-target="#logoutModal"><i data-feather="log-out"></i>Log out</button>
                        </li>
                    </ul>
                </div>
                <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper sidebar-icon">
            <!-- Page Sidebar Start-->
            <header class="main-nav">
                <div class="sidebar-user text-center">
                        {{-- <a class="setting-primary" href="javascript:void(0)">
                            <i data-feather="settings"></i>
                        </a> --}}
                        <div style="width: 45%; margin: 0 auto; height: 90px;">
                            <a href="https://junkieauto.xpertmedia.co.za/profile" data-bs-original-title="" title="" class="d-inline-block w-100 h-100">
                                <img class="rounded-circle default-img" src="{{user()->profile_url}}" alt="">
                            </a>
                        </div>
                        
                        {{-- <div class="badge-bottom">
                            <span class="badge badge-primary">New</span>
                        </div> --}}
                        <a href="{{url('profile')}}">
                            <h6 class="mt-3 f-14 f-w-600">{{user()->first_name}} {{user()->last_name}}</h6>
                        </a>
                        <!-- <p class="mb-0 font-roboto">Junkie Auto Admin</p> -->
                         <ul>
                            <li><a href="{{url('all_seller')}}"><span><span >{{$user}}</span></span>
                                <p>Sellers</p></a>
                            </li>
                            <li><a href="{{url('all_bids_auction')}}"><span >{{$bids}}</span>
                                <p>Bids</p></a>
                            </li>
                            <li><a href="{{url('all_auction')}}"><span><span >{{$auction}}</span></span>
                                <p>Auctions </p></a>
                            </li>
                        </ul>
                </div>
                <nav>
                    <div class="main-navbar">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="mainnav">
                            <ul class="nav-menu custom-scrollbar">
                                <li class="back-btn">
                                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                            aria-hidden="true"></i></div>
                                </li>
                                <li class="sidebar-main-title">
                                    <div>
                                        <h6>Menu Bar</h6>
                                    </div>
                                </li>

                                <li class="dropdown">
                                    <a class="nav-link menu-title link-nav" href="{{url('dashboard')}}">
                                        <i data-feather="git-pull-request"></i>
                                        <span>Dashboard</span>
                                        <div class="according-menu">
                                            <i class="fa fa-angle-right"></i>
                                        </div>
                                    </a>
                                </li>

                                <li class="dropdown">
                                    <a class="nav-link menu-title link-nav" href="{{url('earnings')}}">
                                        <i data-feather="git-pull-request"></i>
                                        <span>Earnings</span>
                                        <div class="according-menu">
                                            <i class="fa fa-angle-right"></i>
                                        </div>
                                    </a>
                                </li>

                                <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i
                                            data-feather="home"></i><span>Seller</span></a>
                                    <ul class="nav-submenu menu-content">
                                        {{-- <li><a href="{{url('all_deal')}}">All sellers</a></li> --}}
                                        {{-- <li><a href="{{url('ind_deal')}}">Individual sellers</a></li> --}}
                                        <li><a href="{{url('all_seller')}}">All Sellers</a></li>
                                       <li><a href="{{url('seller_req')}}">Sellers Requests</a></li>
                                       <li><a href="{{url('document_req')}}">Document Requests</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a class="nav-link menu-title link-nav" href="{{url('deals')}}">
                                        <i data-feather="git-pull-request"></i>
                                        <span>Deals</span>
                                        <div class="according-menu">
                                            <i class="fa fa-angle-right"></i>
                                        </div>
                                    </a>
                                </li>
                                

                                {{-- <li class="dropdown">
                                    <a class="nav-link menu-title link-nav" href="{{url('cars')}}">
                                        <i data-feather="git-pull-request"></i>
                                        <span>Cars</span>
                                        <div class="according-menu">
                                            <i class="fa fa-angle-right"></i>
                                        </div>
                                    </a>
                                </li> --}}

                                <li class="dropdown">
                                    <a class="nav-link menu-title link-nav" href="{{url('all_bids_auction')}}">
                                        <i data-feather="git-pull-request"></i>
                                        <span>Bids</span>
                                        <div class="according-menu">
                                            <i class="fa fa-angle-right"></i>
                                        </div>
                                    </a>
                                </li>

                                <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i
                                            data-feather="home"></i><span>Auctions</span></a>
                                    <ul class="nav-submenu menu-content">
                                        <li><a href="{{url('all_auction')}}">All Auctions</a></li>
                                        
                                        <li><a href="{{url('request_auction')}}">Auction Request</a></li>
                                    </ul>
                                </li>

                                 
                              
                                 <li class="dropdown">
                                    <a class="nav-link menu-title link-nav" href="{{url('general')}}">
                                        <i data-feather="git-pull-request"></i>
                                        <span>Filter</span>
                                        <div class="according-menu">
                                            <i class="fa fa-angle-right"></i>
                                        </div>
                                    </a>
                                </li>

                                <li class="dropdown">
                                    <a class="nav-link menu-title link-nav" href="{{url('make')}}">
                                        <i data-feather="git-pull-request"></i>
                                        <span>Make</span>
                                        <div class="according-menu">
                                            <i class="fa fa-angle-right"></i>
                                        </div>
                                    </a>
                                </li>

                                <li class="dropdown">
                                    <a class="nav-link menu-title link-nav" href="{{url('banner')}}">
                                        <i data-feather="git-pull-request"></i>
                                        <span>Banner</span>
                                        <div class="according-menu">
                                            <i class="fa fa-angle-right"></i>
                                        </div>
                                    </a>
                                </li>

                                <li class="dropdown">
                                    <a class="nav-link menu-title link-nav" href="{{url('commission')}}">
                                        <i data-feather="git-pull-request"></i>
                                        <span>Commission</span>
                                        <div class="according-menu">
                                            <i class="fa fa-angle-right"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a class="nav-link menu-title link-nav" href="{{url('bid_difference')}}">
                                        <i data-feather="git-pull-request"></i>
                                        <span>Bid Difference</span>
                                        <div class="according-menu">
                                            <i class="fa fa-angle-right"></i>
                                        </div>
                                    </a>
                                </li>


                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                    </div>
                </nav>
            </header>
            <!-- Page Sidebar Ends-->
       

      
