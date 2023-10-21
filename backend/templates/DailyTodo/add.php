<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DailyTodo $dailyTodo
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Daily Todo'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="dailyTodo form content">
            <?= $this->Form->create($dailyTodo) ?>
            <fieldset>
                <legend><?= __('Add Daily Todo') ?></legend>
                <?php
                    echo $this->Form->control('day_id');
                    echo $this->Form->control('task');
                    echo $this->Form->control('user_id');
                    echo $this->Form->control('created_on');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
