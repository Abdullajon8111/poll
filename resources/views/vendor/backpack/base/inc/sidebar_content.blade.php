<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

@role('admin', 'admin')
<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<hr class="w-100 my-2">
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('survey') }}'><i class='nav-icon la la-poll'></i> Surveys</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('section') }}'><i class='nav-icon la la-puzzle-piece'></i> Sections</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('question') }}'><i class='nav-icon la la-question'></i> Questions</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('entry') }}'><i class='nav-icon la la-question'></i> Entries</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('answer') }}'><i class='nav-icon la la-check'></i> Answers</a></li>

<hr class="w-100 my-2">
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('operator') }}'><i class='nav-icon la la-user'></i> Operators</a></li>

<hr class="w-100 my-2">
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('org-category') }}'><i class='nav-icon la la-folder-open'></i> Org categories</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('organization') }}'><i class='nav-icon la la-sitemap'></i> Organizations</a></li>

<hr class="w-100 my-2">
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('univer-category') }}'><i class='nav-icon la la-folder-open'></i> Univer categories</a></li>
@endrole

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('university') }}'><i class='nav-icon la la-university'></i> Universities</a></li>

@role('admin', 'admin')

<hr class="w-100 my-2">
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('org-univer-pivot') }}'><i class='nav-icon la la-filter'></i> Separator</a></li>

<hr class="w-100 my-2">
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Admin Users</span></a></li>

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('role') }}">
                <i class="nav-icon la la-id-badge"></i>
                <span>Roles</span>
            </a>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('permission') }}">
                <i class="nav-icon la la-key"></i>
                <span>Permissions</span>
            </a>
        </li> --}}
    </ul>
</li>
@endrole
