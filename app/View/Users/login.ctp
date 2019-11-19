<div class="card">
    <div class="card-body">
        <form action="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'login')); ?>" method="POST">
            <div class="form-group">
                <div class="form-row">
                    <label for="username" class="col-2">ユーザー名</label>
                    <input type="username" class="form-control col-4" id="username" name="data[User][username]">
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <label for="password" class="col-2">パスワード</label>
                    <input type="password" class="form-control col-4" id="password" name="data[User][password]">
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <label for="password_display" class="col-2">パスワード表示</label>
                    <input type="checkbox" id='password_display'>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <input type="submit" class="btn btn-success" value="ログイン">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
$(function() {
    $('#password_display').change(function(){
        if ( $(this).prop('checked') ) {
            $('#password').attr('type','text');
        } else {
            $('#password').attr('type','password');
        }
    });
});
</script>