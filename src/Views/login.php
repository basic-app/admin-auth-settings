<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
$this->setVar('title', lang('Admin.Control Panel'));
$this->setVar('description', lang('Admin.Sign in to continue.'));
helper(['form']);
?>
<?php $this->extend('BasicApp\AdminAuth\layout');?>
<?php $this->section('main');?>
    <form method="POST">
        <?= view_cell('AdminAuthInput', [
            'label' => $labels['login'] ?? 'login',
            'error' => $errors['login'] ?? null,
            'attributes' => [
                'name' => 'login',
                'placeholder' => lang('Admin.Enter login'),
                'value' => set_value('login')
            ]
        ]);?>
        <?= view_cell('AdminAuthInput', [
            'label' => $labels['password'] ?? 'password',
            'error' => $errors['password'] ?? null,
            'attributes' => [
                'type' => 'password',
                'name' => 'password',
                'placeholder' => lang('Admin.Enter your password'),
                'value' => null
            ]
        ]);?>
        <?= view_cell('AdminAuthCheckbox', [
            'label' => $labels['remember_me'] ?? 'remember_me',
            'error' => $errors['remember_me'] ?? null,
            'attributes' => [
                'value' => 1,
                'name' => 'remember_me',
                'checked' => set_checkbox('remember_me', 1, true) ? true : false
            ]
        ]);?>
        <?= view_cell('AdminAuthSubmit', [
            'label' => lang('Admin.Sign In')
        ]);?>
    </form>
<?php $this->endSection();?>