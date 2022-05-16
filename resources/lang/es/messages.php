<?php

return [
    'users' => [
        'create' => 'CREAR NUEVO USUARIO',
        'edit' => 'EDITAR USUARIO',
    ],
    'form' => [
        'content' => 'Ingrese su mensaje',
        'forgot_pass' => 'Olvidó su contraseña',
        'verify_email' => 'Verificacion de Correo Electrónico',
        'verify_email_text' => 'Antes de proceder, debes verificar tu cuenta, por favor revisa en tu correo el link de verificación:',
        'verify_email_resend' => 'Para reenviar el link de verificación',
        'import_rules' => 'Reglas necesarias para que un archivo sea aprovado',
    ],
    'success' => [
        'product_updated' => 'El producto fue actualizado exitosamente.',
        'product_deleted' => 'El producto fue eliminado exitosamente.',
        'product_created' => 'El producto fue creado exitosamente.',
    ],
    'importhasfailed' => [
        'sorry' => 'Tu importe no pasó las validaciones, recuerda las reglas',
        'category_id' => 'CATEGORY_ID = requerido/no nulo, numerico y tiene que existir:categories,id',
        'code' => 'CODE = requerido/no nulo, tamaño:10 y tiene que ser UNICO',
        'title' => 'TITLE = requerido/no nulo, texto, max:100 y tiene que ser UNICO',
        'description' => 'DESCRIPTION = requerido/no nulo, texto, min:10, max:250',
        'slug' => 'SLUG = requerido/no nulo, min:6, max:100 y tiene que ser UNICO',
        'price' => 'PRICE = requerido/no nulo, entero, min:1',
        'quantity' => 'QTY = requerido/no nulo, numerico, min:1',
    ],
    'alert' => [
        'cannotdelete' => 'No puede ser eliminado porque tiene una relación con una factura',
    ],
    'exportready' => [
        'ready' => 'Tu documento de Productos ha sido exportado con éxito',
        'download' => 'Puedes decargarlo en el siguiente enlace -> ',
        'day' => 'Buen día',
    ],
    'importready' => [
        'ready' => 'El documento que importaste ha sido cargado con éxito',
        'check' => 'Por favor dale un vistazo',
    ],
    'import' => [
        'message' => 'Tu importe está siendo procesado.. por favor revisa tu bandeja de entrada',
        'field' => 'Campo',
        'requirements' => 'Requerimientos',
        'category_id' => 'NO nulo, numerico y tiene que existir:categories,id',
        'code' => 'NO nulo, tamaño:10 y tiene que ser UNICO',
        'title' => 'NO nulo, texto, max:100 y tiene que ser UNICO',
        'description' => 'NO nulo, texto, min:10, max:250',
        'slug' => 'NO nulo, min:6, max:100 y tiene que ser UNICO',
        'price' => 'NO nulo, entero, min:1',
        'quantity' => 'NO nulo, numerico, min:1',
    ],
    'export' => [
        'message' => 'Tu exporte ha empezado, te enviaremos un correo cuando haya finalizado!',
    ],
    'invoice_status' => [
        'approved' => 'Tu transacción fue exitosa!',
        'pending' => 'Algo salió mal con la transacción, quedará en estado pendiente por validar',
        'failed' => 'Tu pago no pudo ser procesado',
    ],
];
