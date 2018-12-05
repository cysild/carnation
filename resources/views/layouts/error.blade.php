          <!--  Form -->
                     @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                     @endif

                     @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif


@if( Session::has('message') )
  <div class="alert alert-success" role="alert" align="center">
  {{ Session::get('message') }}
  </div>
@endif

@if( Session::has('danger') )
  <div class="alert alert-danger" role="alert" align="center">
  {{ Session::get('danger') }}
  </div>
@endif

