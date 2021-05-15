<aside class="main-sidebar elevation-4 sidebar-no-expand sidebar-dark-info">
  <!-- Brand Logo -->
  <a href="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" class="brand-link navbar-dark">
		<img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
		style="opacity: .8">
		<span class="brand-text font-weight-light" title="Pregnant Information">
			<strong>Pregnant Information</strong>
		</span>
	</a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{Storage::url('uploaded/profile/default/profile.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">
          {{ucfirst($data->firstname)}} 
          {{ucfirst($data->lastname)}} 
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      	<li class="nav-header">MAIN</li>
        <li class="nav-item">
          <a href="{{ route('pregnants.show', ['pregnant'=>$data->id]) }}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Mother Information
            </p>
          </a>
        </li>
        <li class="nav-header">PREGNANT RECORDS</li>
        @forelse($data->pregnants as $k => $pregnant)
        <li class="nav-item">
          <a href="{{ route('pregnants.show', ['pregnant'=>$data->id]) }}?r=pregnant-records&rid={{$pregnant->pregnant_no}}&tid={{csrf_token()}}" class="nav-link">
            <i class="far fa-check-square nav-icon"></i>
            <p>{{ getPregnantRank($k) }} Pregnant</p>
          </a>
        </li>
        @empty
        <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link">
            <i class="far fa-exclamation-triangle nav-icon"></i> 
            <p> No records!</p>
          </a>
        </li>
        @endforelse
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>