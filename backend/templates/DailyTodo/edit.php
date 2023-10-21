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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dailyTodo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dailyTodo->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Daily Todo'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="dailyTodo form content">
            <?= $this->Form->create($dailyTodo) ?>
            <fieldset>
                <legend><?= __('Edit Daily Todo') ?></legend>
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
