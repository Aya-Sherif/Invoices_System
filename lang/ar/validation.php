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

    'accepted' => 'يجب قبول :attribute.',
    'accepted_if' => 'يجب قبول :attribute عندما يكون :other هو :value.',
    'active_url' => 'الحقل :attribute يجب أن يكون عنوان URL صالحاً.',
    'after' => 'الحقل :attribute يجب أن يكون تاريخاً بعد :date.',
    'after_or_equal' => 'الحقل :attribute يجب أن يكون تاريخاً بعد أو يساوي :date.',
    'alpha' => 'الحقل :attribute يجب أن يحتوي على حروف فقط.',
    'alpha_dash' => 'الحقل :attribute يجب أن يحتوي فقط على حروف، أرقام، شرطات وشرطات سفلية.',
    'alpha_num' => 'الحقل :attribute يجب أن يحتوي فقط على حروف وأرقام.',
    'array' => 'الحقل :attribute يجب أن يكون مصفوفة.',
    'ascii' => 'يجب أن يحتوي الحقل :attribute على أحرف أبجدية رقمية ذات بايت واحد ورموز.',
    'before' => 'الحقل :attribute يجب أن يكون تاريخاً قبل :date.',
    'before_or_equal' => 'الحقل :attribute يجب أن يكون تاريخاً قبل أو يساوي :date.',
    'between' => [
        'array' => 'الحقل :attribute يجب أن يحتوي على عناصر بين :min و :max.',
        'file' => 'الحقل :attribute يجب أن يكون بين :min و :max كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب أن يكون بين :min و :max.',
        'string' => 'الحقل :attribute يجب أن يكون بين :min و :max حروف.',
    ],
    'boolean' => 'الحقل :attribute يجب أن يكون صحيحاً أو خاطئاً.',
    'can' => 'الحقل :attribute يحتوي على قيمة غير مصرح بها.',
    'confirmed' => 'تأكيد الحقل :attribute غير متطابق.',
    'contains' => 'الحقل :attribute يفتقد إلى قيمة مطلوبة.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => 'الحقل :attribute يجب أن يكون تاريخاً صالحاً.',
    'date_equals' => 'الحقل :attribute يجب أن يكون تاريخاً يساوي :date.',
    'date_format' => 'الحقل :attribute يجب أن يتطابق مع الصيغة :format.',
    'decimal' => 'يجب أن يحتوي الحقل :attribute على :decimal منازل عشرية.',
    'declined' => 'يجب رفض :attribute.',
    'declined_if' => 'يجب رفض :attribute عندما يكون :other هو :value.',
    'different' => 'الحقل :attribute و :other يجب أن يكونا مختلفين.',
    'digits' => 'الحقل :attribute يجب أن يكون :digits رقم.',
    'digits_between' => 'الحقل :attribute يجب أن يكون بين :min و :max رقم.',
    'dimensions' => 'الحقل :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'الحقل :attribute يحتوي على قيمة مكررة.',
    'doesnt_end_with' => 'يجب ألا ينتهي الحقل :attribute بواحدة من القيم التالية: :values.',
    'doesnt_start_with' => 'يجب ألا يبدأ الحقل :attribute بواحدة من القيم التالية: :values.',
    'email' => 'الحقل :attribute يجب أن يكون عنوان بريد إلكتروني صالح.',
    'ends_with' => 'الحقل :attribute يجب أن ينتهي بواحدة من القيم التالية: :values.',
    'enum' => 'القيمة المحددة في :attribute غير صالحة.',
    'exists' => 'القيمة المحددة في :attribute غير صالحة.',
    'extensions' => 'الحقل :attribute يجب أن يكون ملفاً من النوع: :values.',
    'file' => 'الحقل :attribute يجب أن يكون ملفاً.',
    'filled' => 'الحقل :attribute يجب أن يحتوي على قيمة.',
    'gt' => [
        'array' => 'الحقل :attribute يجب أن يحتوي على أكثر من :value عنصر.',
        'file' => 'الحقل :attribute يجب أن يكون أكبر من :value كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب أن يكون أكبر من :value.',
        'string' => 'الحقل :attribute يجب أن يكون أكبر من :value حرف.',
    ],
    'gte' => [
        'array' => 'الحقل :attribute يجب أن يحتوي على :value عنصر أو أكثر.',
        'file' => 'الحقل :attribute يجب أن يكون أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب أن يكون أكبر من أو يساوي :value.',
        'string' => 'الحقل :attribute يجب أن يكون أكبر من أو يساوي :value حرف.',
    ],
    'hex_color' => 'الحقل :attribute يجب أن يكون لونًا سداسي عشريًا صالحًا.',
    'image' => 'الحقل :attribute يجب أن يكون صورة.',
    'in' => 'القيمة المحددة في :attribute غير صالحة.',
    'in_array' => 'الحقل :attribute يجب أن يكون موجوداً في :other.',
    'integer' => 'الحقل :attribute يجب أن يكون عدد صحيح.',
    'ip' => 'الحقل :attribute يجب أن يكون عنوان IP صالح.',
    'ipv4' => 'الحقل :attribute يجب أن يكون عنوان IPv4 صالح.',
    'ipv6' => 'الحقل :attribute يجب أن يكون عنوان IPv6 صالح.',
    'json' => 'الحقل :attribute يجب أن يكون سلسلة JSON صالحة.',
    'list' => 'الحقل :attribute يجب أن يكون قائمة.',
    'lowercase' => 'الحقل :attribute يجب أن يكون بحروف صغيرة.',
    'lt' => [
        'array' => 'الحقل :attribute يجب أن يحتوي على أقل من :value عنصر.',
        'file' => 'الحقل :attribute يجب أن يكون أقل من :value كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب أن يكون أقل من :value.',
        'string' => 'الحقل :attribute يجب أن يكون أقل من :value حرف.',
    ],
    'lte' => [
        'array' => 'الحقل :attribute يجب ألا يحتوي على أكثر من :value عنصر.',
        'file' => 'الحقل :attribute يجب أن يكون أقل من أو يساوي :value كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب أن يكون أقل من أو يساوي :value.',
        'string' => 'الحقل :attribute يجب أن يكون أقل من أو يساوي :value حرف.',
    ],
    'mac_address' => 'الحقل :attribute يجب أن يكون عنوان MAC صالح.',
    'max' => [
        'array' => 'الحقل :attribute يجب ألا يحتوي على أكثر من :max عنصر.',
        'file' => 'الحقل :attribute يجب ألا يكون أكبر من :max كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب ألا يكون أكبر من :max.',
        'string' => 'الحقل :attribute يجب ألا يكون أكبر من :max حرف.',
    ],
    'max_digits' => 'الحقل :attribute يجب ألا يحتوي على أكثر من :max أرقام.',
    'mimes' => 'الحقل :attribute يجب أن يكون ملفاً من النوع: :values.',
    'mimetypes' => 'الحقل :attribute يجب أن يكون ملفاً من النوع: :values.',
    'min' => [
        'array' => 'الحقل :attribute يجب أن يحتوي على الأقل على :min عناصر.',
        'file' => 'الحقل :attribute يجب أن يكون على الأقل :min كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب أن يكون على الأقل :min.',
        'string' => 'الحقل :attribute يجب أن يكون على الأقل :min حروف.',
    ],
    'min_digits' => 'الحقل :attribute يجب أن يحتوي على الأقل على :min أرقام.',
    'missing' => 'الحقل :attribute يجب أن يكون مفقوداً.',
    'missing_if' => 'الحقل :attribute يجب أن يكون مفقوداً عندما يكون :other هو :value.',
    'missing_unless' => 'الحقل :attribute يجب أن يكون مفقوداً إلا إذا كان :other هو :value.',
    'missing_with' => 'الحقل :attribute يجب أن يكون مفقوداً عندما يكون :values موجوداً.',
    'missing_with_all' => 'الحقل :attribute يجب أن يكون مفقوداً عندما تكون :values موجودة.',
    'multiple_of' => 'الحقل :attribute يجب أن يكون من مضاعفات :value.',
    'not_in' => 'القيمة المحددة في :attribute غير صالحة.',
    'not_regex' => 'صيغة الحقل :attribute غير صالحة.',
    'numeric' => 'الحقل :attribute يجب أن يكون رقماً.',
    'password' => [
        'letters' => 'الحقل :attribute يجب أن يحتوي على حرف واحد على الأقل.',
        'mixed' => 'الحقل :attribute يجب أن يحتوي على حرف كبير وحرف صغير واحد على الأقل.',
        'numbers' => 'الحقل :attribute يجب أن يحتوي على رقم واحد على الأقل.',
        'symbols' => 'الحقل :attribute يجب أن يحتوي على رمز واحد على الأقل.',
        'uncompromised' => 'القيمة المقدمة للحقل :attribute ظهرت في تسريب بيانات. يرجى اختيار قيمة مختلفة.',
    ],
    'present' => 'الحقل :attribute يجب أن يكون موجوداً.',
    'prohibited' => 'الحقل :attribute محظور.',
    'prohibited_if' => 'الحقل :attribute محظور عندما يكون :other هو :value.',
    'prohibited_unless' => 'الحقل :attribute محظور إلا إذا كان :other في :values.',
    'prohibits' => 'الحقل :attribute يمنع وجود :other.',
    'regex' => 'صيغة الحقل :attribute غير صالحة.',
    'required' => 'الحقل :attribute مطلوب.',
    'required_array_keys' => 'الحقل :attribute يجب أن يحتوي على مدخلات لـ: :values.',
    'required_if' => 'الحقل :attribute مطلوب عندما يكون :other هو :value.',
    'required_if_accepted' => 'الحقل :attribute مطلوب عندما يتم قبول :other.',
    'required_unless' => 'الحقل :attribute مطلوب إلا إذا كان :other في :values.',
    'required_with' => 'الحقل :attribute مطلوب عندما تكون :values موجودة.',
    'required_with_all' => 'الحقل :attribute مطلوب عندما تكون :values موجودة.',
    'required_without' => 'الحقل :attribute مطلوب عندما تكون :values غير موجودة.',
    'required_without_all' => 'الحقل :attribute مطلوب عندما تكون كل من :values غير موجودة.',
    'same' => 'الحقل :attribute و :other يجب أن يتطابقا.',
    'size' => [
        'array' => 'الحقل :attribute يجب أن يحتوي على :size عنصر.',
        'file' => 'الحقل :attribute يجب أن يكون :size كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب أن يكون :size.',
        'string' => 'الحقل :attribute يجب أن يكون :size حرف.',
    ],
    'starts_with' => 'الحقل :attribute يجب أن يبدأ بواحدة من القيم التالية: :values.',
    'string' => 'الحقل :attribute يجب أن يكون نصاً.',
    'timezone' => 'الحقل :attribute يجب أن يكون نطاق زمني صالح.',
    'unique' => 'القيمة المقدمة للحقل :attribute مستخدمة بالفعل.',
    'uploaded' => 'فشل في تحميل الحقل :attribute.',
    'uppercase' => 'الحقل :attribute يجب أن يكون بحروف كبيرة.',
    'url' => 'الحقل :attribute يجب أن يكون عنوان URL صالح.',
    'ulid' => 'الحقل :attribute يجب أن يكون ULID صالح.',
    'uuid' => 'الحقل :attribute يجب أن يكون UUID صالح.',

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
            'rule-name' => 'رسالة مخصصة',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
