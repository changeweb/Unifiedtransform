<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'El :attribute debe ser aceptado.',
    'active_url'           => 'El :attribute no es una dirección URL valida.',
    'after'                => 'El :attribute debe ser posterior a la fecha :date.',
    'after_or_equal'       => 'El :attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => 'El :attribute debe contener solo letras.',
    'alpha_dash'           => 'El :attribute puede contener solo letras, numeros y guiones.',
    'alpha_num'            => 'El :attribute puede contener solo letras y numeros.',
    'array'                => 'El :attribute debe ser un arreglo.',
    'before'               => 'El :attribute debe ser una fecha anterior a :date.',
    'before_or_equal'      => 'El :attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'numeric' => 'El :attribute debe encontrarse entre :min y :max.',
        'file'    => 'El :attribute debe encontrarse entre :min y :max kilobytes.',
        'string'  => 'El :attribute debe encontrarse entre :min y :max caracteres.',
        'array'   => 'El :attribute debe encontrar entre :min y :max elementos.',
    ],
    'boolean'              => 'El :attribute debe ser verdadero o falso.',
    'confirmed'            => 'El :attribute de confirmación no coincide.',
    'date'                 => 'El :attribute no es una fecha valida.',
    'date_format'          => 'El :attribute no coincide con el formato :format.',
    'different'            => 'El :attribute y :other deben ser diferentes.',
    'digits'               => 'El :attribute debe ser de :digits digitos.',
    'digits_between'       => 'El :attribute debe ser entre :min y :max digitos.',
    'dimensions'           => 'El :attribute tiene un tamaño de imagen invalido.',
    'distinct'             => 'El :attribute campo tiene un valor duplicado.',
    'email'                => 'El :attribute debe ser una dirección de correo valido.',
    'exists'               => 'El :attribute seleccionado es invalido.',
    'file'                 => 'El :attribute debe ser un archivo.',
    'filled'               => 'El :attribute debe tener un valor.',
    'image'                => 'El :attribute debe ser una imagen.',
    'in'                   => 'El :attribute seleccionado es invalido.',
    'in_array'             => 'El :attribute no existe en :other.',
    'integer'              => 'El :attribute debe ser un numero entero.',
    'ip'                   => 'El :attribute debe ser una dirección IP valida.',
    'ipv4'                 => 'El :attribute debe ser una dirección IPv4 valida.',
    'ipv6'                 => 'El :attribute debe ser una dirección IPv6 valida.',
    'json'                 => 'El :attribute debe ser una cadena JSON valida.',
    'max'                  => [
        'numeric' => 'El :attribute no puede ser mayor que :max.',
        'file'    => 'El :attribute no puede ser mayor que :max kilobytes.',
        'string'  => 'El :attribute no puede ser mayor que :max characters.',
        'array'   => 'El :attribute no puede tener mas de :max elementos.',
    ],
    'mimes'                => 'El :attribute debe ser un archivo de tipo: :values.',
    'mimetypes'            => 'El :attribute deve ser un archivo de tipo: :values.',
    'min'                  => [
        'numeric' => 'El :attribute debe ser al menos de :min.',
        'file'    => 'El :attribute debe ser al menos de :min kilobytes.',
        'string'  => 'El :attribute debe ser al menos de :min caracteres.',
        'array'   => 'El :attribute debe tener al menos :min elementos.',
    ],
    'not_in'               => 'El :attribute seleccionado es invalido.',
    'numeric'              => 'El :attribute debe ser un numero.',
    'present'              => 'El :attribute debe estar presente.',
    'regex'                => 'El :attribute formato es invalido.',
    'required'             => 'El campo :attribute es requerido.',
    'required_if'          => 'El campo :attribute es requerido cuando :other es :value.',
    'required_unless'      => 'El campo :attribute es requerido a menos que :other sea :values.',
    'required_with'        => 'El campo :attribute es requerido cuando :values este presente.',
    'required_with_all'    => 'El campo :attribute es requerido cuando :values este presente.',
    'required_without'     => 'El campo :attribute es requerido cuando :values no este presente.',
    'required_without_all' => 'El campo :attribute es requerido cuando ninguno de los :values esten presentes.',
    'same'                 => 'El :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El :attribute debe ser de :size.',
        'file'    => 'El :attribute debe ser de :size kilobytes.',
        'string'  => 'El :attribute debe ser de :size caracteres.',
        'array'   => 'El :attribute debe contener :size elementos.',
    ],
    'string'               => 'El :attribute debe ser una cadena.',
    'timezone'             => 'El :attribute debe ser una zona valida.',
    'unique'               => 'El :attribute ya ha sido utilizado.',
    'uploaded'             => 'El :attribute fallo el hacer el envio.',
    'url'                  => 'El :attribute formato es invalido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
