<div class="modal fade" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="paymentFormTitle"
     aria-hidden="true">
    <div class="modal-dialog " role="document">
        <form action="{{route('users.loginPost')}}" id="formLogin" method="post">
            {{csrf_field()}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Đăng nhập</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="box-payment">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-sm" required name="email"
                                           aria-describedby="email" placeholder="E-mail">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password" required class="form-control form-control-sm" name="password"
                                           aria-describedby="Password" placeholder="Password">
                                </div>
                            </div>
                        </div>

                    @if(session('error_login'))
                        <div class="form-group mgb0" style="margin-bottom: 10px">
                            <p class="red mgb0" style="margin-bottom: 10px">{{ session('error_login') }}</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100 d-flex align-items-center m-0">
                    <div class="col-4">
                        <a href="{{route('users.forget_password')}}">Quên mật khẩu</a>
                    </div>
                    <div class="col-8 text-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary loginUser" >Đăng nhập
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<script>
    @if(session('error_login'))
    $('#loginForm').modal('show');
    @endif
</script>