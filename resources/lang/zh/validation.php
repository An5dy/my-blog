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

    'accepted'             => ':attribute 必须是 yes、 on、 1、或 true 中一个。',
    'active_url'           => ':attribute 必须是有效的 URL。',
    'after'                => ':attribute 必须是 :date 之后的日期。',
    'after_or_equal'       => ':attribute 必须是 :data 之后或当前 :data 的日期。',
    'alpha'                => ':attribute 必须是只包含字母的字符。',
    'alpha_dash'           => ':attribute 必须是只包含字母、数字、中划线或下划线的字符。',
    'alpha_num'            => ':attribute 必须是只包含字母有和数字的字符。',
    'array'                => ':attribute 必须是一个 PHP 数组。',
    'before'               => ':attribute 必须是一个 :data 之前的日期。',
    'before_or_equal'      => ':attribute 必须是 :data 之前或当前 :data 的日期。',
    'between'              => [
        'numeric' => '数字 :attribute 必须在 :min 到 :max 之间。',
        'file'    => '文件 :attribute 必须在 :min 到 :max KB之间。',
        'string'  => '字符串 :attribute 必须在 :min 到 :max 字符之间。',
        'array'   => '数组 :attribute 必须在 :min 到 :max 项之间。',
    ],
    'boolean'              => ':attribute 字段必须是能够被转换为布尔值 true 或 false。',
    'confirmed'            => ':attribute 值必须和 :attribute_confirmation 值一致。',
    'date'                 => ':attribute 必须是一个有效的日期。',
    'date_format'          => ':attribute 必须与给定的时间格式 :format 匹配。',
    'different'            => ':attribute 必须与 :other 值不同。',
    'digits'               => ':attribute 必须是一个 :digits 位的数字。',
    'digits_between'       => ':attribute 必须是一个长度在 :min 到 :max 之间的数字。',
    'dimensions'           => ':attribute 必须是一个图片文件并且符合相应规则。',
    'distinct'             => ':attribute 不能有重复值。',
    'email'                => ':attribute 必须是一个有效的 email 地址。',
    'exists'               => ':attribute 必须是一个已存在的值。',
    'file'                 => ':attribute 必须是一个已上传的文件。',
    'filled'               => ':attribute 不能为空。',
    'image'                => ':attribute 必须是一个图像（ jpeg、png、bmp、gif、或 svg ）。',
    'in'                   => ':attribute 是无效的。',
    'in_array'             => ':attribute 必须存在于 :other 之中。',
    'integer'              => ':attribute 必须是一个整数。',
    'ip'                   => ':attribute 必须是一个有效的 IP 地址。',
    'ipv4'                 => ':attribute 必须是一个有效的 IPv4 地址。',
    'ipv6'                 => ':attribute 必须是一个有效的 IPv6 地址。',
    'json'                 => ':attribute 必须是一个 JSON 字符串。',
    'max'                  => [
        'numeric' => '数字 :attribute 值必须小于或等于 :max 。',
        'file'    => '文件 :attribute 大小必须小于或等于 :max KB。',
        'string'  => '字符串 :attribute 长度必须小于或等于 :max 。',
        'array'   => '数组 :attribute 长度必须小于或等于 :max 。',
    ],
    'mimes'                => ':attribute 的扩展名必须满足 :values 中一项。',
    'mimetypes'            => ':attribute 的类型必须满足 :values 中一项。',
    'min'                  => [
        'numeric' => '数字 :attribute 值必须大于或等于 :min 。',
        'file'    => '文件 :attribute 大小必须大于或等于 :min KB。',
        'string'  => '字符串 :attribute 长度必须大于或等于 :min 。',
        'array'   => '数组 :attribute 长度必须大于或等于 :min。',
    ],
    'not_in'               => ':attribute 值是无效的。',
    'numeric'              => ':attribute 必须是一个数字。',
    'present'              => ':attribute 必须存在。',
    'regex'                => ':attribute 格式不正确。',
    'required'             => ':attribute 必须存在且不能为空。',
    'required_if'          => ':attribute 必须存在且不能为空。',
    'required_unless'      => ':attribute 不必存在。',
    'required_with'        => ':attribute 必须存在且不能为空。',
    'required_with_all'    => ':attribute 必须存在且不能为空。',
    'required_without'     => ':attribute 必须存在且不能为空。',
    'required_without_all' => ':attribute 必须存在且不能为空。',
    'same'                 => ':attribute 必须与 :other 相匹配.',
    'size'                 => [
        'numeric' => '数字 :attribute 大小必须为 :size 。',
        'file'    => '文件 :attribute 大小必须为 :size KB。',
        'string'  => '字符串 :attribute 长度必须为 :size 个字符。',
        'array'   => '数组 :attribute 长度必须为 :size 。',
    ],
    'string'               => ':attribute 必须是一个字符串。',
    'timezone'             => ':attribute 必须是一个有效的时区标识符。',
    'unique'               => ':attribute 已存在。',
    'uploaded'             => ':attribute 必须有上传路径。',
    'url'                  => ':attribute 必须是一个有效的 URL 地址。',

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
