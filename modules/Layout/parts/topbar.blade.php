<?php

$checkNotify = \Modules\Core\Models\NotificationPush::query();

if(is_admin()){

    $checkNotify->where(function($query){

        $query->where('data', 'LIKE', '%"for_admin":1%');

        $query->orWhere('notifiable_id', Auth::id());

    });

}else{

    $checkNotify->where('data', 'LIKE', '%"for_admin":0%');

    $checkNotify->where('notifiable_id', Auth::id());

}

$notifications = $checkNotify->orderBy('created_at', 'desc')->limit(5)->get();

$countUnread = $checkNotify->where('read_at', null)->count();

?>

<div class="bravo_topbar u-header__hide-content u-header__topbar u-header__topbar-lg @if(empty($is_home)) border-bottom @endif @if(!empty($is_home)|| !empty($header_transparent))border-color-white @else  border-color-8 @endif" style="margin-top:2px;">

   <div class="{{$container_class ?? 'container'}}">

       <div class="d-flex align-items-center">

           <div class="list-inline u-header__topbar-nav-divider mb-0 topbar_left_text font-size-14 @if(!empty($is_home)|| !empty($header_transparent)) @else  list-inline-dark @endif">

               <a href="{{url(app_get_locale(false,'/'))}}" class="bravo-logo navbar-brand u-header__navbar-brand-default u-header__navbar-brand-center u-header__navbar-brand-text-white mr-0 mr-xl-5">

                   @if($logo_id = setting_item("logo_id"))

                       <?php $logo = get_file_url($logo_id,'full') ?>

                       <img src="{{$logo}}" alt="{{setting_item("site_title")}}">

                   @endif

                   <span class="u-header__navbar-brand-text">{{ setting_item_with_lang("logo_text") }}</span>

               </a>

               {!! setting_item_with_lang("topbar_left_text") !!}

           </div>

           <div class="ml-auto d-flex align-items-center">

               {{--<div class="position-relative u-header__login-form dropdown-connector-xl u-header__topbar-divider">

                   <a href="#" class="d-inline-block align-items-center text-white">

                       <span class="d-inline-block font-size-16 mr-1 px-3 py-3" style="font-weight: 600 !important;"></span>

                   </a>

               </div>--}}

               <div class="position-relative u-header__login-form dropdown-connector-xl u-header__topbar-divider currency-select">

                   <div class="d-flex align-items-center text-white dropdown">

                    <span class="d-inline-block font-size-16 mr-1 dropdown-nav-link px-3 py-3" data-toggle="dropdown" style="cursor: pointer; font-weight: 600 !important;">

                        {{ __("United States") }}

                    </span>

                       <ul class="dropdown-menu dropdown-menu-user text-left width-auto">

                           <li>

                               <a href="https://tesldproject.es">

                                   <span class="flag-icon flag-icon-es mr-2"></span>

                                   España &nbsp;<i class="topbar_check_icon fa fa-check"></i>

                               </a>

                           </li>

                       </ul>

                   </div>

               </div>

               @include('Core::frontend.currency-switcher')

               @include('Language::frontend.switcher')

               @if(Auth::id())

               <div class="dropdown-notifications position-relative u-header__login-form dropdown-connector-xl u-header__topbar-divider">

                <span class="d-inline-block font-size-16 mr-1 dropdown-nav-link px-3 py-3" data-toggle="dropdown" style="font-weight:600!important;cursor:pointer;">

                    <i class="flaticon-bell mr-2 ml-1 font-size-20" style="font-weight: 600 !important;"></i>

                    <span class="d-inline-block badge badge-danger notification-icon" style="line-height:14px;font-size:85%;">{{$countUnread}}</span>

                </span>

                   <ul class="dropdown-menu text-left dropdown overflow-auto notify-items dropdown-large">

                       <div class="dropdown-toolbar">

                           <h3 class="dropdown-toolbar-title">{{__('Notifications')}} (<span class="notif-count">{{$countUnread}}</span>)</h3>

                           <div class="dropdown-toolbar-actions">

                               <a href="#" class="markAllAsRead">{{__('Mark all as read')}}</a>

                           </div>

                       </div>

                       <ul class="dropdown-list-items p-0">

                           @if(count($notifications)> 0)

                               @foreach($notifications as $oneNotification)

                                   @php

                                       $active = $class = '';

                                       $data = json_decode($oneNotification['data']);



                                       $idNotification = @$data->id;

                                       $forAdmin = @$data->for_admin;

                                       $usingData = @$data->notification;



                                       $services = @$usingData->type;

                                       $idServices = @$usingData->id;

                                       $title = @$usingData->message;

                                       $name = @$usingData->name;

                                       $avatar = @$usingData->avatar;

                                       $link = @$usingData->link;



                                       if(empty($oneNotification->read_at)){

                                           $class = 'markAsRead';

                                           $active = 'active';

                                       }

                                   @endphp

                                   <li class="notification {{$active}}">

                                       <div class="media">

                                           <div class="media-left">

                                               <div class="media-object">

                                                   @if($avatar)

                                                       <img class="image-responsive" src="{{$avatar}}" alt="{{$name}}">

                                                   @else

                                                       <span class="avatar-text">{{ucfirst($name[0])}}</span>

                                                   @endif

                                               </div>

                                           </div>

                                           <div class="media-body">

                                               <a class="{{$class}} p-0" data-id="{{$idNotification}}" href="{{$link}}">{!! $title !!}</a>

                                               <div class="notification-meta">

                                                   <small class="timestamp">{{format_interval($oneNotification->created_at)}}</small>

                                               </div>

                                           </div>

                                       </div>

                                   </li>

                               @endforeach

                           @endif

                       </ul>

                       <div class="dropdown-footer text-right">

                           <a href="{{route('core.notification.loadNotify')}}">{{__('View More')}}</a>

                       </div>

                   </ul>

               </div>

               @endif

               <div class="position-relative u-header__login-form dropdown-connector-xl u-header__topbar-divider">

                   <a href="{{ route('page.detail', ['slugPageName' => 'system', 'slug' => 'become-a-seller-partner']) }}" class="d-inline-block align-items-center text-white px-3 py-3">
                       <span class="d-inline-block font-size-16 mr-1" style="font-weight: 600 !important;">
                           {{ __("Become a Seller & Partner") }}</span>
                   </a>

               </div>

               @if(!Auth::id())

                   <div class="position-relative u-header__login-form dropdown-connector-xl u-header__topbar-divider">

                       <a href="javascript:;" class="d-inline-block align-items-center text-white px-3 py-3"

                          data-toggle="modal" data-target="#login">

                           <span class="d-inline-block font-size-16 mr-1" style="font-weight: 600 !important;">{{ __("Log In") }}</span>

                       </a>

                   </div>

               @endif

               <div class="position-relative u-header__login-form dropdown-connector-xl u-header__topbar-divider">

                   @if(!Auth::id())

                       <a href="javascript:;" class="d-inline-block align-items-center text-white px-3 py-3"

                          data-toggle="modal" data-target="#register">

                           <span class="d-inline-block font-size-16 mr-1" style="font-weight: 600 !important;">{{ __("Sign Up") }}</span>

                       </a>

                   @else

                       <div class="d-flex align-items-center text-white  dropdown">

                           <span class="d-inline-block font-size-16 mr-1 dropdown-nav-link  py-3 px-3" data-toggle="dropdown" style="font-weight: 600 !important;">

                               {{__("Hi, :name",['name'=>Auth::user()->getDisplayName()])}}

                           </span>



                           <ul class="dropdown-menu dropdown-menu-user text-left dropdown">

                               @if(empty( setting_item('wallet_module_disable') ))

                                   <li class="credit_amount">

                                       <a href="{{route('user.wallet')}}"><i class="fa fa-money"></i> {{__("Credit: :amount",['amount'=>auth()->user()->balance])}}</a>

                                   </li>

                               @endif

                               @if(is_vendor())

                                   <li class=""><a href="{{route('vendor.dashboard')}}" class=""><i class="icon ion-md-analytics"></i> {{__("Vendor Dashboard")}}</a></li>

                               @endif

                               <li class="@if(is_vendor())  @endif">

                                   <a href="{{route('user.profile.index')}}"><i class="icon ion-md-construct"></i> {{__("My profile")}}</a>

                               </li>

                               @if(setting_item('inbox_enable'))

                                   <li class=""><a href="{{route('user.chat')}}"><i class="fa fa-comments"></i> {{__("Messages")}}</a></li>

                               @endif

                               <li class=""><a href="{{route('user.booking_history')}}"><i class="fa fa-clock-o"></i> {{__("Booking History")}}</a></li>

                               <li class=""><a href="{{route('user.change_password')}}"><i class="fa fa-lock"></i> {{__("Change password")}}</a></li>

                               @if(is_admin())

                                   <li class=""><a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("Admin Dashboard")}}</a></li>

                               @endif

                               <li class="">

                                   <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>

                               </li>

                           </ul>

                           <form id="logout-form-topbar" action="{{ route('auth.logout') }}" method="POST" style="display: none;">

                               {{ csrf_field() }}

                           </form>

                       </div>

                   @endif

               </div>



           </div>

       </div>

   </div>

</div>

