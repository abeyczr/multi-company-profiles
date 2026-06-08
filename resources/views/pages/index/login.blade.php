
@extends($layout)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="my-4 p-3 bg-light">
                
                
                <div>
                    @if($errors->any())
                    <div class="alert alert-danger animated bounce">{{ $errors->first() }}</div>
                    @endif
                    <form name="loginForm" action="{{ route('auth.login') }}" class="needs-validation form page-form" method="post">
                        @csrf
                        <div class="input-group form-group">
                            <input placeholder="Username Or Email" name="username"  required="required" class="form-control" type="text"  />
                            <span class="input-group-text"><i class="form-control-feedback icon dripicons-user"></i></span>
                        </div>
                        <div class="input-group form-group">
                            
                            <input  placeholder="Password" required="required" name="password" class="form-control " type="password" />
                            <span class="input-group-text"><i class="form-control-feedback icon dripicons-lock"></i></span>
                        </div>
                        <div class="row clearfix mt-3 mb-3">
                            
                            <div class="col-6">
                                <label class="">
                                <input value="true" type="checkbox" name="rememberme" />
                                Remember Me
                                </label>
                            </div>
                            
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-block btn-md" type="submit"> 
                            <i class="load-indicator">
                            <clip-loader :loading="loading" color="#fff" size="20px"></clip-loader> 
                            </i>
                            Login <i class="icon dripicons-lock-open"></i>
                            </button>
                        </div>
                    </form>
                </div>
                
                
            </div>
        </div>
    </div>
</div>
@endsection
