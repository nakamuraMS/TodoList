<?php
    $this->Html->css('top', null, array('inline' => false));
    $this->Html->script('date', array('inline' => false));
?>

<div class="card">
    <div class="card-body">
        <div class="col-2 ml-auto">
            <?php echo $this->Html->link(__('トップに戻る'), array('action' => 'index')); ?>
        </div>
        <form action="<?php echo $this->Html->url('/tasks/add'); ?>" method="post"> 
            <div class="form-group">
                <div class="form-row">
                    <label for="name" class="col-2">タスク名</label>
                    <?php echo $this->Form->text('name', array(
                        'class' => 'form-control col-5', 
                        'required' => false
                    )); ?>
                </div>
                <div class="form-row">
                    <?php if(!empty($errors['name'])): ?>
                        <div class="text-danger col-6 offset-2">
                            <?php echo $errors['name'][0]; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <label for="due_date" class="col-2">期限</label>
                    <?php echo $this->Form->text('due_date', array(
                        'class' => 'form-control col-2',
                        'id' => 'due_date',
                        'readonly' => 'readonly',
                        'required' => false
                    ));?>
                    <?php echo $this->Form->button('日付クリア', array('type' => 'button', 'id' => 'dateClear')); ?>
                </div>
                <div class="form-row">
                    <?php if(!empty($errors['due_date'])): ?>
                        <div class="text-danger col-6 offset-2">
                            <?php echo $errors['due_date'][0]; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <label for="color_code" class="col-2">カラーコード</label>
                    <?php echo $this->Form->input('color_code', array(
                        'type' => 'text',
                        'id' => 'picker',
                        'label'=> false,
                        'required' => false,
                        'value' => "#ffffff",
                    ));
                    ?>
                </div>
                <div class="form-row">
                    <?php if(!empty($errors['color_code'])): ?>
                        <div class="text-danger col-6 offset-2">
                            <?php echo $errors['color_code'][0]; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <label for="pin_flag" class="col-2">ピン止め</label>
                    <?php echo $this->Form->input('pin_flag', array(
                        'type' => 'checkbox',
                        'id' => 'pin_flag',
                        'label'=> false,
                        'required' => false,
                        'hiddenField' => false
                    ));
                    ?>
                </div>
                <div class="form-row">
                    <?php if(!empty($errors['pin_flag'])): ?>
                        <div class="text-danger col-6 offset-2">
                            <?php echo $errors['pin_flag'][0]; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <label for="memo">メモ</label>
            <?php for($i=0; $i<=$notes_number; $i++): ?>
                <div class="form-group">
                    <div class="row" id="memoItem">
                        <div class="col-6">
                            <?php echo $this->Form->textarea("TasksDetail.$i.memo", array(
                                'rows' => '4',
                                'cols' => '50',
                                'class' => 'form-control'
                            )); ?>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
            <input type="submit" class="btn btn-success" value="登録">
        </form>
        <!-- <?php echo $this->Form->end(__('Submit')); ?> -->
    </div>
</div>

<script>
// spectrum
$(function($){
    $("#picker").spectrum({
        color: "#ffffff", // 初期値
        showPaletteOnly: true, // 外観をパレットのみにする
        palette: [ // パレットで使う色を指定
            ["#ffffff", "#cccccc", "#ffd6ff", "#ffffd6", "#ffead6", "#d6ffd6", "#d6ffff", "#ead6ff"],
        ],
        preferredFormat: "hex",
    });
});
</script>