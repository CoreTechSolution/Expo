<div class="profile-sidebar">
    <?php
        if($data['user']->profile_pic!=''){
            $profile_pic=url('uploads/profile_pics/'.$data['user']->profile_pic);
        } else{
            $profile_pic=url('uploads/profile_pics/default-profile.png');
        }
        ?>
	<div class="profile-img" style="background-image: url('{{ $profile_pic }}') ">
    </div>
	<div class="profile-display-name">{{ $data['user']->name }}</div>
    <div class="profile-display-type">{{ str_replace('_',' ',$data['user']->user_type) }}</div>
</div>
<div class="logged-in-usermenus">
	<ul>
        <li><a href="{{ route('edit-profile') }}"><i class="fas fa-user"></i> Manage Profile</a></li>
        @if($data['user']->user_type=='vendor')
        <!-- <li><a href="{{ route('edit-profile-gallery') }}"><i class="fas fa-calendar-week"></i> Gallery</a></li> -->
        @endif
        @if($data['user']->user_type!='customer')
    		<li><a href="{{ route('my-event-calender') }}"><i class="fas fa-calendar-week"></i> My Event Calender</a></li>
            <li><a href="{{ route('event-calender') }}"><i class="fas fa-calendar-week"></i> Event Calender</a></li>
        @else
            <li><a href="{{ route('event-calender') }}"><i class="fas fa-calendar-week"></i> Event Calender</a></li>
        @endif
        <!-- <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> 
         Logout</a></li> -->
		<!-- <li><a href=""><i class="fa fa-folder fa-fw" aria-hidden="true"></i> Advertisements</a></li>
        <li><a href=""><i class="fa fa-bookmark fa-fw" aria-hidden="true"></i> Membership Plans</a></li>
        <li><a href=""><i class="fa fa-envelope fa-fw" aria-hidden="true"></i> Email Notification</a></li>
        <li><a href=""><i class="fa fa-star fa-fw" aria-hidden="true"></i> Review Rating</a></li> -->

	</ul>
</div>