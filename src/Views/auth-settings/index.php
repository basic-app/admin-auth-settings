<?php
declare(strict_types=1);
/**
 * @author Basic App Dev Team
 * @license MIT
 */
$this->setVar('title', lang('Admin.Auth Settings'));
$this->setVar('activeMenu', 'admin-settings');

helper(['form']);

?>
<?php $this->extend('BasicApp\Admin\layout');?>
<?php $this->section('content');?>

<?= form_open_multipart('admin/auth-settings');?>

<?= view_cell('AdminInput', [
    'label' => $labels['login'] ?? 'login',
    'error' => $errors['login'] ?? null,
    'attributes' => [
        'name' => 'login',
        'value' => set_value('login', $data->login)
    ]
]);?>

<?= view_cell('AdminInput', [
    'label' => $labels['email'] ?? 'email',
    'error' => $errors['email'] ?? null,
    'attributes' => [
        'type' => 'email',
        'name' => 'email',
        'value' => set_value('email', $data->email)
    ]
]);?>

<?= view_cell('AdminInput', [
    'label' => $labels['new_password'] ?? 'new_password',
    'error' => $errors['new_password'] ?? null,
    'attributes' => [
        'type' => 'password',
        'autocomplete' => 'new-password',
        'name' => 'new_password',
        'value' => null
    ]
]);?>

<?= view_cell('AdminInputImage', [
    'label' => $labels['avatar_image'] ?? 'avatar_image',
    'error' => $errors['avatar_image'] ?? null,
    'attributes' => [
        'name' => 'avatar_image',
        'value' => $data->avatar_image_original_name
    ],
    'url' => $data->avatar_image_path ? base_url($data->avatar_image_path) : null
]);?>

<?= view_cell('AdminValidationErrors', [
    'errors' => $errors
]);?>

<?= view_cell('AdminFormButton', [
    'label' => lang('Admin.Save'),
    'attributes' => [
        'type' => 'submit'
    ]
]);?>

<?= form_close();?>

<?php $this->endSection();?>