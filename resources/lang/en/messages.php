<?php

return [

    'users' => [
        'create' => 'Create New User',
        'edit' => 'Edit User',
    ],
    'form' => [
        'content' => 'Your message',
        'forgot_pass' => 'Forgot Password',
        'verify_email' => 'Email Verification',
        'verify_email_text' => 'Before proceeding, you must verify your account, check your email for a verification link:',
        'verify_email_resend' => 'To resend the verification link',
        'import_rules' => 'Rules needed for a file to be approved',
    ],
    'success' => [
        'product_updated' => 'The product was successfully updated.',
        'product_deleted' => 'The product was successfully deleted.',
        'product_created' => 'The product was successfully created.',
    ],
    'importhasfailed' => [
        'sorry' => 'Your import did not pass the validations, please remember the rules',
        'category_id' => 'CATEGORY_ID = required/not null, numeric and it must exists:categories,id',
        'code' => 'CODE = required/not null, size:10 and it must be UNIQUE',
        'title' => 'TITLE = required/not null, string, max:100 and it must be UNIQUE',
        'description' => 'DESCRIPTION = required/not null, string, min:10, max:250',
        'slug' => 'SLUG = required/not null, min:6, max:100 and it must be UNIQUE',
        'price' => 'PRICE = required/not null, integer, min:1',
        'quantity' => 'QTY = required/not null, numeric, min:1',
    ],
    'exportready' => [
        'ready' => 'Your products document has been exported successfully',
        'download' => 'You can download it in the link below -> ',
        'day' => 'Have a good day',
    ],
    'importready' => [
        'ready' => 'The document you imported has been successfully uploaded',
        'check' => 'Please take a peek',
    ],
    'import' => [
        'field' => 'Field',
        'requirements' => 'Requirements',
        'message' => 'Your import is been processed... please check your inbox',
        'category_id' => 'NOT null, numeric and it must exists:categories,id',
        'code' => 'NOT null, size:10 and it must be UNIQUE',
        'title' => 'NOT null, string, max:100 and it must be UNIQUE',
        'description' => 'NOT null, string, min:10, max:250',
        'slug' => 'NOT null, min:6, max:100 and it must be UNIQUE',
        'price' => 'NOT null, integer, min:1',
        'quantity' => 'NOT null, numeric, min:1',
    ],
    'export' => [
        'message' => 'Your export has been started, we will email you when the file is ready!',
    ],
];
