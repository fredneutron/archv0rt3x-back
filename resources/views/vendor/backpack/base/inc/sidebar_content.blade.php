<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('bio') }}'><i class='nav-icon la la-id-card'></i> Bio</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('education') }}'><i class='nav-icon la la-school'></i> Education</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('hobby') }}'><i class='nav-icon la la-puzzle-piece'></i> Hobbies</a></li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-cog"></i> Options</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}\"><i class="nav-icon la la-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i> Settings</a></li>
    </ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('profession') }}'><i class='nav-icon la la-user-tie'></i> Professions</a></li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-project-diagram"></i> Recent Work</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('apptype') }}'><i class='nav-icon la la-rocket'></i> App Type</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('project') }}'><i class='nav-icon la la-industry'></i> Projects</a></li>
    </ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('skill') }}'><i class='nav-icon la la-glasses'></i> Skills</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('social') }}'><i class='nav-icon la la-group'></i> Socials</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('work') }}'><i class='nav-icon la la-briefcase'></i> Work Experience</a></li>