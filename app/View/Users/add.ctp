<div class="card">
    <div class="card-body">
        <h1>ユーザー追加</h1>
        <form action="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'add')); ?>" method="POST">
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
                    <label for="role" class="col-2">ユーザー区分</label>
                    <input type="role" class="form-control col-4" id="role" name="data[User][role]" placeholder="adminまたはauthorと入力">
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <input type="submit" class="btn btn-success" value="追加">
                </div>
            </div>
        </form>
    </div>
</div>