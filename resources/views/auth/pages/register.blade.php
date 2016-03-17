@extends('ncells::jumbotron.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">가입</div>
            <div class="panel-body">

                <form method="POST" action="/auth/register" accept-charset="UTF-8" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Name</label>
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="name" id="name" placeholder="Name"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-mail Address</label>
                        <div class="col-md-6">
                            <input class="form-control" type="email" name="email" id="email"
                                   placeholder="E-mail Address"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input class="form-control" type="password" name="password" id="password"
                                   placeholder="Password"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="col-md-4 control-label">Confirm Password</label>
                        <div class="col-md-6">
                            <input class="form-control" type="password" name="password_confirmation"
                                   id="password_confirmation" placeholder="Confirm Password"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <input class="btn btn-primary" type="submit" value="Register">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
