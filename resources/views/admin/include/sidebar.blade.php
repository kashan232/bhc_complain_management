<div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li>
                        <a class="ai-icon" href="{{ route('home') }}" aria-expanded="false">
                            <i class="la la-home"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="la la-user"></i>
                            <span class="nav-text">Complaints</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('all-complaints') }}">All Complaints</a></li>
                            <li><a href="{{ route('not-process-complaints') }}"> Un-Resolved  </a></li>
                            <li><a href="{{ route('in-process-complaints') }}">In-Progress </a></li>
                            <li><a href="{{ route('closed-complaints') }}">Closed </a></li>
                            <li><a href="{{ route('Incomplete-complaints') }}">Incomplete  </a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="ai-icon" href="{{ route('all-District') }}" aria-expanded="false">
                            <i class="la la-building"></i>
                            <span class="nav-text">District</span>
                        </a>
                    </li>

                    <li>
                        <a class="ai-icon" href="{{ route('all-Talukas') }}" aria-expanded="false">
                            <i class="la la-building"></i>
                            <span class="nav-text">Talukas</span>
                        </a>
                    </li>

                    <li>
                        <a class="ai-icon" href="{{ route('contacts') }}" aria-expanded="false">
                            <i class="la la-envelope"></i>
                            <span class="nav-text">Contacts</span>
                        </a>
                    </li>


                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="la la-signal"></i>
                            <span class="nav-text">Reports</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('Reporting-by-date') }}">Reporting By Date</a></li>
                            <li><a href="{{ route('Reporting-by-filters') }}">Reporting By filters</a></li>
                            <li><a href="{{ route('Reporting-by-districts') }}">Reporting By Districts</a></li>
                            <li><a href="{{ route('Reporting-by-search') }}">Reporting By CNIC</a></li>
                            <li><a href="{{ route('Reporting-by-type') }}">Reporting By Complaint Type</a></li>

                        </ul>
                    </li>

                </ul>
            </div>
        </div>