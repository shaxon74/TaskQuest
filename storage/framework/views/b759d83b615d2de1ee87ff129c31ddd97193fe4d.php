<?php $__env->startSection('content'); ?>

<section class="field-section">
    <h2>Field</h2>
    <div id='appField'>
        <field-component></field-component>
    </div>


<section class="task-list-section">
    <h2 style="display: none">タスク登録</h2>
    <div id='appTasks'>
        <tasks-component></tasks-component>
    </div>
    <h2>タスク一覧</h2>
    <table class="task-list">
        <tr><th>name</th><th>type</th>
            <th>reword</th><th>is_finished</th></tr>
            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($task->name); ?></td>
                    <td><?php echo e(limit_date($task->type)); ?></td>
                    <td><?php echo e($task->reword); ?></td>
                    <td><?php echo e($task->is_finished); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/user/index.blade.php ENDPATH**/ ?>