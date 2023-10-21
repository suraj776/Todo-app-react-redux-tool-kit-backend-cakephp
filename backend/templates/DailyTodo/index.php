<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\DailyTodo> $dailyTodo
 */
?>
<div class="dailyTodo index content">
    <?= $this->Html->link(__('New Daily Todo'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Daily Todo') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('day_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('created_on') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dailyTodo as $dailyTodo): ?>
                <tr>
                    <td><?= $this->Number->format($dailyTodo->id) ?></td>
                    <td><?= $this->Number->format($dailyTodo->day_id) ?></td>
                    <td><?= $this->Number->format($dailyTodo->user_id) ?></td>
                    <td><?= h($dailyTodo->created_on) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $dailyTodo->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dailyTodo->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dailyTodo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dailyTodo->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
