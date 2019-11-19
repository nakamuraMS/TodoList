<?php
    $this->Html->css('top', null, array('inline' => false));
    $this->Html->css('open-iconic-master/font/file/open-iconic-bootstrap', null, array('inline' => false));
    $this->Html->script('date', array('inline' => false));
?>

<?php if(!empty($duedate_before)): ?>
    <div class="alert alert-danger">
        <strong>未完了タスクで期限が迫ったのものがあります。</strong>
        <ul>
        <?php foreach($duedate_before as $item): ?>
            <li><?php echo $item; ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<?php if(!empty($duedate_today)): ?>
    <div class="alert alert-danger">
        <strong>未完了タスクで今日が期限のものがあります。</strong>
        <ul>
        <?php foreach($duedate_today as $item): ?>
            <li><?php echo $item; ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<?php if(!empty($duedate_after)): ?>
    <div class="alert alert-danger">
        <strong>未完了タスクで期限が過ぎているものがあります。</strong>
        <ul>
        <?php foreach($duedate_after as $item): ?>
            <li><?php echo $item; ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if(!empty($incomplete)): ?>
    <div class="alert alert-danger">
        <strong>タスク内で未完了のものがあります。</strong>
        <ul>
        <?php foreach($incomplete as $item): ?>
            <li><?php echo $item; ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <div class="col-1 ml-auto">
            <?php echo $this->Html->link(__('追加'), array('action' => 'add')); ?>
        </div>
        <form action="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'index')); ?>" method="POST">
            <div class="form-group">
                <div class="form-row">
                    <label class="col-4 font-weight-bold">タスクから検索</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <label class="col-2">期限</label>
                    <?php echo $this->Form->text('due_date_from', array(
                        'class' => 'form-control col-2',
                        'id' => 'due_date_from',
                        'readonly' => 'readonly',
                        'required' => false
                    ));?>
                    <?php echo $this->Form->button('日付クリア', array('type' => 'button', 'id' => 'dateClearFrom')); ?>
                    <span>～</span>
                    <?php echo $this->Form->text('due_date_to', array(
                        'class' => 'form-control col-2',
                        'id' => 'due_date_to',
                        'readonly' => 'readonly',
                        'required' => false
                    ));?>
                    <?php echo $this->Form->button('日付クリア', array('type' => 'button', 'id' => 'dateClearTo')); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <label for="name" class="col-2">タスク名</label>
                    <?php echo $this->Form->text('name', array(
                        'class' => 'form-control col-5', 
                        'id' => 'name',
                        'required' => false
                    )); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <label for="memo" class="col-2">メモ</label>
                    <?php echo $this->Form->text('memo', array(
                        'class' => 'form-control col-5', 
                        'id' => 'memo',
                        'required' => false
                    )); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="mr-3">
                        <a href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'index')); ?>"><button type="button" class="btn btn-secondary">クリア</button></a>
                    </div>
                    <div class="mr-3">
                        <input type="submit" class="btn btn-success" value="検索">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row" style="margin-top:10px;">
    <div class="col-3">
        <a href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'layout'));?>"><button type="button" class="btn btn-primary">表示レイアウト変更</button></a>
    </div>
</div>
<?php // ピン止めタスク ?>
<div class="row" style="margin-top:20px;">
<?php foreach($tasks as $task): ?>
    <?php if($task["Task"]["pin_flag"] == 1): ?>
        <div class="<?php echo $columnConfig; ?>" style="margin-bottom:10px;" >
            <div class="card linkarea" style="background-color:<?php echo $task["Task"]["color_code"]; ?>">
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="oi oi-pin"></span>
                        <?php echo $this->Html->link(h($task["Task"]["name"]), array('action' => 'edit', $task["Task"]["id"])); ?>
                    </h5><hr>
                    <?php foreach($task["TasksDetail"] as $taskDetails): ?>
                    <p class="card-text">
                        <?php if($taskDetails["done_flg"] == 0): ?>
                            <input type="checkbox" class="done" name='done[]' value='<?php echo $taskDetails["id"];?>'>
                            <?php echo $taskDetails["memo"]; ?>
                        <?php else: ?>
                            <input type="checkbox" class="done" name='done[]' value='<?php echo $taskDetails["id"];?>' checked>
                            <span style="text-decoration: line-through;"><?php echo $taskDetails["memo"]; ?></span>
                        <?php endif; ?>
                    </p>
                    <?php endforeach; ?>
                    <p class="card-text">
                        <small class="font-weight-bold text-danger"><?php echo isset($task["Task"]["due_date"]) ? "期限：" . $task["Task"]["due_date"] : ""; ?></small><br>
                        <small class="text-muted"><?php echo "登録日時：" . $task["Task"]["created"] ; ?></small>
                    </p>
                </div>
                <div class="card-footer">
                    <?php echo $this->Html->link('削除', array('controller' => 'tasks', 'action' => 'delete', $task['Task']['id']), array('confirm' => '本当にこのデータを削除しますか?')); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
</div>
<div class="w-100"></div>

<?php // ピン止めタスク以外 ?>
<div class="row" style="margin-top:20px;">
<?php foreach($tasks as $task): ?>
    <?php if($task["Task"]["pin_flag"] == 0): ?>
        <div class="<?php echo $columnConfig; ?>" style="margin-bottom:10px;" >
            <div class="card linkarea" style="background-color:<?php echo $task["Task"]["color_code"]; ?>">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $this->Html->link(h($task["Task"]["name"]), array('action' => 'edit', $task["Task"]["id"])); ?>
                    </h5><hr>
                    <?php foreach($task["TasksDetail"] as $taskDetails): ?>
                    <p class="card-text">
                        <?php if($taskDetails["done_flg"] == 0): ?>
                            <input type="checkbox" class="done" name='done[]' value='<?php echo $taskDetails["id"];?>'>
                            <?php echo $taskDetails["memo"]; ?>
                        <?php else: ?>
                            <input type="checkbox" class="done" name='done[]' value='<?php echo $taskDetails["id"];?>' checked>
                            <span style="text-decoration: line-through;"><?php echo $taskDetails["memo"]; ?></span>
                        <?php endif; ?>
                    </p>
                    <?php endforeach; ?>
                    <p class="card-text">
                        <small class="font-weight-bold text-danger"><?php echo isset($task["Task"]["due_date"]) ? "期限：" . $task["Task"]["due_date"] : ""; ?></small><br>
                        <small class="text-muted"><?php echo "登録日時：" . $task["Task"]["created"] ; ?></small>
                    </p>
                </div>
                <div class="card-footer">
                    <?php echo $this->Html->link('削除', array('controller' => 'tasks', 'action' => 'delete', $task['Task']['id']), array('confirm' => '本当にこのデータを削除しますか?')); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
</div>

<script>
// タスク操作
$('.done').on('click', function() {
    var target = $(this).val();
    if (confirm('ステータスを完了に変更しますか？')) {
        window.location.href = "<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'exe')); ?>" +'/'+ $(this).val();
    } else {
        return false;
    }
});

</script>