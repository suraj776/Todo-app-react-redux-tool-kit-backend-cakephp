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
            <?= $this->Html->link(__('Edit Daily Todo'), ['action' => 'edit', $dailyTodo->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Daily Todo'), ['action' => 'delete', $dailyTodo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dailyTodo->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Daily Todo'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Daily Todo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="dailyTodo view content">
            <h3><?= h($dailyTodo->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($dailyTodo->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Day Id') ?></th>
                    <td><?= $this->Number->format($dailyTodo->day_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Id') ?></th>
                    <td><?= $this->Number->format($dailyTodo->user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created On') ?></th>
                    <td><?= h($dailyTodo->created_on) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Task') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($dailyTodo->task)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
