<?php

$old = [

    /*
    |--------------------------------------------------------------------------
    | Backpack Crud Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the CRUD interface.
    | You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    // Forms
    'save_action_save_and_new'                => 'Сохранить и создать',
    'save_action_save_and_edit'               => 'Сохранить и продолжить редактирование',
    'save_action_save_and_back'               => 'Сохранить и выйти',
    'save_action_save_and_preview'            => 'Сохранить и предпросмотр',
    'save_action_changed_notification'        => 'Действие после сохранения было изменено',

    // Create form
    'add'                                     => 'Добавить',
    'back_to_all'                             => 'Вернуться к списку',
    'cancel'                                  => 'Отменить',
    'add_a_new'                               => 'Добавить новый(ую)',

    // Edit form
    'edit'                                    => 'Редактировать',
    'save'                                    => 'Сохранить',

    // Translatable models
    'edit_translations'                       => 'Перевод',
    'language'                                => 'Язык',

    // CRUD table view
    'all'                                     => 'Все ',
    'in_the_database'                         => 'в базе данных',
    'list'                                    => 'Список',
    'reset'                                   => 'Сбросить',
    'actions'                                 => 'Действия',
    'preview'                                 => 'Предпросмотр',
    'delete'                                  => 'Удалить',
    'admin'                                   => 'Главная',
    'details_row'                             => 'Это строка сведений. Измените, пожалуйста',
    'details_row_loading_error'               => 'Произошла ошибка при загрузке сведений. Повторите операцию.',
    'clone'                                   => 'Создать копию',
    'clone_success'                           => '<strong>Успешно!</strong><br>Была добавлена новая запись с той же информацией',
    'clone_failure'                           => '<strong>Ошибка!</strong><br>Не получилось создать новую запись. Перезагрузите страницу и попробуйте еще раз',

    // Confirmation messages and bubbles
    'delete_confirm'                          => 'Вы уверены, что хотите удалить эту запись?',
    'delete_confirmation_title'               => 'Успешно!',
    'delete_confirmation_message'             => 'Запись была удалена',
    'delete_confirmation_not_title'           => 'Ошибка!',
    'delete_confirmation_not_message'         => 'Запись не была удалена. Обновите страницу и повторите попытку',
    'delete_confirmation_not_deleted_title'   => 'Не удалено',
    'delete_confirmation_not_deleted_message' => 'Запись осталась без изменений',

    // Bulk actions
    'bulk_no_entries_selected_title'          => 'Записи не выбраны',
    'bulk_no_entries_selected_message'        => 'Пожалуйста, выберите один или несколько элементов, чтобы выполнить массовое действие с ними',

    // Bulk delete
    'bulk_delete_are_you_sure'                => 'Вы уверены, что хотите удалить :number записей?',
    'bulk_delete_sucess_title'                => 'Записи удалены',
    'bulk_delete_sucess_message'              => ' элементов было удалено',
    'bulk_delete_error_title'                 => 'Ошибка!',
    'bulk_delete_error_message'               => 'Некоторые из выбранных элементов не могут быть удалены',

    // Bulk clone
    'bulk_clone_are_you_sure'                 => 'Подтвердите копирование записей(:number)',
    'bulk_clone_sucess_title'                 => 'Записи скопированы успешно!',
    'bulk_clone_sucess_message'               => ' элементов было скопировано.',
    'bulk_clone_error_title'                  => 'Ошибка!',
    'bulk_clone_error_message'                => 'Одна или более записей не может быть скопирована. Пожалуйста, попробуйте повторить операцию.',

    // Ajax errors
    'ajax_error_title'                        => 'Ошибка!',
    'ajax_error_text'                         => 'Пожалуйста, перезагрузите страницу',

    // DataTables translation
    'emptyTable'                              => 'В таблице нет доступных данных',
    'info'                                    => 'Показано _START_ до _END_ из _TOTAL_ совпадений',
    'infoEmpty'                               => '',
    'infoFiltered'                            => '(отфильтровано из _MAX_ совпадений)',
    'infoPostFix'                             => '.',
    'thousands'                               => ',',
    'lengthMenu'                              => '_MENU_ записей на странице',
    'loadingRecords'                          => 'Загрузка...',
    'processing'                              => 'Обработка...',
    'search'                                  => 'Поиск',
    'zeroRecords'                             => 'Совпадений не найдено',
    'paginate'                                => [
        'first'    => 'Первая',
        'last'     => 'Последняя',
        'next'     => 'Следующая',
        'previous' => 'Предыдущая',
    ],
    'aria'                                    => [
        'sortAscending'  => ': нажмите для сортировки по возрастанию',
        'sortDescending' => ': нажмите для сортировки по убыванию',
    ],
    'export'                                  => [
        'export'            => 'Экспорт',
        'copy'              => 'Копировать в буфер',
        'excel'             => 'Excel',
        'csv'               => 'CSV',
        'pdf'               => 'PDF',
        'print'             => 'На печать',
        'column_visibility' => 'Видимость колонок',
    ],

    // global crud - errors
    'unauthorized_access'                     => 'У Вас нет необходимых прав для просмотра этой страницы.',
    'please_fix'                              => 'Пожалуйста, исправьте следующие ошибки:',

    // global crud - success / error notification bubbles
    'insert_success'                          => 'Запись была успешно добавлена.',
    'update_success'                          => 'Запись была успешно изменена.',

    // CRUD reorder view
    'reorder'                                 => 'Изменить порядок',
    'reorder_text'                            => 'Используйте drag&drop для изменения порядка.',
    'reorder_success_title'                   => 'Готово',
    'reorder_success_message'                 => 'Порядок был сохранен.',
    'reorder_error_title'                     => 'Ошибка',
    'reorder_error_message'                   => 'Порядок не был сохранен.',

    // CRUD yes/no
    'yes'                                     => 'Да',
    'no'                                      => 'Нет',

    // CRUD filters navbar view
    'filters'                                 => 'Фильтры',
    'toggle_filters'                          => 'Переключить фильтры',
    'remove_filters'                          => 'Очистить фильтры',
    'apply'                                   => 'Принять',

    //filters language strings
    'today'                                   => 'Сегодня',
    'yesterday'                               => 'Вчера',
    'last_7_days'                             => 'Последние 7 дней',
    'last_30_days'                            => 'Последние 30 дней',
    'this_month'                              => 'Текущий месяц',
    'last_month'                              => 'Последний месяц',
    'custom_range'                            => 'Выбрать даты',
    'weekLabel'                               => 'W',

    // Fields
    'browse_uploads'                          => 'Загрузить файлы',
    'select_all'                              => 'Выбрать все',
    'select_files'                            => 'Выбрать файлы',
    'select_file'                             => 'Выбрать файл',
    'clear'                                   => 'Очистить',
    'page_link'                               => 'Ссылка на страницу',
    'page_link_placeholder'                   => 'http://example.com/your-desired-page',
    'internal_link'                           => 'Внутренняя ссылка',
    'internal_link_placeholder'               => 'Внутренний путь. Например: \'admin/page\' (без кавычек) для \':url\'',
    'external_link'                           => 'Внешняя ссылка',
    'choose_file'                             => 'Выбрать файл',
    'new_item'                                => 'Новый элемент',
    'select_entry'                            => 'Выбрать запись',
    'select_entries'                          => 'Выбрать записи',

    //Table field
    'table_cant_add'                          => 'Не удалось добавить новую :entity',
    'table_max_reached'                       => 'Максимальное количество из :max достигнуто',

    // File manager
    'file_manager'                            => 'Файловый менеджер',

    // InlineCreateOperation
    'related_entry_created_success'           => 'Связанная запись создана и выбрана.',
    'related_entry_created_error'             => 'Не удалось создать связанную запись.',

    // returned when no translations found in select inputs
    'empty_translations' => '(пусто)',
];

$new = [

    /*
    |--------------------------------------------------------------------------
    | Backpack Crud Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the CRUD interface.
    | You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    // Forms
    'save_action_save_and_new' => 'Saqlash va yangi element',
    'save_action_save_and_edit' => 'Ushbu narsani saqlash va tahrirlash',
    'save_action_save_and_back' => "Saqlash va qaytarish",
    'save_action_changed_notification' => "Saqlashdan so'ng odatiy xatti o'zgartirilgan.",

    // Create form
    'add'                 => "Qo'shish",
    'back_to_all'         => "Hammaga qaytish",
    'cancel'              => "Bekor qilish",
    'add_a_new'           => "Yangi qo'shish",

    // Edit form
    'edit'                 => "Tahrirlash",
    'save'                 => "Saqlash",

    // Revisions
    'revisions'            => "Yangilanishlar",
    'no_revisions'         => "Hech qanday tahrir topilmadi",
    'created_this'         => "Buni yaratdi",
    'changed_the'          => "o'zgardi",
    'restore_this_value'   => 'Ushbu qiymatni tiklash',
    'from'                 => 'dan',
    'to'                   => 'to',
    'undo'                 => 'Bekor qilish',
    'revision_restored'    => 'Tekshiruv muvaffaqiyatli tiklandi',
    'guest_user'           => "Mehmonlar uchun foydalanuvchi",

    // Translatable models
    'edit_translations' => "O'ZGARTIRIShLAR TAYYORLASH",
    'language'          => "Til",

    // CRUD table view
    'all'                       => "Hammasi",
    'in_the_database'           => "ma'lumotlar bazasida",
    'list'                      => "Ro'yxat",
    'actions'                   => 'Amallar',
    'preview'                   => "Ko'rib chiqish",
    'delete'                    => "O'chirish",
    'admin'                     => "Admin",
    'details_row'               => "Bu batafsil qator. O'zingiz xohlagan tarzda o'zgartiring. ",
    'details_row_loading_error' => "Ma'lumotni yuklashda xatolik yuz berdi. Qayta urinib ko'ring. ",

    // Confirmation messages and bubbles
    'delete_confirm'                              => "Ushbu elementni o'chirmoqchimisiz?",
    'delete_confirmation_title'                   => "O'chirildi",
    'delete_confirmation_message'                 => "Element muvaffaqiyatli o'chirildi.",
    'delete_confirmation_not_title'               => "O'chirilmagan",
    'delete_confirmation_not_message'             => "Xatolik yuz berdi, sizning elementingiz o'chirilmagan bo'lishi mumkin.",
    'delete_confirmation_not_deleted_title'       => "O'chirilmadi",
    'delete_confirmation_not_deleted_message'     => "Hech narsa bo'lmadi. Sizning elementingiz xavfsiz. ",

    // Bulk actions
    'bulk_no_entries_selected_title' => "Hech qanday yozuv tanlanmagan",
    'bulk_no_entries_selected_message' => 'Iltimos, ularga bir yoki bir nechta narsani tanlang, aks holda ularni ommaviy harakatlar bajaring.',

    // Bulk confirmation

    'bulk_delete_are_you_sure' => "Haqiqatan ham ularni o'chirib tashlamoqchimisiz :number yozuvlari?",
    'bulk_delete_sucess_title' => "Yozuvlar o'chirildi",
    'bulk_delete_sucess_message' => "elementlari o'chirildi",
    'bulk_delete_error_title' => "O''chirib bo''lmadi",
    'bulk_delete_error_message' => "Bir yoki bir nechta element o'chirib bo'lmadi",

    // Ajax errors
    'ajax_error_title' => "Xato",
    'ajax_error_text'  => 'Sahifani yuklashda xatolik yuz berdi. Iltimos, sahifani yangilang. ',

    // DataTables translation
    'emptyTable'     => "Jadvalda ma'lumotlar yo'q",
    'info'           => "_TOTAL_ yozuvlari _START_dan _END_ ga qadar ko'rsatiladi",
    'infoEmpty'      => "0 ta yozuvdan 0 to 0 gacha ko'rsatilmoqda",
    'infoFiltered'   => '(_MAX_ jami yozuvlardan filtrlangan)',
    'infoPostFix'    => '',
    'thousands'      => ',',
    'lengthMenu'     => '_MENU_ ta sahifa uchun yozuvlar',
    'loadingRecords' => "Yuklanmoqda ...",
    'processing'     => 'Ishlov berish ...',
    'search'         => 'Qidirmoq: ',
    'zeroRecords'    => 'Hech narsa topilmadi',
    'paginate'       => [
        'first'    => "Birinchi",
        'last'     => "Oxirgi",
        'next'     => 'Keyingi',
        'previous' => "Oldingi",
    ],
    'aria' => [
        'sortAscending'  => ':column ko\'tarilishi uchun faollashtirish',
        'sortDescending' => ': ustunni kamaytirish uchun faollashtirish',
    ],
    'export' => [
        'export'            => 'Export',
        'copy'              => 'Copy',
        'excel'             => 'Excel',
        'csv'               => 'CSV',
        'pdf'               => 'PDF',
        'print'             => 'Print',
        'column_visibility' => 'Column visibility',
    ],

    // global crud - errors
    'unauthorized_access' => "Ruxsatsiz kirish - ushbu sahifani ko'rish uchun kerakli ruxsatlarga ega emassiz.",
    'please_fix' => 'Iltimos, quyidagi xatoliklarni tuzating:',

    // global crud - success / error notification bubbles
    'insert_success' => "Mavzu muvaffaqiyatli qo'shildi.",
    'update_success' => "Element muvaffaqiyatli o'zgartirildi.",

    // CRUD reorder view
    'reorder'                      => "Qayta tartiblash",
    'reorder_text'                 => 'Qayta tartibga solish uchun drag va tomoshadan foydalaning.',
    'reorder_success_title'        => "Bajarildi",
    'reorder_success_message'      => 'Sizning buyurtmangiz saqlandi.',
    'reorder_error_title'          => "Xato",
    'reorder_error_message'        => "Buyurtmani saqlab bo'lmadi.",

    // CRUD yes/no
    'yes' => "Ha",
    'no' => "Yo'q",

    // CRUD filters navbar view
    'filters' => "Filtrlar",
    'toggle_filters' => 'Filtrni almashtirish',
    'remove_filters' => 'Filtrni olib tashlash',

    // Fields
    'browse_uploads' => "Yuklab olishlarni ko'rib chiqish",
    'select_all' => 'Hammasini belgilash',
    'select_files' => "Fayllarni tanlang",
    'select_file' => 'Faylni tanlang',
    'clear' => "Toza",
    'page_link' => "Sahifa havolasi",
    'page_link_placeholder' => 'http://example.com/your-desired-page',
    'internal_link' => 'Ichki aloqa',
    'internal_link_placeholder ' => ' Ichki qavs. Misol: \':url \' \'uchun \' admin / page \ \'',
    'external_link' => 'External link',
    'choose_file' => 'Faylni tanlang',

    //Table field
    'table_cant_add' => 'Yangi qo\'shilmaydi :entity',
    'table_max_reached' => 'Maksimal son :max yetdi',

    // File manager
    'file_manager' => "Fayl menejeri",
];

return $new;
