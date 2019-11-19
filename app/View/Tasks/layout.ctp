<?php

?>

<div class="card">
    <div class="card-body">
        <div class="col-2 ml-auto">
            <?php echo $this->Html->link(__('トップに戻る'), array('action' => 'index')); ?>
        </div>
        <form action="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'layout'));?>" method="POST">
            <div class="form-group">
                <div class="form-row">
                    <label class="col-6 font-weight-bold">一行に表示したいタスク数を指定してください。</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <label class="col-2">レイアウト分割数</label>
                    <select name="data[id]" class="col-2">
                        <?php foreach($layouts as $layout):?>
                            <option value="<?php echo $layout['Layout']['id'];?>" <?php echo ($layout['Layout']['id'] == $default) ? 'selected':'';?> >
                            <?php echo $layout['Layout']['name'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <input type="submit" class="btn btn-success" value="変更">
                </div>
            </div>
        </form>
    </div>
</div>